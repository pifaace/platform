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
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreAdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('kw', 'text', array(
                'label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => "Que recherchez-vous ?"
                )
            ))
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'filter';
    }
}
