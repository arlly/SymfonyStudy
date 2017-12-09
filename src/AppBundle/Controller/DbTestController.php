<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DbTestController extends Controller
{
    /**
     * @Route("/dbtest/")
     */
    public function indexAction()
    {
        echo "Hello!!";
    }
}
