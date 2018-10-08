Cottect
========================

[Cottect](https://cottect.com) is a Content Management System (CMS) and web platform.


### Installation

* Using Docker compose for deployment on localhost:

```bash
$ cp docker-compose.yml.dist docker-compose.yml
```

* Change the MySQL password in `docker-compose.yml` file by replace `root` string. After that run this commands to build docker container.

```bash
$ docker-compose build
$ docker-compose up -d

```

* Install packages:

```bash
$ docker exec -it cottect bash
root@e2baea5ca20e:/var/www/html# composer install
```

* Update MySQL password and all parameters to `.env` file and make sure all parameters are correct.

* Create a new database and tables by run this commands:

```bash
$ docker exec -it cottect bash
root@e2baea5ca20e:/var/www/html# php bin/console doctrine:database:create
root@e2baea5ca20e:/var/www/html# php bin/console doctrine:schema:create
```

* Build assets with `yarn`:

```bash
$ docker exec -it cottect bash
root@e2baea5ca20e:/var/www/html# yarn install
root@e2baea5ca20e:/var/www/html# yarn encore dev
```

### License

The Cottect is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


### Contributing

Before sending a Pull Request, be sure to review the [Contributing Guidelines](CONTRIBUTING.md) first.

### Coding standards

Please follow the following guides and code standards:

* [PSR 4 Coding Standards](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
