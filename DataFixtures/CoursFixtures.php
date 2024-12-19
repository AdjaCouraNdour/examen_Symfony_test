<?php

namespace App\DataFixtures;

use App\Entity\Cours;
use App\Entity\Niveau;
use App\Entity\Classe;
use App\Entity\Professeur;
use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de niveaux
        for ($i = 1; $i <= 3; $i++) {
            $niveau = new Niveau();
            $niveau->setNom("Niveau $i");
            $manager->persist($niveau);

            // Création des classes pour chaque niveau
            for ($j = 1; $j <= 3; $j++) {
                $classe = new Classe();
                $classe->setNom("Classe $j de Niveau $i");
                $manager->persist($classe);

                // Création des professeurs pour chaque niveau et classe
                for ($k = 1; $k <= 2; $k++) {
                    $professeur = new Professeur();
                    $professeur->setNom("Professeur $k");
                    $professeur->setPrenom("NomProfesseur $k");
                    $manager->persist($professeur);

                    // Création des modules
                    $module = new Module();
                    $module->setNom("Module $k");
                    $manager->persist($module);

                    // Création des cours
                    $cours = new Cours();
                    $cours->setProfesseur($professeur);
                    $cours->setModule($module);
                    $cours->setNiveau($niveau);
                    $cours->addClasse($classe);  // Associer la classe au cours
                    $manager->persist($cours);
                }
            }
        }

        $manager->flush();
    }
}
