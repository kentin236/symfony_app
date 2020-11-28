<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $output = new ConsoleOutput();

        $user = $manager->getRepository(User::class)->findOneBy(['username' => "toto"]);
        if (!$user) {
            $user = new User();
        }
        $user->setUsername("toto");
        $user->setEmail('toto@toto.eu');
        $user->setPassword($this->encoder->encodePassword(
            $user,
            "toto"
        ));
        $date = new \DateTime();
        $date = $date->format('H:i:s-d:m:Y');
        $user->setApiToken(uniqid($date.'.', true));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $output->writeln("User TOTO created");

        $user = $manager->getRepository(User::class)->findOneBy(['username' => "tata"]);
        if (!$user) {
            $user = new User();
        }
        $user->setUsername("tata");
        $user->setEmail("tata@tata.eu");
        $user->setPassword($this->encoder->encodePassword(
            $user,
            "tata"
        ));
        $date = new \DateTime();
        $date = $date->format('H:i:s-d:m:Y');
        $user->setApiToken(uniqid($date.'.', true));
        $manager->persist($user);
        $output->writeln("User TATA created");

        $manager->flush();
    }
}
