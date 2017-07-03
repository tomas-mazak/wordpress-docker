FROM wigwam/wordpress

# Install a theme from wordpress.org catalogue
RUN wp-install.sh theme zenearth

# Install a plugin from wordpress.org catalogue
RUN wp-install.sh plugin simple-lightbox

# Install a custom plugin
COPY cajwan-transcriptor /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
RUN chown -R nobody:nogroup /var/www/wordpress/wp-content/plugins/cajwan-transcriptor
