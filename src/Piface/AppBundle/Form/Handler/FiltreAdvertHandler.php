<?php
/**
 * Created by PhpStorm.
 * User: maxime.joassy
 * Date: 03/04/2017
 * Time: 14:19
 */

namespace Piface\AppBundle\Form\Handler;


use Doctrine\ORM\EntityManager;
use Piface\AppBundle\Entity\Advert;
use Piface\AppBundle\Manager\AdvertManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FiltreAdvertHandler
{
    /**
     * @var FormInterface
     */
    protected $form;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var EntityManager
     */
    protected $advertManager;

    public function __construct(Request $request, AdvertManager $advertManager)
    {
        $this->request = $request;
        $this->advertManager = $advertManager;
    }

    /**
     * @param FormInterface $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    public function process()
    {
        $adverts = null;

        if ($this->form->isValid()) {
            $data = $this->form->getData();

            $keyWord = $data['kw'];
            $category = $data['category'];


            if (null == $category && null == $keyWord) {
                $adverts = $this->advertManager->getRepository()->findAll();
            }

            if (null == $category && null != $keyWord) {
                $adverts = $this->advertManager->getRepository()->findByKeyWord($keyWord);
            }

            if (null != $category && null == $keyWord) {
                $adverts = $this->advertManager->getRepository()->findBy(
                    array('category' => $category)
                );
            }

            if(null != $category && null != $keyWord){
                $adverts = $this->advertManager->getRepository()->findByOptions($category, $keyWord);
            }

            return $adverts;
        }

        return false;
    }


}
