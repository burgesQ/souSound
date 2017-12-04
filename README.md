# souSound

A privat esound sharing project. Nov 2017

Process to deploy the project :

```bash
$ composer install -vvv
$ ./scrit/IpDocker
# copy/past db ip on .env
$ ./scrit/genDb
```

The project is based on Symfony Flex.

Need [soundcloud_dl](soundcloud_dl) and [scdl](https://github.com/rg3/youtube-dl) on the machine.
Option (except username / password) for youtube-dl must be pass thought the config file system (`/etc/youtube-dl.config` or `~/.config/youtube-dl/conf`)

See the [Todo](TODO) for more info.
