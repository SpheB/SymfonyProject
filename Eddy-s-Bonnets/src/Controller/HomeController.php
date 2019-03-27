<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('home/looks.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
     //si j'ai le temps???
     /**
     * @Route("/news", name="news")
     */
    public function news()
    {
        return $this->render('home/news.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
     /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
