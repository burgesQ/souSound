<?php

namespace App\DataFixtures\ORM;

use App\Helper\TrackGeneratorHelper;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class LoadUserFixtures extends AbstractFixture
{
    /**
     * Array of the different users.
     *
     * @var array
     */
    private $userArray = [
        [
            "fName"    => "Turlu",
            "lName"    => "Tutu",
            "email"    => "turlu@tutu.com",
            "password" => "password",
            "roles"    => ["ROLE_ADMIN", "ROLE_USER"],
            "dl_utils" => [
                1 => "youtube_like_1",
                2 => "soundcloud_like_1",
                3 => "soundcloud_playlist_1"
            ]
        ],
        [
            "fName"    => "Ton",
            "lName"    => "Tonton",
            "email"    => "ton@tonton.com",
            "password" => "password",
            "roles"    => ["ROLE_USER"],
            "dl_utils" => [
                1 => "youtube_like_2",
                2 => "soundcloud_like_2",
                3 => "soundcloud_playlist_2"
            ]
        ]
    ];

    /**
     * Load user according to the userArray.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        foreach ($this->userArray as $userData) {

            /** @var User $user */
            $user = new User($userData['fName'], $userData['lName']);
            $user
                ->setPlainPassword($userData['password'])
                ->setEmail($userData['email'])
                ->setEnabled(true)
                ->setRoles($userData['roles']);
            $em->persist($user);
            $em->flush($user);

            /** @var string $oneDlTools */
            foreach ($userData['dl_utils'] as $oneDlTools) {
                /** @var \App\Entity\DownloadUtil $util */
                $util = $this->getReference($oneDlTools);
                $user->addDownloadUtil($util);
                $user->addPlaylist($util->getPlaylist());
                /** add user id to playlist name */
                $util->getPlaylist()->setPlaylist($util->getPlaylist()->getPlaylist() . $user->getId());
            }
        }
        $em->flush();
    }

    /**
     * Loading order of the fixture.
     *
     * @return int
     */
    function getOrder()
    {
        return 2;
    }
}