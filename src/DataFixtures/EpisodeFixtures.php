<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture
{
    public const EPISODES = [
        [
            'title' => 'episode un',
            'number' => 1,
            'synopsis' => 'blabla voila',
        ],[
            'title' => 'episode deux',
            'number' => 2,
            'synopsis' => 'blabla voila',
        ],[
            'title' => 'episode trois',
            'number' => 3,
            'synopsis' => 'blabla voila',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes['title']);
            $episode->setNumber($episodes['number']);
            $episode->setSynopsis($episodes['synopsis']);
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }
        
        $manager->flush();
    }

}
