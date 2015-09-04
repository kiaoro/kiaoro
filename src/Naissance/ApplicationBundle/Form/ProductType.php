<?php

namespace Naissance\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', 'textarea')
            ->add('price')
            ->add('currency', 'choice', array(
                'label' => 'Currency', 
                'data' => '1', 
                'choices'   => array(
                    '1' => 'EUR', 
                    '2' => 'USD'
                ),
                'required'  => true,
                'multiple' => false, 
            ))
            ->add('pageUrl')
            ->add('imageUrl')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Naissance\ApplicationBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'naissance_applicationbundle_product';
    }
}
