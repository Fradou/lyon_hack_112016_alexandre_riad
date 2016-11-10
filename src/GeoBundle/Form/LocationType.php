<?php

namespace GeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('typeDetail')
            ->add('name')
            ->add('address')
            ->add('postalcode')
            ->add('town')
            ->add('phone')
            ->add('mail')
            ->add('website')
            ->add('facebook')
            ->add('rank')
            ->add('openhour')
            ->add('rateclear')
            ->add('minrate')
            ->add('maxrate')
            ->add('producer')
            ->add('latitude')
            ->add('longitude')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GeoBundle\Entity\Location'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'geobundle_location';
    }


}
