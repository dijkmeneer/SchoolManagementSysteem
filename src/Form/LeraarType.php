<?php

namespace App\Form;

use App\Entity\Klas;
use App\Entity\Leraar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LeraarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('naam')
            ->add('leeftijd')
            ->add('klas', EntityType::class, [
                'class' => Klas::class,
                'choice_label' => 'naam',
                'multiple' => true,
                'by_reference' => false,
                'help' => 'Tip: gebruik control/command en klik om meerdere klassen te selecteren',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Leraar::class,
        ]);
    }
}
