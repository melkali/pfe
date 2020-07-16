<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Patients;
use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $patient = new Patients();
            $patient->setNamePatient($i);
            $patient->setFirstNamePatient($i);
            $patient->setPhone(mt_rand(10000000, 99999999));
            $patient->setDoctor($i);
            $manager->persist($patient);

        $manager->flush();
    }
}
}