<?php

namespace App\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;

class LoadUserFixtures extends Fixture
{

    /**
     * Array of the different users.
     *
     * @var array
     */
    private $userArray = [
        [
            "fName"    => "turlu",
            "lName"    => "tutu",
            "email"    => "turlu@tutu.com",
            "password" => "password",
            "roles"    => ["ROLE_ADMIN", "ROLE_USER"]
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
                ->setRoles($oneUser['roles'])
            ;
            $em->persist($user);
        }
        $em->flush();
    }
}