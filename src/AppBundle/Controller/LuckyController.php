<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Inquiry;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = rand(0, 100);

        $inquiry = new Inquiry();
        $inquiry->setName("ありまろ");
        $inquiry->setEmail("arimoto@n-di.co.jp");
        $inquiry->setTel("09099998888");
        $inquiry->setType("A");
        $inquiry->setContent("Test-{$number}");

        $em = $this->getDoctrine()->getManager();
        $em->persist($inquiry);
        $em->flush();



        return $this->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $number)
            );

        /*
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
            );
            */
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new Response(
            json_encode($data),
            200,
            array('Content-Type' => 'application/json')
            );
    }

    /**
     * @Route("/lucky/doctrine")
     */
    public function doctorineAction()
    {
        $number = rand(0, 100);

        return $this->render(
            'lucky/number.html.twig',
            array('luckyNumberList' => $number)
            );

    }





}