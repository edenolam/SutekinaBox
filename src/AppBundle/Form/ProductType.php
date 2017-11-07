<?php

namespace AppBundle\Form;

use AppBundle\Entity\Box;
use AppBundle\Entity\Image;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pattern = '%';// possibilite de filtrer les categories par leur nom
        $builder
            ->add('name',TextType::class)
            ->add('price')
            ->add('isAvailable', CheckboxType::class, [
                'required' => false
            ])
            ->add('categories', EntityType::class, [
                'class' => 'AppBundle:Category',
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'query_builder' => function(CategoryRepository $repository) use($pattern){
                return $repository->getLikeQueryBuilder($pattern);
                }
            ])
           // ->add('image', ImageType::class)

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_product';
    }


}
