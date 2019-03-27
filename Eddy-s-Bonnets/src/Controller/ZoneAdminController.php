<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ZoneAdminController extends AbstractController
{
    /**
     * @Route("/zone/admin", name="zone_admin")
     */
    public function index()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    ///---gestion concours---
     /**
     * @Route("/zone/admin/concours/", name="zone_admin_concours")
     */
    public function concours()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/concours/creation", name="zone_admin_concoursCreation")
     */
    public function concoursCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/concours/update", name="zone_admin_concoursUpdate")
     */
    public function concoursUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/concours/delete", name="zone_admin_concoursDelete")
     */
    public function concoursDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    //---gestion looks---
     /**
     * @Route("/zone/admin/looks/", name="zone_admin_looks")
     */
    public function looks()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/looks/creation", name="zone_admin_looksCreation")
     */
    public function looksCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/looks/update", name="zone_admin_looksUpdate")
     */
    public function looksUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/looks/delete", name="zone_admin_looksDelete")
     */
    public function looksDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    //---gestion styles---
     /**
     * @Route("/zone/admin/styles/", name="zone_admin_styles")
     */
    public function styles()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/styles/creation", name="zone_admin_stylesCreation")
     */
    public function stylesCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/styles/update", name="zone_admin_stylesUpdate")
     */
    public function stylesUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/styles/delete", name="zone_admin_stylesDelete")
     */
    public function stylesDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    //---gestion news---
     /**
     * @Route("/zone/admin/news/", name="zone_admin_news")
     */
    public function news()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/news/creation", name="zone_admin_newsCreation")
     */
    public function newsCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/news/update", name="zone_admin_newsUpdate")
     */
    public function newsUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/news/delete", name="zone_admin_newsDelete")
     */
    public function newsDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    //---gestion fans---
     /**
     * @Route("/zone/admin/fans/", name="zone_admin_fans")
     */
    public function fans()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fans/creation", name="zone_admin_fansCreation")
     */
    public function fansCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fans/update", name="zone_admin_fansUpdate")
     */
    public function fansUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fans/delete", name="zone_admin_fansDelete")
     */
    public function fansDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
    
    
    
    
    //---gestion fanComments---
     /**
     * @Route("/zone/admin/fan/comments", name="zone_admin_fanComments")
     */
    public function fanComments()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fan/comments/creation", name="zone_admin_fanCommentsCreation")
     */
    public function fanCommentsCreation()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fan/comments/update", name="zone_admin_fanCommentsUpdate")
     */
    public function fanCommentsUpdate()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }
    
     /**
     * @Route("/zone/admin/fan/comments", name="zone_admin_fanCommentsDelete")
     */
    public function fanCommentsDelete()
    {
        return $this->render('zone_admin/index.html.twig', [
            'controller_name' => 'ZoneAdminController',
        ]);
    }

}
