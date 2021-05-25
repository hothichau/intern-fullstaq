# WP Training Fullstaq

## Git-flow
This project uses **Git flow**

You can find the documentation in the [wiki](https://wiki.bureaublauwgeel.nl/#!software/git/git-flow.md)

## Coding Standard
Read here [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/)

## Require tools
[Composer](https://getcomposer.org)

## Install
1. Setup the correct .env file for you environment using `.gitlab/.env.staging` as a base.
2. Execute `setup.sh` to setup project

Or setup manually:
 1. Download dependencies `composer install`
 2. Move to theme folder `cd web/app/themes/fullstaq`
 3. Download theme dependencies `composer install`
 4. Run yarn install `yarn install`
 5. Run yarn build `yarn build`

## Testing
Not available for now.

## Auto deploy (CI/CD)
1. Branch `master` will be deployed to `production` at ``
2. Branch `develop` will be deployed to `staging test` site at ``.

Note: Admin account information is in LastPass.

## What is going to be deployed
The following is going to be de deployed

* Wordpress version 5.5.*
* The **themes** in `app/themes`
* The **plugins** in `app/plugins`
* The **mu-plugins** in `app/mu-plugins`
* The **languages** files in `app/languages`

## Database migration
Database will be updated whenever admin run update plugins.
Core WordPress will be updated from file `composer.json` and automatically updated when auto-deploy.

### Setup a development environment on Mac / Windows
1. Clone source code from repository:
    `https://git.sunbytes.nl/general/wp-training-fullstaq`
then switch to branch develop `git checkout develop`
2. Setup your virtual-host config and restart your local web-service (Apache, Nginx)
    ```
    <VirtualHost *:80>
        ServerAdmin sys.admin@email.com
        DocumentRoot "/path/to/sour-code/web/"
        ServerName fullstaq.local
        ErrorLog "/private/var/log/fullstaq"
        CustomLog "/private/var/log/fullstaq" common
    </VirtualHost>
    ```
3. Setup the hosts file /etc/hosts
    `127.0.0.1 fullstaq.local`
4. Change the variables in file `.env` (or copy .gitlab/.env.staging to `.env`)
5. Execute `setup.sh` to setup project
6. Download sql file from staging (check lastpass)
7. Download languages from staging
8. Follow the instruction to setup WP and check your site.

### Config NginX
Copy this file content to nginx config

```
# Rewrite rules
if (!-e $request_filename) {
    set $test P;
}
if ($uri !~ ^/(plesk-stat|webstat|webstat-ssl|ftpstat|anon_ftpstat|awstats-icon|internal-nginx-static-location)) {
    set $test "${test}C";
}
if ($test = PC) {
    rewrite ^/(.*)$ /index.php?$1;
}

# Enable Gzip compression
gzip on;

# Compression level (1-9)
gzip_comp_level 5;

# Don't compress anything under 256 bytes
gzip_min_length 256;

# Compress output of these MIME-types
gzip_types application/atom+xml application/javascript application/json application/rss+xml application/vnd.ms-fontobject application/x-font-ttf application/x-font-opentype
    application/x-font-truetype application/x-javascript application/x-web-app-manifest+json application/xhtml+xml application/xml font/eot font/opentype
    font/otf image/svg+xml image/x-icon image/vnd.microsoft.icon text/css text/plain text/javascript text/x-component;

# Disable gzip for bad browsers
gzip_disable  "MSIE [1-6]\.(?!.*SV1)";

location ~* \.(txt|xml|js)$ {
    expires 8d;
}

location ~* \.(css)$ {
    expires 8d;
}

location ~* \.(flv|ico|pdf|avi|mov|ppt|doc|mp3|wmv|wav|mp4|m4v|ogg|webm|aac|eot|ttf|otf|woff|woff2|svg)$ {
    expires 8d;
}

location ~* \.(jpg|jpeg|png|gif|swf|webp)$ {
    expires 8d;
}
location ~ ^/wp-json/ {
    # if permalinks not enabled
    #rewrite ^/wp-json/(.*?)$ /?rest_route=/$1 last;
    try_files $uri $uri/ /index.php$is_args$args;
    #try_files $uri $uri/ /index.php?q=$uri&$args;
}
```

### Folder structure on staging server at pl131.plesk.provider.nl

```
/var/www/vhosts/ode.stagingsite.nl/wordpress

├── wordpress                   # Wordpress directory
    ├── current                 # Documentroot, symlink to the `web` folder of the latest build
    ├── builds                  # Builds directory
    │   ├── build-xxx
    │   ├── build-xxx
    │   └── build-xxx           # Build version (keep last 3 builds)
    └── persistent
        └── uploads             # the persistent folder for uploads, symlinked from the `app` folder of the latest build
```
