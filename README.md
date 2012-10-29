# Discussione

## Installation

Install dependencies with Composer.

    curl -s https://getcomposer.org/installer | php
    php composer.phar install

Add Node modules to the project (avoid global modules). Be sure to set the ```node_bin``` property in parameters.yml.

    npm install less
    npm install coffee-script

### Check configuration

    php app/check.php

