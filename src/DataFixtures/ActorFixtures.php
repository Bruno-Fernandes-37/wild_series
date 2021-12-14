<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        'Kaley Cuoco',
        'Jim Parsons',
        'Mayim Bialik',
        'Johnny Galecki',
        'Melissa Rauch',
        'Andrew Lincoln',
        'Norman Reedus',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        
        $manager->flush();
    }
}
