<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Concours;
use App\Entity\Look;
use App\Entity\Style;
use App\Entity\News;
use App\Entity\Fan;
use App\Entity\FanComment;
use App\Form\ConcoursCreation2Type;
use App\Form\LooksCreationType;
use App\Form\StyleCreationType;
use App\Form\NewsCreationType;

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
     * @Route("/zone/admin/concours/one/{idconcours}", name="zone_admin_concours_one")
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
     * @Route("/zone/admin/concours/delete", name="zone_admin_concours_delete")
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
     * @Route("/zone/admin/looks/one/{idlook}", name="zone_admin_looks_one")
     */
    public function looksOne(Request $req) {
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
     * @Route("/zone/admin/styles/all", name="zone_admin_styles_all")
     */
    public function stylesAll() {

        $em = $this->getDoctrine()->getManager();
        $repstyle = $em->getRepository(Style::class);

        $lesstyles = $repstyle->findAll();

        $vars = ['lesstyles' => $lesstyles];
        return $this->render('zone_admin/adminStyles.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/styles/creation", name="zone_admin_stylesCreation")
     */
    public function stylesCreation(Request $req) {
        $style = new style();
        $form = $this->createForm(StyleCreationType::class, $style);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {

            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($style);
            $entityManager->flush();

            //return redirectoaction tous concours
            return $this->redirect("/zone/admin/styles/all");
        } else {

            $vars = ['formulaireStyle' => $form->createView()];
            return $this->render('zone_admin/styleCreation.html.twig', $vars);
        }
    }

    /**
     * @Route("/zone/admin/styles/one/{idstyle}", name="zone_admin_styles_one")
     */
    public function stylesOne(Request $req) {

        $em = $this->getDoctrine()->getManager();
        $repstyle = $em->getRepository(Style::class);

        $nbr = $req->get('idstyle');
        $monstyle = $repstyle->find($nbr);

        $vars = ['style' => $monstyle];
        //dump($vars);
        //die();

        return $this->render('zone_admin/adminStyleOne.html.twig', $vars);
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
     * @Route("/zone/admin/news/all", name="zone_admin_news_all")
     */
    public function newAll() {
        $em = $this->getDoctrine()->getManager();
        $repnews = $em->getRepository(News::class);

        $lesnews = $repnews->findAll();

        $vars = ['lesnews' => $lesnews];
        return $this->render('zone_admin/adminNews.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/news/creation", name="zone_admin_news_creation")
     */
    public function newsCreation(Request $req) {
        $news = new News();
        $form = $this->createForm(NewsCreationType::class, $news);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            //gère l'image de la news
            $fichier = $news->getPictureNews();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move("dossierFichiers", $nomFichierServeur);
            $news->setPictureNews($nomFichierServeur);

            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            //return redirectoaction tous concours
            return $this->redirect("/zone/admin/news/all");
        } else {

            $vars = ['formulaireNews' => $form->createView()];
            return $this->render('zone_admin/newsCreation.html.twig', $vars);
        }
    }

    /**
     * @Route("/zone/admin/news/one/{idnews}", name="zone_admin_news_one")
     */
    public function newsOne(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $repnews = $em->getRepository(News::class);

        $nbr = $req->get('idnews');
        $manews = $repnews->find($nbr);

        $vars = ['news' => $manews];
        //dump($vars);
        //die();

        return $this->render('zone_admin/adminNewsOne.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/news/delete", name="zone_admin_news_delete")
     */
    public function newsDelete() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    //---gestion fans---
    /**
     * @Route("/zone/admin/fans/all", name="zone_admin_fans_all")
     */
    public function fansAll() {
        $em = $this->getDoctrine()->getManager();
        $repfan = $em->getRepository(Fan::class);

        $lesfans = $repfan->findAllAlphabetic();

        $vars = ['lesfans' => $lesfans];
        return $this->render('zone_admin/adminFans.html.twig', $vars);
    }

    /**
     * @Route("/zone/admin/fans/update", name="zone_admin_fans_update")
     */
    public function fansUpdate() {
        return $this->render('zone_admin/index.html.twig', [
                    'controller_name' => 'ZoneAdminController',
        ]);
    }

    /**
     * @Route("/zone/admin/fans/delete/{idfan}", name="zone_admin_fans_delete")
     */
    public function fansDelete(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $unfan = $em->getRepository(Fan::class)->find($req->get('idfan'));
        $em->remove($unfan);
        $em->flush();

        //return redirectoaction tous fans
        return $this->redirect("/zone/admin/fans/all");
    }

    //---gestion fanComments---
    /**
     * @Route("/zone/admin/fan/comments/delete/{idcomment}", name="zone_admin_fanComments_delete")
     */
    public function fanCommentsDelete(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $unfancomment = $em->getRepository(FanComment::class)->find($req->get('idcomment'));
        $em->remove($unfancomment);
        $em->flush();

        //return redirectoaction tous fans
        return $this->redirect("/zone/admin/fans/all");
    }

}
