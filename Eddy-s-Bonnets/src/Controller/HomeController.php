<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use App\Entity\News;
use App\Entity\Look;
use App\Entity\Style;
use App\Entity\FanComment;
use App\Form\MailType;
use App\form\FanCommentType;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function index() {
        return $this->render('home/index.html.twig', [
                    'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about() {
        return $this->render('home/about.html.twig', [
                    'controller_name' => 'HomeController',
        ]);
    }

    //peut être autre controller pour looks???
    /**
     * @Route("/looks", name="looks")
     */
    public function looks(Request $req) {
        $fancomment = new FanComment();
        $form = $this->createForm(FanCommentType::class, $fancomment);
        $form->handleRequest($req);

        //refaire en ajax???
        if ($form->isSubmitted() && $form->isValid()) {
        
            $fancomment->setDateComment(new DateTime());
            dump($fancomment);
            die();
            //met dans base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fancomment);
            $entityManager->flush();

            //return redirectoaction à lui même
            return $this->redirect("/looks");
        }
        else {
            $em = $this->getDoctrine()->getManager();
            $replook = $em->getRepository(Look::class);
            $repstyle = $em->getRepository(Style::class);

            //je m'occupe de tous les styles
            $messtyles = $repstyle->findAll();


            //je m'occupe de tous les looks
            $meslooks = $replook->findAll();
            //dump($meslooks);
            //die();
            //--> peut être plus efficace de faire un tableau clef/valeur avec id/objetcomplet et de setté le style des look en reprenant dans le tableau créé l'objet se situant à la clef de l'id en question 
            //je leur met le style approprié
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

            $vars = ['meslooks' => $meslooks, 'messtyles' => $messtyles, 'formulaireFanComment' => $form->createView()];
            //dump($vars);
            //die();

            return $this->render('home/looks.html.twig', $vars);
        }
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

            return $this->render('home/index.html.twig', [
                        'controller_name' => 'HomeController',
            ]);
        } else {

            $vars = ['formulaireMail' => $monFormulaire->createView()];
            return $this->render('home/contact.html.twig', $vars);
        }
    }

}
