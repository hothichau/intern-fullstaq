#!/bin/bash

SCRIPT_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Download dependencies
composer install

# Flush rewrite rules
${SCRIPT_PATH}/vendor/bin/wp rewrite flush --hard

# Setup theme
cd ${SCRIPT_PATH}/web/app/themes/sb-sage
composer install
rm -rf node_modules
yarn
yarn build
