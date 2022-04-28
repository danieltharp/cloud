This is a little go microservice that replaces (half of) an old PHP 5.4-era application. It's the listener for a link
shortener service that was used for about eight years. The creation of new links is no longer needed, but I wanted to
keep the existing links out on the internet functional.

We connect to a MySQL database via a connection string that is passed in as an environment variable via a K8s secret.
I've left an example one here.
