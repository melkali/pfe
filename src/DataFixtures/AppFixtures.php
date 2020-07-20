<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Patients;
use App\Entity\Payments;
use App\Entity\Reports;
use App\Entity\Results;
use App\Entity\Room;
use App\Entity\Users;
use DateTime;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Flex\Unpack\Result;

class AppFixtures extends Fixture
{
    private $encoder;

public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder = $encoder;
}

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $patient = new Patients();
            $patient->setNamePatient($i);
            $patient->setFirstnamePatient($i);
            $patient->setPhone(mt_rand(20000000, 99999999));
            $patient->setDateBirth(new DateTime('now'));
            $patient->setDoctor($i);
            $manager->persist($patient);

            $payment = new Payments();
            $payment->setNamePayment($i);
            $payment->setSum(mt_rand(0, 100));
            $payment->setStatus(true);
            $payment->setContentPayment($i);
            $manager->persist($payment);

            $report = new Reports();
            $report->setNameReport($i);
            $report->setCreatedAt(new DateTime('now'));
            $manager->persist($report);

            $result = new Results();
            $result->setNameResult($i);
            $result->setContentResult($i);
            $result->setCreatedAt(new DateTime('now'));
            $result->setContentResult($i);
            $manager->persist($result);

            $room = new Room();
            $room->setNameRoom($i);
            $room->setAvailibityStatus(true);
            $manager->persist($room);

            $user = new Users();
            $user->setName($i);
            $password = $this->encoder->encodePassword($user, $i);
            $user->setPassword($password);
            $user->setEmail($i);
            $user->setRoles(["ROLE_USER"]);
            $user->setIsVerified(true);
            $manager->persist($user);


            $manager->flush();
        }
    }
    /**
     * Get the order of this fixture
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}
