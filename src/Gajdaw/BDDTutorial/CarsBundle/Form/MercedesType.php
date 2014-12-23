<?php

namespace Gajdaw\BDDTutorial\CarsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MercedesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('length')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gajdaw\BDDTutorial\CarsBundle\Entity\Mercedes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gajdaw_bddtutorial_carsbundle_mercedes';
    }
}
