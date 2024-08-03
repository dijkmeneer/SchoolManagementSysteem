<?php

namespace App\Form;

use App\Entity\Foto;
use App\Entity\Klas;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('naam')
            ->add('leeftijd')
            ->add('foto', FileType::class, [
                'mapped' => false,
            ])
            ->add('klas', EntityType::class, [
                'class' => klas::class,
                'choice_label' => 'naam',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
