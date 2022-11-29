<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();  
        $program->setTitle('PeakyBlinders');  
        $program->setSynopsis('Fondée sur l\'histoire du gang des Peaky Blinders, actif à la fin du xixe siècle, cette série suit un groupe de gangsters de Birmingham à partir de 1919. Cette bande, emmenée par l\'ambitieux et dangereux Thomas Shelby et formée de sa fratrie, pratique le racket, la protection, la contrebande d\'alcool et de tabac et les paris illégaux. Un vol d\'armes automatiques, dont ils sont les premiers soupçonnés, pousse Winston Churchill à dépêcher sur place l\'inspecteur en chef Chester Campbell, officier de la police royale irlandaise qui emporte avec lui certaines méthodes expéditives…');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }
}
