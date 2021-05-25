#!/bin/bash

SCRIPT_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Download dependencies
composer install

# Flush rewrite rules
${SCRIPT_PATH}/vendor/bin/wp rewrite flush --hard

# activate the all the plugins
# checking whether WordPress is installed or not
if ! $(bash ${SCRIPT_PATH}/vendor/bin/wp core is-installed --network); then
    # is not multisite
    bash ${SCRIPT_PATH}/vendor/bin/wp plugin activate --all
else
  # multisite installed
  bash ${SCRIPT_PATH}/vendor/bin/wp site list --field=url | while read line ; do
    bash ${SCRIPT_PATH}/vendor/bin/wp plugin activate --all --url=$line
  done
fi

# Setup theme
cd ${SCRIPT_PATH}/web/app/themes/sb-sage
composer install
rm -rf node_modules
yarn
yarn build
