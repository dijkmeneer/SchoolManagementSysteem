<?php

namespace App\Form;

use App\Entity\Klas;
use App\Entity\Leraar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KlasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('naam')
            ->add('leraar', EntityType::class, [
                'class' => Leraar::class,
                'choice_label' => 'naam',
                'multiple' => true,
                'attr' => ['class' => 'select2'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Klas::class,
        ]);
    }
}
