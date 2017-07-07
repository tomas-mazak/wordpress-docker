Wordpress Docker base image
===========================

**!! THIS IS A PROOF-OF-CONCEPT REPO, DO NOT USE IN PRODUCTION !!**

Use this as a base image for 'immutable' Wordpress containers. Wordpress installed in
this image is configured not to be writable by web server. All necessary file-level
changes must be done by extending this image (see example below).

Docker hub: https://hub.docker.com/r/wigwam/wordpress/


Example Dockerfile
------------------
(see examples/simple)
```Dockerfile
FROM wigwam/wordpress

# Install a theme from wordpress.org catalogue
RUN wp-install.sh theme zenearth

# Install a plugin from wordpress.org catalogue
RUN wp-install.sh plugin simple-lightbox

# Install a custom plugin
COPY cajwan-transcriptor /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
RUN chown -R nobody:nogroup /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
```


Configuration variables
-----------------------

  - APACHE_SERVER_NAME
  - APACHE_WP_ADMIN_ALLOW_FROM
  - APACHE_XMLRPC_ALLOW_FROM
  - 
  - WORDPRESS_DB_HOST
  - WORDPRESS_DB_USER
  - WORDPRESS_DB_PASSWORD
  - WORDPRESS_DB_NAME
  - WORDPRESS_TABLE_PREFIX
  - WORDPRESS_DEBUG

Findings
--------
  - Wordpress official image could not be used, as it uses volume for /var/www/html what cannot be reverted in children images
  - wp-cli can't be used as it requires database access which is not available during build time


TODO
----
- SSL support (extra container for letsencrypt)
- Consolidated logging
- Document configuration options
- Enable plugin/theme specific version installation
- Exlore container limits (memory, ...) options
- Support apache2 prefork mpm config via the environment variables
- Explore nginx/php-fpm options
