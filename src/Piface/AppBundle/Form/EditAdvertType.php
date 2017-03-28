<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 28/03/2017
 * Time: 15:27
 */

namespace Piface\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditAdvertType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'piface_appbundle_advert_edit';
    }

    public function getParent()
    {
        return new AdvertType();
    }
}
