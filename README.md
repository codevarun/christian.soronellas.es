# Christian Soronellas Blog #

[![Build Status](https://secure.travis-ci.org/theUniC/christian.soronellas.es.png)](http://travis-ci.org/theUniC/christian.soronellas.es)

This is the implementation of the blog engine of http://christian.soronellas.es
based on Symfony2 Standard Edition.

To install follow the instructions below

```shell
git clone git://github.com/theUniC/christian.soronellas.es.git
# Edit your database settings in the parameters.ini
cp app/config/parameters.yml.dist app/config/parameters.yml
vi parameters.yml
mkdir -p app/cache app/logs
# Your webserver user
sudo chmod +a "www-data allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
# Your user
sudo chmod +a "yourname allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
wget http://getcomposer.org/composer.phar
php composer.phar install
php app/console doctrine:database:create
# Use "--dump-sql" argument to preview all the SQL that will get executed
php app/console doctrine:schema:create
php app/console doctrine:fixtures:load
```

Now you only will have to configure your parameters.ini accordingly to your database config.