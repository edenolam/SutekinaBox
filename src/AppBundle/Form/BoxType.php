<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoxType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('theme', ChoiceType::class,
                [
                    'choices' => [
                        'Choisissez un thème' => null,
                        'Noël' =>'noel',
                        'Hanouka' => 'hanouka',
                        'Halloween' => 'halloween'
                    ]
                ])
            ->add('price')
            ->add('status')
            ->add('products', EntityType::class,
                [
                    'class' => 'AppBundle\Entity\Product',
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Box'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_box';
    }


}
