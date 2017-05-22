Wordpress Docker base image
===========================

This is a base image for `immutable` Wordpress containers

Describe persistent/shared information problem:
  - uploads (just a volume so far)
  - sessions (not yet solved)


Example Dockerfile
------------------
...


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
Scripts for adding plugins/themes using the API:
https://dd32.id.au/projects/wordpressorg-plugin-information-api-docs/
