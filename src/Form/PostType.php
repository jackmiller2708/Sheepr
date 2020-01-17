<?php

namespace App\Form;

use App\Entity\Genre;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Title goes here...'
                ]
            ])
            ->add('content')
            ->add('minimumRequirements',  MinimumRequirementsType::class,[
            ])
            ->add('recommendedRequirements',  RecommendedRequirementsType::class,[
            ])
            ->add('links', LinkType::class)
            ->add('Genre', EntityType::class,[
                'class' => Genre::class,
                'expanded' => true,
                'multiple' => true,
                'choice_label' => 'name'
            ])
            ->add('posterFile', FileType::class, [
                'mapped' => false,
                'label' => 'Choose a poster image...',
                'attr' => [
                    'class' => 'file-input'
                ],
                'label_attr' => [
                    'class' => 'file-input-trigger',
                    'id' => 'poster-input-trigger'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
