<?php


namespace App\Form\Type;


use App\Entity\Kweker;
use App\Entity\Leeftijd;
use App\Entity\Maat;
use App\Entity\Soort;
use App\Repository\SoortRepository;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class KarperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam', TextType::class)
            ->add('prijs', MoneyType::class)
            ->add('soort', EntityType::class, [
                'class' => Soort::class,
                'choice_label' => function (Soort $soort) {
                    return sprintf ('%i %s', $soort->getId(), $soort->getNaam());
                }
            ])
            ->add('kweker', EntityType::class, [
                'class' => Kweker::class,
                'choice_label' => function (Kweker $kweker) {
                    return sprintf ('%i %s', $kweker->getId(), $kweker->getNaam());
                }
            ])
            ->add('leeftijd', EntityType::class, [
                'class' => Leeftijd::class,
                'choice_label' => function (Leeftijd $leeftijd) {
                    return sprintf ('%i %s', $leeftijd->getId(), $leeftijd->getNaam());
                }
            ])
            ->add('maat', EntityType::class, [
                'class' => Maat::class,
                'choice_label' => function (Maat $maat) {
                    return sprintf ('%i %s', $maat->getId(), $maat->getNaam());
                }
            ])
            ->add('image', TextType::class)
            ->add('toevoegen', SubmitType::class);
    }

}