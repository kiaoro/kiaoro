<?php

namespace Naissance\ApplicationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WishlistType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_id', 'choice', array(
                'label' => 'Type', 
                'data' => '1', 
                'choices'   => array(
                    '1' => 'foo', 
                    '2' => 'bar'
                ),
                'required'  => true,
                'expanded' => true,
                'multiple' => false, 
            ))
            ->add('title')
            ->add('date', 'date')
            ->add('message', 'textarea')
            ->add('address')
            ->add('zip_code')
            ->add('city')
            ->add('country')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Naissance\ApplicationBundle\Entity\Wishlist'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'naissance_applicationbundle_wishlist';
    }
}
