<?php

namespace App\DataFixtures;

use App\Entity\ValueObject\InterestRate;
use App\Entity\CreditProgram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CreditProgramFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['creditProgram'];
    }

    public function load(ObjectManager $manager): void
    {
        $programs = [
            [
                'title' => 'alfa',
                'interestRate' => 12.3,
            ],
            [
                'title' => 'premium',
                'interestRate' => 15.0,
            ],
            [
                'title' => 'standard',
                'interestRate' => 18.0,
            ],
        ];

        foreach ($programs as $data) {
            $program = new CreditProgram(
                $data['title'],
                $data['interestRate']
            );

            $manager->persist($program);
        }

        $manager->flush();
    }
}
