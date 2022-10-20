<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OfferFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 10; ++$i) {
            $offer = new Offer();
            $offer->setTitle($faker->realText(50, 1));
            $offer->setDescription($faker->realText());
            $offer->setContactEmail($faker->email);
            $offer->setContactPhone($faker->phoneNumber);
            $manager->persist($offer);
        }

        $manager->flush();
    }
}
