Single-container immutable Wordpress
====================================

This is the simplest example how to use `wigwam/wordpress` as a base image for your Wordpress
deployment on Docker. It shows how to use provided wrapper `wp-install.sh` to install themes and
plugins from wordpress.org and how to add your own code (let's say a plugin).

To try this example, just run (Docker Engine and Docker Compose must be installed first):
```
git clone https://github.com/tomas-mazak/wordpress-docker.git
cd wordpress-docker/examples/simple/
docker-compose up
```
