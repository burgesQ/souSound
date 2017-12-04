<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppScrapDirCommand extends Command
{
    protected static $defaultName = 'app:scrap-dir';

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $em;

    /**
     * AppScrapDirCommand constructor.
     *
     * @param null                                 $name
     * @param \Doctrine\ORM\EntityManagerInterface $em
     */
    function __construct($name = null, EntityManagerInterface $em)
    {
        parent::__construct($name);
        $this->em       = $em;
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

        /** @var User $oneUser */
        foreach ($this->em->getRepository("App:User")->findAll() as $oneUser) {

            $io->comment('Indexing file for ' . $oneUser->getFirstName() . ' ' . $oneUser->getLastName() . '
Base path is : '
                . '%env(DOWNLOAD_BASE_PATH)%' . $oneUser->getId());

            // if dir exist
            //     for files || get dir
            //         if dir
            //             stack
            // for dir
            //     for files
            //         if sound
            //             split name
            //             create entity

        }
    }
}
