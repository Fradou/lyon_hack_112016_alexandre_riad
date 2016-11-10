<?php

namespace GeoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', null, array('label' => 'Prénom :'))
            ->add('lastName', null, array('label' => 'Nom :'))
            ->add('country', null, array('label' => 'Pays :'))
            ->add('city', null, array('label' => 'Ville :'))
            ->add('language', null, array('label' => 'Langue :'));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'geo_user_registration';
    }

    public function getCountry() {
        return $this->getBlockPrefix();
    }

    public function getCity() {
        return $this->getBlockPrefix();
    }

    public function getLanguage() {
        return $this->getBlockPrefix();
    }

}