<?php

namespace Piface\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 02/03/2017
 * Time: 10:45
 */
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'required' => true,
                'label' => 'Nom'
            ))
            ->add('firstname', 'text', array(
                'required' => true,
                'label' => 'Prénom'
            ))
            ->add('birthday', 'date', array(
                'required' => true,
                'label' => 'Date de naissance',
                'years' => range(1920, date('Y'))
            ))
            ->add('sexe', 'choice', array(
                'required' => true,
                'label' => 'Sexe',
                'choices' => array(1 => 'Homme', 0 => 'Femme'),
                'multiple' => false,
                'expanded' => true
            ));

    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}
