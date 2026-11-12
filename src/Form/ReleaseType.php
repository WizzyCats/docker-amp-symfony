<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Release;
use App\Enum\ReleaseType as EnumReleaseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReleaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add(child:'type', type:ChoiceType::class, options: [
            'expanded' => true,
            'multiple' => false,
            'choices' => [
               'Album' => EnumReleaseType::Album->value,
               'Ep' => EnumReleaseType::EP->value,
               'Single' => EnumReleaseType::Single->value,
            ]
        ])
            ->add('type')
            ->add('title')
            ->add('releasedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('thumbnail')
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Release::class,
        ]);
    }
}
