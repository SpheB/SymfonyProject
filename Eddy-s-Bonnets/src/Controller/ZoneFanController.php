<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ZoneFanController extends AbstractController
{
    /**
     * @Route("/zone/fan", name="zone_fan")
     */
    public function index()
    {
        return $this->render('zone_fan/index.html.twig', [
            'controller_name' => 'ZoneFanController',
        ]);
    }
    
    /**
     * @Route("/zone/profile", name="profile")
     */
    public function profile()
    {
        return $this->render('zone_fan/profile.html.twig', [
            'controller_name' => 'ZoneFanController',
        ]);
    }
    
     /**
     * @Route("/zone/profile/update", name="profileUpdate")
     */
    public function profileUpdate()
    {
        return $this->render('zone_fan/profile.html.twig', [
            'controller_name' => 'ZoneFanController',
        ]);
    }
    
    //ici les concours ne peuvent être vus ET participés par Fans connectés. Si peuvent être vus par tous peut-être changer de place???
     /**
     * @Route("/zone/concours", name="concours")
     */
    public function concours()
    {
        return $this->render('zone_fan/profile.html.twig', [
            'controller_name' => 'ZoneFanController',
        ]);
    }
}
