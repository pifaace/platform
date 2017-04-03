<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/04/2017
 * Time: 10:41
 */

namespace Piface\AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FiltreAdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', 'entity', array(
                'label' => 'Catégorie',
                'class' => 'Piface\AppBundle\Entity\Category',
                'placeholder' => 'Toutes les catégories',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => false
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'piface_appbundle_filtered_advert';
    }
}
