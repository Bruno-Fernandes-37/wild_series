<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
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

    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodes) {
            $episode = new Episode();
            $episode->setTitle($episodes['title']);
            $episode->setNumber($episodes['number']);
            $episode->setSynopsis($episodes['synopsis']);
            $episode->setSeason($this->getReference('season_0'));
            $slug = $this->slugify->generate($episode->getTitle());
            $episode->setSlug($slug);
            $manager->persist($episode);
            $this->addReference('episode_' . $key, $episode);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }

}
