Makoto is a [Laravel](https://laravel.com) application that I've tinkered with off-and-on for about four years. It is a
way to build a home inventory, mostly for insurance purposes but I'm thinking I'm also going to add a feature to post
things to eBay from within it. I probably won't accept your PR for Makoto unless it's security-related because this is
one of a very few applications that I wrote 100% for my own use, and that means the UI and UX can be exactly what I want
them to be.

Makoto sends uploaded photos to S3-compatible storage via a [MinIO](https://min.io) driver. Since I am the only consumer
of this app, I'm fine with a single replica, and that means I'm comfortable using the local filesystem for session
management instead of offloading it to Redis. In fact, a single-user application lets you get away with a lot of
anti-patterns and I think that's okay, so long as you're aware of what you should be doing for apps with higher
visibility.

Containerizing a Laravel app has a certain amount of wheel reinvention. I'm choosing to use the `php:8-apache` image 
to get me in the ballpark, and using the included binaries to add the prerequisites. Unlike [Wikijump's](https://github.com/scpwiki/wikijump)
design pattern for the Dev Dockerfile, we don't need to run a migration with each new build because the database is
persistent, offloaded to a static MySQL host.

Managing a .env file in an open-sourced application is always tricky. Particularly in this case, since the reason I even
wrote the application is in case my house burns down.  There are several ways to approach it, but probably the least
headache involved would be to mount a .env file as a ConfigMap. Then I can retain a normal .env file for local dev work.
