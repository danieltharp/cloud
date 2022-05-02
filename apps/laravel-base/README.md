I have several Laravel-driven websites and it seems more sensible to try and unify the build process on a base image.
This way, I can update a version in one place, and trigger builds for the whole fleet of applications. This image sets
up the required libraries and just needs the downstream code added to it.  
