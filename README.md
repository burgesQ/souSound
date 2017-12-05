# souSound

A private sound sharing project. Nov 2017


## Process to deploy the project

```bash
$ composer install -vvv
$ ./scrit/genDb
```

## Front dep

Use of [node](https://nodejs.org/en/download/) and [yarn](http://symfony.com/doc/current/frontend/encore/installation.html) for the front.

Front source files are located in the `asset/` sub directories.

Run `./node_modules/.bin/encore dev --watch` to run the watch command.

## External dep

Need [soundcloud_dl](soundcloud_dl) and [scdl](https://github.com/rg3/youtube-dl) on the machine.
Option (except username / password) for youtube-dl must be pass thought the config file system (`/etc/youtube-dl.config` or `~/.config/youtube-dl/conf`)

## TODO

[Todo](TODO)
