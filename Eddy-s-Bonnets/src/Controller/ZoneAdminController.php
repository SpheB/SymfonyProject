<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Concours;
use App\Entity\Look;
use App\Form\ConcoursCreation2Type;
use App\Form\LooksCreationType;

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
    public function concoursCreation(Request $request) {

        $concours = new Concours();
        $form = $this->createForm(ConcoursCreation2Type::class, $concours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($concours);die;
            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concours);
            $entityManager->flush();


            //return redirectoaction tous concours
            return $this->redirect("/zone/admin/concours/all");
        } else {

            $vars = ['formulaireConcours' => $form->createView()];
            return $this->render('zone_admin/concoursCreation.html.twig', $vars);
        }
    }

    /**
     * @Route("/zone/admin/concours/one/{idconcours}", name="zone_admin_concours/one")
     */
    public function concoursOne(Request $req) {
        //dump($req);
        //die();
        $em = $this->getDoctrine()->getManager();
        $repconcours = $em->getRepository(Concours::class);

        $nbr = $req->get('idconcours');
        $monconcours = $repconcours->find($nbr);

        foreach ($monconcours->getLooks() as $l) {
            dump($l);
        }

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
     * @Route("/zone/admin/looks/all", name="zone_admin_looks_all")
     */
    public function looksAll() {

        $em = $this->getDoctrine()->getManager();
        $replooks = $em->getRepository(Look::class);

        $leslooks = $replooks->findAll();

        $vars = ['leslooks' => $leslooks];
        return $this->render('zone_admin/adminLooks.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/looks/creation", name="zone_admin_looksCreation")
     */
    public function looksCreation(Request $req) {
        $look = new Look();
        $look->setLikes(0);
        $form = $this->createForm(LooksCreationType::class, $look);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($concours);die;
            
            //gère l'image du look
            $fichier = $look->getPicture();
            
           
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            
            
            $look->setPicture($nomFichierServeur);
      
            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($look);
            $entityManager->flush();

            //return redirectoaction tous concours
            return $this->redirect("/zone/admin/looks/all");
        } else {

            $vars = ['formulaireLook' => $form->createView()];
            return $this->render('zone_admin/lookCreation.html.twig', $vars);
        }
    }

    /**
     * @Route("/zone/admin/looks/one/{idlook}", name="zone_admin_looksUpdate")
     */
    public function looksUpdate(Request $req) {
        //dump($req);
        //die();
        $em = $this->getDoctrine()->getManager();
        $replook = $em->getRepository(Look::class);

        $nbr = $req->get('idlook');
        $monlook = $replook->find($nbr);


        $vars = ['look' => $monlook];
        dump($vars);
        //die();

        return $this->render('zone_admin/adminLookOne.html.twig', $vars);
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
