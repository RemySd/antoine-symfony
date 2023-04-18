<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Matiere;
use App\Entity\Calendrier;
use App\Entity\Intervenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\DateTime;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateHeureCour_debut', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('dateHeureCour_fin', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('id_matiere', EntityType::class, [
                'class' => Matiere::class,
            ])
            ->add('id_calendrier', EntityType::class, [
                'class' => Calendrier::class,
            ])
            ->add('intervenant', EntityType::class, [
                'class' => Intervenant::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
            'csrf_protection' => false
        ]);
    }
}