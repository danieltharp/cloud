This is the [Jigsaw](https://jigsaw.tighten.com) static site generator, used to deploy [tharp.io](https://tharp.io).

This actually deploys to AWS instead of a DigitalOcean space because DO can't do everything I want at this point in time.
I want certain behaviors to work like being able to have both https://tharp.io/about and https://tharp.io/about/ (with a trailing slash) 
go to the same place. I accomplish that via a Lambda@Edge function on the CloudFront distribution that fronts tharp.io:

```javascript
exports.handler = (event, context, callback) => {
  const request = event.Records[0].cf.request;

  let prefixPath; // needed for 2nd condition

  if (request.uri.match('.+/$')) {
    request.uri += 'index.html';
    callback(null, request);
  } else if (prefixPath = request.uri.match('(.+)/index.html')) {
    const modifiedPrefixPath = prefixPath[1].replace(/^\/+/, '/');
    const response = {
      status: '301',
      statusDescription: 'Found',
      headers: {
        location: [{
          key: 'Location', value: modifiedPrefixPath + '/',
        }],
      }
    };
    callback(null, response);
  } else if (request.uri.match('/[^/.]+$')) {
    const modifiedRequestURI = request.uri.replace(/^\/+/, '/');
    const response = {
      status: '301',
      statusDescription: 'Found',
      headers: {
        location: [{
          key: 'Location', value: modifiedRequestURI + '/',
        }],
      }
    };
    callback(null, response);
  } else {
    callback(null, request);
  }
}
```
As seen at [digital-sailors/standard-redirects-for-cloudfront](https://github.com/digital-sailors/standard-redirects-for-cloudfront).

A static site offers a ton of advantages, if you're willing to tolerate a slightly more complex build process.
