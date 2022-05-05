---
extends: _layouts.post
section: content
title: Serverless Development Pt. 1
date: 2021-10-25
description: This site is an example of how serverless computing works.
cover_image: /assets/img/averyhappycloudthankyouverymuch.png
featured: true
categories: [aws,cloud,automation]
---

When I decided to launch this site, I didn't have much in the way of requirements. In fact, I really only had one: that the site showcase technical proficiency in multiple disciplines. One way I thought I could show that was by making this joint serverless.

*Serverless* itself is a bit of a buzzword much like the cloud itself was a decade ago. Let's get on the same page on what the definition is. For an application to be serverless:

* The resources to run the application are provisioned just in time to run the application.
* When not being actively run, the resources should be released automatically.
* The application owner should not be billed for compute when the application is not running or warming up to run.
* There is both resiliency and scalability in the serverless application through the sheer number of physical servers capable of running the workload.

For me, these are all very appealing things. In fact for most folks they're the sort of things you really want. I don't expect this site to get all that much traffic outside of those moments where it's linked by someone to some social media site. As such, I don't want to pay for the privilege of having a web server accept traffic when there's no traffic to accept.

So what are the tradeoffs? It sounds great, right? Why not just run everything this way? For individuals and smaller companies with low public visibility, you honestly probably *should* run everything serverless when you can. Some services are paid by request/invocation, some are paid per second (or fraction of a second) that the application is running, and some combine the two charges. In any event, you're only paying for the resources used to fulfill the request.

This cuts both ways, though. If you take a classic Function-as-a-service provider like AWS Lambda, you have a cost per invocation, as well as a cost for compute that is calculated as "per GB-sec" (which is one of my favorite units of measurement ever). But you've also got the costs for any data transfer your application might incur, and possibly another charge for whatever invoked the function, whether that's API Gateway, SQS, SNS, or one of the many other services you can hook to Lambda via EventBridge. If your Lambda needs to access other resources in your AWS account you might have a charge for a VPC endpoint. This is all still within the confines of only paying for the resources needed to fulfill the request, even if it ends up touching a dozen or more different systems to do so.

You see where I'm going with this? The costs can rack up beyond your initial forecast of just running the application, and for large companies or high-usage applications, it's generally far more expensive to run things this way, and you're left to figure out the business of resiliency and scaling for yourself.

For this site, I've been able to mitigate a ton of those charges by taking an alternative approach to the deployment and management of the application: This site is completely static. Everything you see and interact with is simple HTML, CSS, and JavaScript. The site is built before deployment, using PHP and Node, and the resulting static files are all that are pushed to the cloud.

This has a number of advantages and a few drawbacks as well. The advantages are numerous, but two in particular made it a very compelling choice for me. A static site has a small, bordering on nonexistent, security footprint. There's nothing to hack, there's no backend to break into, there are no customer records to steal, in fact there's nothing at all on this site that isn't already publicly available through the [GitHub repo](https://github.com/danieltharp/io) that powers it. The other advantage ties closely to the first, that there is no backend. That removes a huge amount of complexity from the equation, not having to worry about a database provider or a CMS-like backend to manage state.

As far as drawbacks, it's a bit more complex to operate a static site. Articles are written in Markdown. Configuration is through writing code, PHP in this case. And it requires a certain amount of background knowledge of the various moving parts to deploying a website, particularly if you want the site to update on-the-fly.

In Part 2, I'll get into the architecture of this site specifically, from DNS request to HTTPS response, utilizing Route 53, CloudFront, and S3. We'll also cover the CI/CD aspect of the site, and how it's fully GitOps driven, making use of GitHub Actions, in Part 3. Finally, Part 4 will have us go back and manage the infrastructure as code, utilizing Terraform. At the end of this, your fixed costs to run the website are the charges accrued for storing the assets which, this site being under 1 MB, actually rounds down to $0.00 on your AWS bill, as well as your domain if you have one.
