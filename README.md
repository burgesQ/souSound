# souSound

A privat esound sharing project. Nov 2017

Process to deploy the project :

```bash
$ sf doctrine:database:create
$ sf doctrine:schema:validate
$ sf doctrine:schema:update --force
```

The project is based on the latest sensioLab php framework : Symfony Flex.

Todo :
 - [x] User Entity
 - [] Test User entity
 - [] BackOffice
 - [] CRON manager
 - [] Tracks
 - [] Artiste
 - [] Albume/EP
 - [] Event
 - [] Mix
 - [] Orga
 - [] Label