<?php

namespace Piface\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', 'text', array(
                'label' => 'Adresse'
            ))
            ->add('additionalAddress', 'text', array(
                'label' => 'Adresse additionnelle'
            ))
            ->add('postalCode', 'text', array(
                'label' => 'Code postal'
            ))
            ->add('town', 'text', array(
                'label' => 'Ville'
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piface\AppBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'piface_appbundle_address';
    }


}
