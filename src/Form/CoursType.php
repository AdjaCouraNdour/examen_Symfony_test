<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Niveau;
use App\Entity\Classe;
use App\Entity\Professeur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CoursType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    // Injection de l'EntityManager dans le formulaire
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du Cours',
                'required' => true,
                'attr' => [
                    'class' => 'text-sm p-2 border rounded w-full',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre du cours est obligatoire.',
                    ]), 
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => [
                    'class' => 'text-sm p-2 border rounded w-full',
                ],
            ])
            ->add('niveau', ChoiceType::class, [
                'label' => 'Niveau',
                'choices' => $this->getNiveauxChoices(),
                'required' => true,
                'attr' => [
                    'class' => 'text-sm p-2 border rounded w-full',
                ],
            ])
            ->add('classe', ChoiceType::class, [
                'label' => 'Classe',
                'choices' => $this->getClassesChoices(),
                'required' => true,
                'attr' => [
                    'class' => 'text-sm p-2 border rounded w-full',
                ],
            ])
            ->add('professeur', ChoiceType::class, [
                'label' => 'Professeur',
                'choices' => $this->getProfesseursChoices(),
                'required' => true,
                'attr' => [
                    'class' => 'text-sm p-2 border rounded w-full',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary my-2 my-sm-0',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }

    private function getNiveauxChoices(): array
    {
        $niveaux = $this->entityManager->getRepository(Niveau::class)->findAll();
        $choices = [];
        foreach ($niveaux as $niveau) {
            $choices[$niveau->getNom()] = $niveau->getId();
        }
        return $choices;
    }

    private function getClassesChoices(): array
    {
        $classes = $this->entityManager->getRepository(Classe::class)->findAll();
        $choices = [];
        foreach ($classes as $classe) {
            $choices[$classe->getNom()] = $classe->getId();
        }
        return $choices;
    }

    private function getProfesseursChoices(): array
    {
        $professeurs = $this->entityManager->getRepository(Professeur::class)->findAll();
        $choices = [];
        foreach ($professeurs as $professeur) {
            $choices[$professeur->getNom()] = $professeur->getId();
        }
        return $choices;
    }
}
