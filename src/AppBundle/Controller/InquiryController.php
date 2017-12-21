<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\InquiryType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/inquiry")
 */
class InquiryController extends Controller
{

    /**
     *
     * @method ("GET")
     * @Route("/input")
     */
    public function inputAction()
    {
        $form = $this->createForm(InquiryType::class);

        return $this->render('default/inquiry.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     *
     * @method ("POST")
     * @Route("/input")
     */
    public function inputPostAction(Request $request)
    {
        $form = $this->createForm(InquiryType::class);
        $form->handleRequest($request);

        if ($form->isValid()) return $this->redirect($this->generateUrl('inquiry.complete'));

        return $this->render('default/inquiry.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/complete", name="inquiry.complete")
     */
    public function completeAction()
    {
        return $this->render('default/complete.html.twig');
    }
}