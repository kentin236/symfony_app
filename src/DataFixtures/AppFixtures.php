<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Output\ConsoleOutput;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $output = new ConsoleOutput();
        $manager->flush();
    }
}
