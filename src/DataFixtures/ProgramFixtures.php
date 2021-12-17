<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = [
        [
            'title' => 'The Big Bang Theory',
            'synopsis' => 'Leonard Hofstadter et Sheldon Cooper vivent en colocation à Pasadena, ville de l\'agglomération de Los Angeles.',
            'poster' => 'blablabla',
            'country'=> 'USA',
            'year' => 2002,
        ],[
            'title' => 'Utopia',
            'synopsis' => 'Becky, Ian, Grant, Wilson et Bejan sont membres d\'un forum de discussion regroupant des personnes en possession d\'une bande dessinée intitulée Utopia',
            'poster' => 'blablabla',
            'country'=> 'UK',
            'year' => 2002,
        ],[
            'title' => 'The Witcher',
            'synopsis' => 'oui ben on connait',
            'poster' => 'blablabla',
            'country'=> 'UK',
            'year' => 2002, 
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $programs) {
            $program = new Program();
            $program->setTitle($programs['title']);
            $program->setSynopsis($programs['synopsis']);
            $program->setPoster($programs['poster']);
            $program->setCountry($programs['country']);
            $program->setYear($programs['year']);
            $program->setCategory($this->getReference('category_0'));
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
                $program->addActor($this->getReference('actor_' . $i));
            }

            $manager->persist($program);
            $this->addReference('program_' . $key, $program);
        }
        
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }

}
