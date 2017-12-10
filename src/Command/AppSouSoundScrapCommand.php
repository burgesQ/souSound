<?php

namespace App\Command;

use App\Entity\Artist;
use App\Entity\DownloadUtil;
use App\Entity\Playlist;
use App\Entity\Track;
use App\Entity\TrackMetadata;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppSouSoundScrapCommand extends Command
{
    protected static $defaultName = 'app:sousound:scrap';

    /**
     * @var array
     */
    private $arrayDir = [
        1 => "/YouTube/",
        2 => "/SoundCloud/"
    ];

    /**
     * @var array
     */
    private $arrayType = [
        1 => "YouTube",
        2 => "SoundCloud"
    ];

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * @var string $basePath
     */
    private $basePath;

    /**
     * @var string $rootDir
     */
    private $rootDir;

    /**
     * AppScrapDirCommand constructor.
     *
     * @param string                               $dl_base_path
     * @param                                      $kernel_root_dir
     * @param null                                 $name
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    function __construct($dl_base_path, $kernel_root_dir, $name = null, EntityManagerInterface $em)
    {
        parent::__construct($name);
        $this->em       = $em;
        $this->basePath = $dl_base_path;
        $this->rootDir  = $kernel_root_dir;
    }

    protected function configure()
    {
        $this
            ->setDescription('Scrap the dir by user to index new sounds.')
            // specific users
            // specific base directory
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $em = $this->em;

        /** @var \App\Entity\User $user */
        foreach ($em->getRepository(User::class)->findAll() as $user) {
            /** @var \App\Entity\DownloadUtil $util */
            foreach ($user->getDownloadUtils() as $util) {

                dump($util->getName());

                if ($util->getPlaylist() === null) {
                    $this->createPlaylist($io, $util, $user);
                }

                $path = $this->rootDir . '/../' . $this->basePath . $util->getUser()->getId() .
                    $this->arrayDir[$util->getType()];

                $io->comment('Indexing file for ' .
                    $user->getFirstName() .
                    ' ' .
                    $user->getLastName() .
                    '\nDownload path is : ' .
                    $path);

                $files = scandir($path);

                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {


                        /** @var TrackMetadata $trackMeta */
                        if (!($trackMeta = $em->getRepository(TrackMetadata::class)->findOneBy(['fileName' => $file])
                        )) {
                            $this->createTrack($io, $file, $path, $util);
                        } else {
                            // rm file
                            // ln -s OG .
                            if (!$util->getPlaylist()->getTracks()->contains($trackMeta->getTrack())) {
                                $util->getPlaylist()->addTrack($trackMeta->getTrack());
                            }
                        }
                        // else if same name diff loc
                    }
                }

            }
        }
        $em->flush();
    }

    /**
     * @param SymfonyStyle     $io
     * @param DownloadUtil     $util
     * @param \App\Entity\User $user
     */
    private function createPlaylist(SymfonyStyle $io, DownloadUtil $util, User $user)
    {
        $playlist = new Playlist($this->arrayType[$util->getType()] . '_user_' . $user->getId());
        $this->em->persist($playlist);
        $this->em->flush($playlist);

        $user->addPlaylist($playlist);
        $util->setPlaylist($playlist);

        $io->success('Creation playlist for util ' . $util->getName());
    }

    /**
     * @param \Symfony\Component\Console\Style\SymfonyStyle $io
     * @param string                                        $file
     * @param string                                        $path
     * @param \App\Entity\DownloadUtil                      $util
     */
    private function createTrack(SymfonyStyle $io, string $file, string $path, DownloadUtil $util)
    {
        /** @var array $trackInfo */
        $trackInfo = explode(" - ", $file, 2);
        $track     = new Track(explode(".mp3", $trackInfo[1], 1)[0]);
        $this->em->persist($track);
        $this->em->flush($track);

        $meta = new TrackMetadata($file, $path);
        $this->em->persist($meta);
        $this->em->flush($meta);


        // TODO : define method to match b2b
        /** @var Artist $artist */
        if (!($artist = $this->em->getRepository(Artist::class)->findOneBy(['artist' => $trackInfo[0]]))) {
            $track->addArtist($this->createArtist($io, $trackInfo[0]));
        } else {
            $track->addArtist($artist);
        }

        $track->setMetadata($meta);
        $util->getPlaylist()->addTrack($track);

        $io->success('Create track ' . $file);
    }

    /**
     * @param \Symfony\Component\Console\Style\SymfonyStyle $io
     * @param string                                        $artistName
     *
     * @return \App\Entity\Artist
     */
    private function createArtist(SymfonyStyle $io, string $artistName): Artist
    {
        $artist = new Artist($artistName);
        $this->em->persist($artist);
        $this->em->flush($artist);

        $io->success('Creation artist ' . $artistName);

        return $artist;
    }
}
