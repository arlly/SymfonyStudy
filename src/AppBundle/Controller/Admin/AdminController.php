<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Criteria\IdCriteriaBuilder;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Criteria\InquiryCriteriaBuilder;
use AppBundle\Controller\PaginatorTrait;
use Doctrine\ORM\Tools\Pagination\Paginator;
use AppBundle\Form\AdminInquiryType;

class AdminController extends Controller
{
    use PaginatorTrait;

    /**
     *
     * @method ("GET")
     * @Route("/admin/index", name="admin.index")
     */
    public function indexAction(Request $request)
    {
        //$query = $this->get('app.inquiry_repository')->findAll();
        $query = $this->get('app.inquiry.search')->run(new InquiryCriteriaBuilder($request->request));
        $inquiries = $this->getPaginatedResources($query, $request->query);

        return $this->render('admin/index.html.twig', array(
            'inquiryList' => $inquiries,
            'form' => $this->createInquiryForm()->createView()
        ));
    }

    /**
     *
     * @method ("POST")
     * @Route("/admin/index")
     */
    public function postAction(Request $request)
    {
        $form = $this->createInquiryForm();
        $form->handleRequest($request);

        $query = $this->get('app.inquiry.search')->run(new InquiryCriteriaBuilder($request->request));
        $inquiries = $this->getPaginatedResources($query, $request->query);
        dump($inquiries); exit();
        return $this->render('admin/index.html.twig', array(
            'inquiryList' => $inquiries,
            'form' => $this->createInquiryForm()->createView()
        ));
    }

    /**
     * @method ("GET")
     * @Route("/admin/get/{id}", name="inquiry.get")
     */
    public function getAction(int $id)
    {
        $inquiry = $this->get('app.inquiry.get_one')->run(new IdCriteriaBuilder($id, false));

        $form = $this->createForm(AdminInquiryType::class, $inquiry);

        return $this->render('admin/inquiry/edit.html.twig', array(
            'inquiry' => $inquiry,
            'form' => $form->createView()
        ));
    }

    /**
     * @method ("POST")
     * @Route("/admin/get/{id}", name="inquiry.edit")
     */
    public function editAction(int $id, Request $request)
    {
        $inquiry = $this->get('app.inquiry.get_one')->run(new IdCriteriaBuilder($id, false));
        $form = $this->createForm(AdminInquiryType::class, $inquiry);
        $form->handleRequest($request);

        if (! $form->isValid()) {
            return $this->render('admin/inquiry/edit.html.twig', array(
                'inquiry' => $inquiry,
                'form' => $form->createView()
            ));
        }

        $this->get('app.inquiry.update')->run($inquiry);

        return $this->redirect($this->generateUrl('admin.index'));
    }

    /**
     * @method ("GET")
     * @Route("/admin/remove/{id}", name="inquiry.remove")
     */
    public function removeAction(int $id)
    {
        $inquiry = $this->get('app.inquiry.get_one')->run(new IdCriteriaBuilder($id, false));
        $this->get('app.inquiry.remove')->run($inquiry);

        return $this->redirect($this->generateUrl('admin.index'));
    }

    private function createInquiryForm()
    {
        return $this->createFormBuilder()
            ->add('q', TextType::class)
            ->add('search', SubmitType::class, array(
            'label' => '検索する'
        ))
            ->getForm();
    }
}