<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppGetSoundCommand extends Command
{
    protected static $defaultName = 'app:get-sound';

    /**
     * @var array
     */
    private $arrayDir = [
        1 => "./YouTube/",
        2 => "./SoundCloud/"
    ];

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    private $basePath;

    /**
     * AppGetSoundCommand constructor.
     *
     * @param null|string                          $dl_base_path
     * @param null                                 $name
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    function __construct($dl_base_path, $name = null, EntityManagerInterface $em)
    {
        parent::__construct($name);
        $this->em       = $em;
        $this->basePath = $dl_base_path;
    }

    protected function configure()
    {
        $this
            ->setDescription('Download sound by users.')
            // specific dlInterface Tags
            // specific users
            // specific base directory
            // specific
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        /** @var \App\Entity\DownloadUtil $util */
        foreach ($this->em->getRepository("App:DownloadUtil")->findAll() as $util) {

            $io->comment(
                'Downloading file for ' . $util->getUser()->getFirstName() . ' ' . $util->getUser()->getLastName() . '
Base path is : ' .
                $this->basePath . $this->arrayDir[$util->getType()] . $util->getUser()->getId() . '
Running cmd : ' . $util->getCmd()
            );

        }
    }
}
