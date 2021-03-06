<?php


namespace App\Form;


use App\Entity\MinimumRequirements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MinimumRequirementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oS', TextType::class, [
                'label' => 'OS'
            ])
            ->add('processor')
            ->add('memory')
            ->add('graphics')
            ->add('diskSpace')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
          'data_class' => MinimumRequirements::class
       ]);
    }
}