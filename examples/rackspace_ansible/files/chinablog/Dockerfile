FROM wigwam/wordpress

# Install a nice juicy theme
RUN wp-install.sh theme zenearth

# Install Rackspace CDN (Cloud Files) plugin, so that we can store media there
RUN wp-install.sh plugin rackspace-cloudfiles-cdn

# Install a custom plugin
COPY cajwan-transcriptor /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
RUN chown -R nobody:nogroup /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
