Cottect
========================

Cottect is an open source project made by PHP Symfony. 

Installation
------------

* Using Docker compose for deployment on localhost

```bash
$ cp docker-compose.yml.dist docker-compose.yml
```

* Change the MySQL password in `docker-compose.yml` file by replace `~` character. After that run this commands to build docker container

```bash
$ docker-compose build .
$ docker-compose up -d
$ docker-exec -it cottect bash
```

```bash
$ composer install
```

* Update MySQL password and all parameters to `.env` file and make sure all parameters are correct.

* Create a new database and tables by run this commands:

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:create
```

* Build assets with `yarn`

```bash
$ yarn install
$ yarn encore dev
```

