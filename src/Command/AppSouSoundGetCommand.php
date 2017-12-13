<?php

namespace App\Command;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Process\Process;
use App\Entity\User;

class AppSouSoundGetCommand extends Command
{
    protected static $defaultName = 'app:sousound:get';

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
     * AppGetSoundCommand constructor.
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
            ->setDescription('Download sound by users.')
            // specific dlInterface Tags
            // specific users
            // specific base directory
        ;
    }

    /**
     * Execute need cmd by each downloadUtil.
     *
     * TODO : need to replace cmd by script
     * TODO : need to use another function to create needed directory
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        /** @var \App\Entity\User $user */
        foreach ($this->em->getRepository(User::class)->findAll() as $user) {
            /** @var \App\Entity\DownloadUtil $util */
            foreach ($user->getDownloadUtils() as $util) {
                $path = $this->rootDir . '/../' . $this->basePath . $util->getUser()->getId() .
                    $this->arrayDir[$util->getType()];
                $mkdir = 'mkdir -p ' . $path;
                $cd    = 'cd ' . $path;
                $cmd = $mkdir . ' && ' . $cd . ' && ' . $util->getCmd();
                $io->comment('Downloading file for ' . $user->getFirstName() . ' ' . $user->getLastName());
                $io->comment('Download path is : ' . $path);
                dump($cmd);
                $process = new Process($mkdir . ' && ' . $cd . ' && ls -lna');
                $process->run();
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                $util->setOutput($process->getOutput());
            }
            $this->em->flush();
        }
    }
}

