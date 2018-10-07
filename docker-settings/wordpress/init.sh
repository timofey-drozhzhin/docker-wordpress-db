#!/bin/bash

# Installs specific to the BUILD ENVIRONMENT

# Development
if [ "$BUILD_ENV" == "development" ]; then
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp
fi;

# Production
if [ "$BUILD_ENV" == "production" ]; then
    echo '';
fi;