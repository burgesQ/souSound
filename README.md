# souSound

A privat esound sharing project. Nov 2017

Process to deploy the project :

```bash
$ composer install -vvv
$ ./scrit/IpDocker
# copy/ast db ip on .env
$ ./scrit/genDb
```

The project is based on Symfony Flex.

Todo :

    Entities :
     - [x] User Entity
     - [X] Tracks
     - [X] Artiste
     - [X] Mix
     - [x] Playlist
       - [] One for like
       - [] One for bibli
       - [X] bool Albume/EP
     - [] Event
     - [] Orga
     - [] Label
     - [] Kind

    BackOffice :
     - [] User Entity
     - [] Tracks
     - [] Artiste
     - [] Mix
     - [] Albume/EP
     - [] Event
     - [] Orga
     - [] Label
     - [] Kind

    Sf command :
     - [] Helper transformable
       - [] Open Dir
       - [] Index / filter files
       - [] Create Entity from mp3
       - [] MoveThatShit
     - [] transform from soundCloud dir
     - [] transform form youTube dir
     - [] transform from extra dir

    CRONTab manager :
     - [] Manager

    Utils :
     - [] installer/checker for debian
     - [] gitSubmodule
     - [] fbLogin
     - [] historic
     - [] like
     - [] playlist

    Search :
     - [] Artist
     - [] Name
     - [] Genre
     - [] Years
     - [] Ponderation ?

    UI/UX :
     - [] Add boostrap 4
     - [] SearchBar
     - [] LatBar
     - [] Player

