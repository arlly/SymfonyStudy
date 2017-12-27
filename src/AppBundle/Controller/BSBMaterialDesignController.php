<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/bmb")
 */
class BSBMaterialDesignController extends Controller
{
    /**
     *
     * @method ("GET")
     * @Route("/index")
     */
    public function indexAction()
    {
        return $this->render('layout.html.twig');
    }

}
