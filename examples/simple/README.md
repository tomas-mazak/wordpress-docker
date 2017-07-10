Single-container immutable Wordpress
====================================

This is the simplest example how to use `wigwam/wordpress` as a base image for your Wordpress
deployment on Docker. It shows how to use provided wrapper `wp-install.sh` to install themes and
plugins from wordpress.org and how to add your own code (let's say a plugin). The docker-compose
file takes care of:
  - building and spawning the Wordpress container,
  - spawning a MySQL container as a dependency and 
  - configuring both containers with matching database credentials.

To try this example on your local machine, just run the following
(Docker Engine and Docker Compose must be installed first):

```
git clone https://github.com/tomas-mazak/wordpress-docker.git
cd wordpress-docker/examples/simple/
docker-compose up
```

If the command was successful, you can access your Wordpress on http://localhost:8081
