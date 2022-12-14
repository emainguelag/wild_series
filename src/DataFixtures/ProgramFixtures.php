<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slug;

    const SERIES = [
        ['title' => 'PeakyBlinders', 'synopsis' => 'Fondée sur l\'histoire du gang des Peaky Blinders, actif à la fin du xixe siècle, cette série suit un groupe de gangsters de Birmingham à partir de 1919.', 'poster' => 'https://upload.wikimedia.org/wikipedia/fr/e/e8/Peaky_Blinders_titlecard.jpg', 'reference' => 'category_Action'],
        ['title' => 'The Crown', 'synopsis' => 'Au fil des décennies, des intrigues personnelles, des romances, et des rivalités politiques, la reine Élisabeth II continue de régner malgré les difficultés.', 'poster' => 'https://upload.wikimedia.org/wikipedia/fr/6/6f/The_Crown_Logo.jpg', 'reference' => 'category_Aventure'],
        ['title' => 'The Walking Dead', 'synopsis' => 'La série commence après les ravages d\'une apocalypse causée par un virus transformant les humains infectés en zombies.', 'poster' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ef/The_Walking_Dead_2010_logo.svg/langfr-1920px-The_Walking_Dead_2010_logo.svg.png', 'reference' => 'category_Horreur'],
        ['title' => 'Stranger Things', 'synopsis' => 'la ville est le théâtre de phénomènes surnaturels liés au Laboratoire national de Hawkins', 'poster' => 'https://upload.wikimedia.org/wikipedia/fr/6/67/StrangerThingslogo.png', 'reference' => 'category_Fantastique'],
        ['title' => 'Yu-Gi-Oh!', 'synopsis' => 'Le manga met en scène Yûgi Muto, un jeune lycéen timide et expert en jeux.', 'poster' => 'https://upload.wikimedia.org/wikipedia/fr/a/a5/Yu-Gi-Oh_Logo.JPG', 'reference' => 'category_Animation'],
        ['title' => 'fyfy21', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Animation'],
        ['title' => 'fyfy31', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Animation'],
        ['title' => 'fyfy41', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Animation'],
        ['title' => 'fyfy22', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Fantastique'],
        ['title' => 'fyfy32', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Fantastique'],
        ['title' => 'fyfy42', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Fantastique'],
        ['title' => 'fyfy23', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Horreur'],
        ['title' => 'fyfy33', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Horreur'],
        ['title' => 'fyfy43', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Horreur'],
        ['title' => 'fyfy24', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Aventure'],
        ['title' => 'fyfy34', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Aventure'],
        ['title' => 'fyfy44', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Aventure'],
        ['title' => 'fyfy25', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Action'],
        ['title' => 'fyfy35', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Action'],
        ['title' => 'fyfy45', 'synopsis' => 'ftfyu', 'poster' => '', 'reference' => 'category_Action'],
    ];

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        /*
        $program = new Program();  
        $program->setTitle('PeakyBlinders');  
        $program->setSynopsis('Fondée sur l\'histoire du gang des Peaky Blinders, actif à la fin du xixe siècle, cette série suit un groupe de gangsters de Birmingham à partir de 1919. Cette bande, emmenée par l\'ambitieux et dangereux Thomas Shelby et formée de sa fratrie, pratique le racket, la protection, la contrebande d\'alcool et de tabac et les paris illégaux. Un vol d\'armes automatiques, dont ils sont les premiers soupçonnés, pousse Winston Churchill à dépêcher sur place l\'inspecteur en chef Chester Campbell, officier de la police royale irlandaise qui emporte avec lui certaines méthodes expéditives…');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();
        */


        foreach(self::SERIES as $keys => $values) {
            $program = new Program();

            $program->setTitle($values['title']);

            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);

            $program->setSynopsis($values['synopsis']);
            $program->setPoster($values['poster']);
            $program->setCategory($this->getReference($values['reference']));
            $manager->persist($program);
            $this->addReference('program_' . $keys, $program);
        }
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
