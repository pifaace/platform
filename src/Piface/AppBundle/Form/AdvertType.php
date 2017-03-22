<?php

namespace Piface\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', 'entity', array(
                'label' => 'Categorie',
                'class' => 'Piface\AppBundle\Entity\Category',
                'placeholder' => 'Choisissez une catégorie',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('title', 'text', array(
                'label' => 'Titre'
            ))
            ->add('content', 'textarea', array(
                'label' => 'Contenu'
            ))
            ->add('prix', 'text', array(
                'label' => 'Prix'
            ))
            ->add('image', new ImageType(), array(
                'label' => false
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Piface\AppBundle\Entity\Advert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'piface_appbundle_advert';
    }


}
