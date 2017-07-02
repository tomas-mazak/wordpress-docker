#!/bin/bash

set -e

WORDPRESS_ORG_THEMES="https://api.wordpress.org/s/info/1.1/"
WORDPRESS_ROOT_DIR="/var/www/wordpress"

if [[ "$#" -ne 2 || ( "$1" != "plugin" && "$1" != "theme" ) ]]; then
	echo "USAGE: $0 (plugin|theme) <slug>"
	exit 1
fi

type=$1
slug=$2

echo "Obtaining $type info..."
download_url=`curl -gs "https://api.wordpress.org/${type}s/info/1.1/?action=${type}_information&request[slug]=$slug" | jq -r .download_link 2>/dev/null || echo "null"`

if [ "$download_url" ==  "null" ]; then
	echo "$type '$slug' was not found"
	exit 1
fi

echo "Downloading $type ..."
tmpfile=`mktemp`
curl -s $download_url > $tmpfile

echo "Unpacking $type ..."
unzip -qq -d "$WORDPRESS_ROOT_DIR/wp-content/${type}s" $tmpfile
rm $tmpfile
chown -R nobody:nogroup "$WORDPRESS_ROOT_DIR/wp-content/${type}s/$slug"

echo "$type '$slug' successfully installed."
