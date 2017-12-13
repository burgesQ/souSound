<?php

namespace App\Command;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;
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

    /**
     * Function that gonna index each download path and
     * reference the needed new file in database.
     *
     * TODO : better way to define new file to ref.
     * TODO : ln for file that already exist.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->em;

        $this->linkSourceDirectory();

        /** @var \App\Entity\User $user */
        foreach ($em->getRepository(User::class)->findAll() as $user) {
            /** @var \App\Entity\DownloadUtil $util */
            foreach ($user->getDownloadUtils() as $util) {

                if ($util->getPlaylist() === null) {
                    $this->createPlaylist($util, $user, $em);
                }

                $path  = $this->rootDir . '/../' . $this->basePath .
                    $util->getUser()->getId() . $this->arrayDir[$util->getType()];
                $files = scandir($path);

                foreach ($files as $file) {
                    if ($file != '.' && $file != '..') {
                        /** @var TrackMetadata $trackMeta */
                        if (!($trackMeta =
                            $em->getRepository(TrackMetadata::class)->findOneBy(['fileName' => $file]))) {
                            $io->comment('Need to create track : ' . $file);
                            $this->createTrack($file, $this->rootDir, $util, $em, $this->basePath .
                                $util->getUser()->getId
                                () .
                                $this->arrayDir[$util->getType()]);
                            $io->comment('Created track : ' . $file);
                        } else {
                            $io->comment($trackMeta->getFileName() . ' already exist.');
                            // rm file
                            // ln -s OG .
                            if (!$util->getPlaylist()->getTracks()->contains($trackMeta->getTrack())) {
                                $util->getPlaylist()->addTrack($trackMeta->getTrack());
                            }
                        }
                    }
                }
            }
        }
        $em->flush();
    }

    /**
     * Simple func that create a symbolic link between
     * the download path and
     * the public directory.
     */
    protected function linkSourceDirectory()
    {
        $path    = $this->rootDir . '/../' . $this->basePath;
        $webPath = $this->rootDir . '/../public/';

        if (file_exists($path) && !file_exists($webPath . $this->basePath)) {
            $process = new Process('ln -s ' . $path . ' ' . $webPath);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            // dump($process->getOutput());
        }
    }
}
