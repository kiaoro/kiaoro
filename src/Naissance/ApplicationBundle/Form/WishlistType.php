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
            ->add('title', 'text')
            ->add('date', 'date', array(
                'input' => 'string', 
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd',
                'required'  => true,
                //'attr' => array('class' => 'input-group date'), 
            ))
            ->add('message', 'textarea')
            ->add('file', 'file')
            ->add('address', 'text')
            ->add('zip_code', 'text')
            ->add('city', 'text')
            ->add('country', 'text')
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
