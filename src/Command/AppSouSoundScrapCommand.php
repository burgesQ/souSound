<?php

namespace App\Command;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use App\Helper\TrackGeneratorHelper;
use App\Entity\TrackMetadata;
use App\Entity\User;

class AppSouSoundScrapCommand extends Command
{
    use TrackGeneratorHelper;

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

                if ($util->getPlaylist() === null) {
                    $this->createPlaylist($util, $user, $em);
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
                        if (!($trackMeta = $em->getRepository(TrackMetadata::class)->findOneBy(['fileName' => $file]))) {
                            $io->comment('Need to create track : ' . $file);
                            $this->createTrack($file, $this->rootDir, $util, $em, $this->basePath . $util->getUser()->getId
                            () . $this->arrayDir[$util->getType()]);
                            $io->comment('Creqted track : ' . $file);
                        } else {
                            $io->comment($trackMeta->getFileName() . ' existe');
                            // rm file
                            // ln -s OG .
                            if (!$util->getPlaylist()->getTracks()->contains($trackMeta->getTrack())) {
                                $io->comment($trackMeta->getFileName() . ' need to be linked');
                                $util->getPlaylist()->addTrack($trackMeta->getTrack());
                                $io->comment($trackMeta->getFileName() . ' is linked');
                            }
                        }
                    }
                }
            }
        }
        $em->flush();
    }
}
