<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Criteria\IdCriteriaBuilder;

class AdminController extends Controller
{
    /**
     * @Route("/admin/index")
     */
    public function indexAction()
    {
        //$inquiries = $this->getDoctrine()->getRepository('AppBundle:Inquiry')->findAll();

        $inquiries = $this->get('app.inquiry_repository')->findAll();

        return $this->render(
            'admin/index.html.twig',
            array('inquiryList' => $inquiries, 1)
            );
    }

    /**
     * @Route("/admin/get/{id}", name="inquiry.get")
     */
    public function getAction(int $id)
    {
        $inquiry = $this->get('app.inquiry.get_one')->run(new IdCriteriaBuilder($id, false));
        dump($inquiry); exit();


    }
}