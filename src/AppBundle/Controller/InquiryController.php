<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\InquiryType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Inquiry;

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
        $form = $this->createForm(InquiryType::class, new Inquiry());

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
        $form = $this->createForm(InquiryType::class, new Inquiry());
        $form->handleRequest($request);

        if (! $form->isValid()) return $this->render('default/inquiry.html.twig', ['form' => $form->createView()]);

        $inquiry = $form->getData();
        $this->get('app.inquiry.create')->run($inquiry);


        $this->get('app.send_mail')->run('Webからのお問合せ',
                                         'arimoto@n-di.co.jp',
                                         'arlly1003@gmail.com',
                                          $this->renderView('mail/inquiry.txt.twig', ['data' => $inquiry]));

        return $this->redirect($this->generateUrl('inquiry.complete'));
    }

    /**
     * @Route("/complete", name="inquiry.complete")
     */
    public function completeAction()
    {
        return $this->render('default/complete.html.twig');
    }
}