<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Concours;
use App\Entity\Look;

class ZoneAdminController extends AbstractController {

    /**
     * @Route("/zone/admin", name="zone_admin")
     */
    public function index() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    ///---gestion concours---
    /**
     * @Route("/zone/admin/concours/all", name="zone_admin_concours_all")
     */
    public function concoursAll() {
        $em = $this->getDoctrine()->getManager();
        $repconcours = $em->getRepository(Concours::class);
        //$replook = $em->getRepository(Look::class);

        //je m'occupe de tous les concours
        $lesconcours = $repconcours->findAll();

        //je récupère le look gagnant pour que la propriété look soit complète....mais à pas l'air d'en avoir besoin? Je le commente donc
        //foreach ($lesconcours as $value) {
        //    if ($value->getGagnant() != null) {
        //        $monlookGagnant = $value->getGagnant();
                //dump($monstyle);
                //die();
         //       $nbr = $monlookGagnant->getId();
                //dump($nbr);
                //die(); 
        //        $monlookGagnantcomplet = $replook->find($nbr);
                //dump($monstylecomplet);
                //die();
         //       $value->setGagnant($monlookGagnantcomplet);
         //   }
        //}

        $vars = ['lesconcours' => $lesconcours];
        return $this->render('zone_admin/adminConcours.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/concours/creation", name="zone_admin_concoursCreation")
     */
    public function concoursCreation() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/concours/one/{idconcours}", name="zone_admin_concours/one")
     */
    public function concoursOne(Request $req) {
        
        //dump($req);
        //die();
        
        $em = $this->getDoctrine()->getManager();
        $repconcours = $em->getRepository(Concours::class);
        $replook = $em->getRepository(Look::class);
        
        $nbr = $req->get('idconcours');
      
        $monconcours = $repconcours->find($nbr);
        dump($monconcours);
        $meslooksduconcours = $replook->findByConcours($monconcours);
        dump('meh', $meslooksduconcours);
        die();
        
        $vars = ['concours' => $monconcours];
        dump($vars);
        //die();
        
        return $this->render('zone_admin/adminConcoursOne.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/concours/delete", name="zone_admin_concoursDelete")
     */
    public function concoursDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion looks---
    /**
     * @Route("/zone/admin/looks/", name="zone_admin_looks")
     */
    public function looks() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/looks/creation", name="zone_admin_looksCreation")
     */
    public function looksCreation() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/looks/update", name="zone_admin_looksUpdate")
     */
    public function looksUpdate() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/looks/delete", name="zone_admin_looksDelete")
     */
    public function looksDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion styles---
    /**
     * @Route("/zone/admin/styles/", name="zone_admin_styles")
     */
    public function styles() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/styles/creation", name="zone_admin_stylesCreation")
     */
    public function stylesCreation() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/styles/update", name="zone_admin_stylesUpdate")
     */
    public function stylesUpdate() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/styles/delete", name="zone_admin_stylesDelete")
     */
    public function stylesDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion news---
    /**
     * @Route("/zone/admin/news/", name="zone_admin_news")
     */
    public function news() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/news/creation", name="zone_admin_newsCreation")
     */
    public function newsCreation() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/news/update", name="zone_admin_newsUpdate")
     */
    public function newsUpdate() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/news/delete", name="zone_admin_newsDelete")
     */
    public function newsDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion fans---
    /**
     * @Route("/zone/admin/fans/", name="zone_admin_fans")
     */
    public function fans() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/fans/creation", name="zone_admin_fansCreation")
     */
    public function fansCreation() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/fans/update", name="zone_admin_fansUpdate")
     */
    public function fansUpdate() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/fans/delete", name="zone_admin_fansDelete")
     */
    public function fansDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion fanComments---
    /**
     * @Route("/zone/admin/fan/comments", name="zone_admin_fanComments")
     */
    public function fanComments() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/fan/comments", name="zone_admin_fanCommentsDelete")
     */
    public function fanCommentsDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

}
