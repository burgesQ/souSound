<?php

namespace App\Command;

use App\Entity\Playlist;
use App\Entity\User;
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

        /** @var \App\Entity\User $user */
        foreach ($this->em->getRepository("App:User")->findAll() as $user) {
            /** @var \App\Entity\DownloadUtil $util */
            foreach ($user->getDownloadUtils() as $util) {

                if ($util->getPlaylist() === null) {
                    $io->comment('Creation playlist for util ' . $util->getName());
                    $playlist = new Playlist($util->getName() . $user->getId());
                    $this->em->persist($playlist);
                    $this->em->flush($playlist);

                    $user->addPlaylist($playlist);
                    $util->setPlaylist($playlist);
                }

                $path = $this->rootDir . '/../' . $this->basePath . $util->getUser()->getId() .
                    $this->arrayDir[$util->getType()];

                $io->comment('Indexing file for ' . $user->getFirstName() . ' ' . $user->getLastName());
                $io->comment('Download path is : ' . $path);

                $files = scandir($path);
                dump($files);
                // her pattern to index file
                // check if file allready indexed
                // if not created in db
                // if file already exist symlink to og

            }
        }
        $this->em->flush();
    }
}
