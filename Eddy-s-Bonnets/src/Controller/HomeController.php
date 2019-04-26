<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use DateTime;
use App\Entity\Concours;
use App\Entity\Vote;
use App\Entity\News;
use App\Entity\Look;
use App\Entity\Style;
use App\Entity\FanComment;
use App\Form\MailType;
use App\Form\FanCommentType;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function index() {
        $em = $this->getDoctrine()->getManager();
        $repconcours = $em->getRepository(Concours::class);

        //je m'occupe de trouver les councours finis qui n'ont pas de gagnants
        $concoursToUpdateMaybe = $repconcours->findByConcoursEnCours();
        //dump('meh', $concoursToUpdateMaybe);

        //voir si on a des votes pour les updater
        for ($i = 0; $i < count($concoursToUpdateMaybe); $i++) {
            $repvote = $em->getRepository(Vote::class);

            $votegagnant = $repvote->findByExampleField($concoursToUpdateMaybe[$i]);

            dump($votegagnant[0]->getIdLook());
            if ($votegagnant[0] != null) {
                $concoursToUpdateMaybe[$i]->setGagnant($votegagnant[0]->getIdLook());
                 $em->flush();
            }
            //die();
        }
       
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about() {
        return $this->render('home/about.html.twig');
    }

    //peut être autre controller pour looks???
    /**
     * @Route("/looks", name="looks")
     */
    public function looks() {
        $em = $this->getDoctrine()->getManager();
        $replook = $em->getRepository(Look::class);
        $repstyle = $em->getRepository(Style::class);

        //je m'occupe de tous les styles
        $messtyles = $repstyle->findAll();


        //je m'occupe de tous les looks
        $meslooks = $replook->findAll();
        //dump($meslooks);
        //die();


        $vars = ['meslooks' => $meslooks, 'messtyles' => $messtyles];
        //dump($vars);
        //die();

        return $this->render('home/looks.html.twig', $vars);
    }

    /**
     * @Route("/looks/one/{idlook}", name="looks_one")
     */
    public function looksOne(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $replook = $em->getRepository(Look::class);

        $nbr = $req->get('idlook');
        $monlook = $replook->find($nbr);

        $fancomment = new FanComment();
        $form = $this->createForm(FanCommentType::class, $fancomment);
        $form->handleRequest($req);

        //refaire en ajax???
        if ($form->isSubmitted() && $form->isValid()) {

            $fancomment->setDateComment(new DateTime());
            $fancomment->setIdLook($monlook);
            $fancomment->setIdFan($this->getUser());
            //dump($fancomment);
            //die();
            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fancomment);
            $entityManager->flush();

            //return redirectoaction à lui même
            return $this->redirect("/looks/one/" . $monlook->getId());
        }

        $vars = ['look' => $monlook, 'formulaireFanComment' => $form->createView()];
        //dump($vars);
        //die();

        return $this->render('home/lookOne.html.twig', $vars);
    }

    /**
     * @Route ("/looks/traitement");
     */
    public function lookOneTraitementAjax(Request $reqAjax) {
        $em = $this->getDoctrine()->getManager();
        $replook = $em->getRepository(Look::class);
        //dump('fuck');
        //die();
        $idlook = $reqAjax->get('idlook');
        //dump($idlook);
        //die();
        $monlook = $replook->find($idlook);

        $nbrlikes = $monlook->getLikes();
        $nbrlikesnow = $nbrlikes + 1;
        $monlook->setLikes($nbrlikesnow);
        $em->flush();

        $arrayReponse = ['likeslook' => $nbrlikesnow . ' likes'];
        return new JsonResponse($arrayReponse);
    }

    /**
     * @Route("/news", name="news")
     */
    public function news() {

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
    public function contact(\Swift_Mailer $mailer, Request $req) {
        $monFormulaire = $this->createForm(MailType::class, null, ['action' => $this->generateUrl("contact"), 'method' => 'POST']);
        //dump($monFormulaire);
        //die();

        $monFormulaire->handleRequest($req);

        if ($monFormulaire->isSubmitted() && $monFormulaire->isValid()) {

            $message = (new \Swift_Message('Ed-s-message from ' . $monFormulaire->getData()["your_email"]))
                    ->setFrom('developinterface3@gmail.com')
                    ->setTo('sphe.bonnet@gmail.com')
                    ->setBody("Message: " . $monFormulaire->getData()["message"] . " | Email: " . $monFormulaire->getData()["your_email"]);


            $mailer->send($message);

            return $this->render('home/index.html.twig');
        } else {

            $vars = ['formulaireMail' => $monFormulaire->createView()];
            return $this->render('home/contact.html.twig', $vars);
        }
    }

    /**
     * @Route ("/page_logout")
     */
    public function logout() {

        return $this->render('home/index.html.twig');
    }

}
