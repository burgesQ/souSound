<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserFixtures extends AbstractFixture
{
    /**
     * Array of the different users.
     *
     * @var array
     */
    private $userArray = [
        [
            "fName"    => "Kyu",
            "lName"    => "Bee",
            "email"    => "kyu@be.com",
            "password" => "password",
            "roles"    => ["ROLE_ADMIN", "ROLE_USER"],
            "dl_utils" => [
                1 => "youtube_like",
                2 => "soundcloud_like",
                3 => "soundcloud_playlist"
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
        foreach ($this->userArray as $oneUser) {

            /** @var User $user */
            $user = new User($oneUser['fName'], $oneUser['lName']);
            $user
                ->setPlainPassword($oneUser['password'])
                ->setEmail($oneUser['email'])
                ->setEnabled(true)
                ->setRoles($oneUser['roles']);

            /** @var string $oneDlTools */
            foreach ($oneUser['dl_utils'] as $oneDlTools) {
                $user->addDownloadUtil($this->getReference($oneDlTools));
            }

            dump($user->getDownloadUtils()->count());
            $em->persist($user);
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