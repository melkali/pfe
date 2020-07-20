<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Patients;
use App\Entity\Room;
use App\Entity\Users;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $room = new Room();
            $room->setNameRoom($i);
            $room->setAvailibityStatus($i);
            $room->setUsers(mt_rand(1,20));
            $manager->persist($room);
            $manager->flush();
    }
}
}