The Modern CMS - framework with abilities.
Ready user-friendly admin panel.
Easy to code. Multilingual and flexible.
High coding speed and supportability.


Installation


Make server route all requests to index.php

For example, apache config file

```
<VirtualHost *:80>
        ServerName site.localhost
        DocumentRoot /var/www/site
        RewriteEngine On

        <Directory /var/www/site/>
            Options Indexes FollowSymLinks MultiViews
            AllowOverride All
            Order allow,deny
            allow from all
        </Directory>
</VirtualHost>
```

Download or git-clone this repo.

Run "composer update" in root folder of the project.

Write your db connection data in file /configs/prod.php

Go to local site in browser.

Database structure will be installed automatically on first visit, wait a few seconds.

After DB in installed - go to http://local.site/cms to enter admin panel. Use "manager" as login and empty password. User will be created by default during installation.

You can change password or create new user in admin panel in module Users.

Run first migration in module Tools -> Development (at the bottom of page) - "run migrations". This will install example data for example module, some example pages, etc.

[Go to Wiki](http://tmcms.eu/)

[![Build Status](https://travis-ci.org/devp-eu/the-modern-cms-empty-project.svg?branch=master)](https://travis-ci.org/devp-eu/the-modern-cms-empty-project)
