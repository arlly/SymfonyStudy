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
     *         @Route("/admin/index")
     */
    public function indexAction()
    {
        $inquiries = $this->get('app.inquiry_repository')->findAll();
        
        return $this->render('admin/index.html.twig', array(
            'inquiryList' => $inquiries,
            'form' => $this->createInquiryForm()
                ->createView()
        ));
    }

    /**
     *
     * @method ("POST")
     *         @Route("/admin/index")
     */
    public function postAction(Request $request)
    {
        $form = $this->createInquiryForm();
        $form->handleRequest($request);
        
        $query = $this->get('app.inquiry.search')->run(new InquiryCriteriaBuilder($request->request));
        $paginator = new Paginator($query);
        dump($paginator->getIterator()->getArrayCopy());
        exit();
    }

    /**
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