<?php

namespace App\Form;

use App\Entity\Karper;
use App\Entity\Kweker;
use App\Entity\Soort;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KarperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', TextType::class)
            ->add('maat', NumberType::class)
            ->add('prijs', NumberType::class)
            ->add('leeftijd', IntegerType::class)
            ->add('soort', EntityType::class, [
                'class' => Soort::class,
                'choice_label' => 'naam'
            ])
            ->add('kweker', EntityType::class, [
                'class' => Kweker::class,
                'choice_label' => 'naam'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Karper::class,
        ]);
    }
}
