<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\News;
use App\Entity\Look;
use App\Entity\Style;

use App\Form\MailType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
     /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('home/about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
    //peut être autre controller pour looks???
     /**
     * @Route("/looks", name="looks")
     */
    public function looks()
    {
        
        $em = $this->getDoctrine()->getManager();
        $replook = $em->getRepository(Look::class);
        $meslooks = $replook->findAll();

        $em2 = $this->getDoctrine()->getManager();
        $repstyle = $em2->getRepository(Style::class);
        
        
        //dump($meslooks);
        //die();
        foreach ($meslooks as $value) {
           
        $monstyle = $value->getIdStyle();
        //dump($monstyle);
        //die();
        $nbr = $monstyle->getId();
        //dump($nbr);
        //die(); 
        $monstylecomplet = $repstyle->find($nbr);
        //dump($monstylecomplet);
        //die();
        $value->setIdStyle($monstylecomplet);
        }
                
        $vars = ['meslooks' => $meslooks];
        //dump($vars);
        //die();
        
        return $this->render('home/looks.html.twig', $vars);
        
    }
    
     /**
     * @Route("/news", name="news")
     */
    public function news()
    {

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository(News::class);
            $mesnews = $rep->findAll();
            //dump($mesnews);
            //die();
                
            $var = ['mesnews' => $mesnews];

            return $this->render('/home/news.html.twig', $var);
            
    }
    
    
     /**
     * @Route("/contact", name="contact")
     */
    public function contact( \Swift_Mailer $mailer, Request $req)
    {
        $monFormulaire = $this->createForm(MailType::class,
                                            null,
                                           ['action'=>$this->generateUrl("contact"), 'method'=>'POST']);
        //dump($monFormulaire);
        //die();
        
        $monFormulaire->handleRequest($req);

        if ($monFormulaire->isSubmitted() && $monFormulaire->isValid()) {

            $message = (new \Swift_Message('Ed-s-message from ' . $monFormulaire->getData()["your_email"]))
                ->setFrom('developinterface3@gmail.com')
                ->setTo('sphe.bonnet@gmail.com')
                ->setBody("Message: " . $monFormulaire->getData()["message"] . " | Email: " . $monFormulaire->getData()["your_email"]);
            
            
            $mailer->send($message);
            
            return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            ]);
        }
        else{

            $vars = ['formulaireMail'=>$monFormulaire->createView()];
            return $this->render('home/contact.html.twig', $vars);
            
        }
    }    
        
    
        

}
