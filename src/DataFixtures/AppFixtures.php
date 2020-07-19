<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Patients;
use App\Entity\Users;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $patient = new Patients();
            $patient->setNamePatient($i);
            $patient->setFirstNamePatient($i);
            $patient->setPhone(mt_rand(20000000, 99999999));
            $patient->setDateBirth(new \DateTime('date'));
            $patient->setDoctor($i);
            $patient->setPaymentSum(mt_rand(10, 100));
            $patient->setReportPatient($i);
            $patient->setResultPatient($i);
            $patient->setUsers('user '.$i);
            $patient->setRoom($i);
            $manager->persist($patient);
            $manager->flush();
    }
}
}