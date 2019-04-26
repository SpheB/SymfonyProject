<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use App\Form\FanEmailType;
use App\Form\FanPseudoType;
use App\Form\FanAvatarType;
use App\Entity\Fan;
use App\Entity\FanComment;
use App\Entity\Concours;
use App\Entity\Look;
use App\Entity\Vote;

class ZoneFanController extends AbstractController {

    /**
     * @Route("/zone/fan", name="zone_fan")
     
    public function index() {
        return $this->render('zone_fan/index.html.twig', [
                    'controller_name' => 'ZoneFanController',
        ]);
    }
    */
    
    /**
     * @Route("/zone/fan/profile/version1", name="fanProfile")
     */
    public function profileVersion1() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Fan::class);

        $currentfanuser = $this->getUser();
        //dump($currentfanuser->getId());
        //die();
        $monprofil = $rep->find($currentfanuser->getId());
        //dump($monprofil);
        //die();

        $vars = ['monprofil' => $monprofil];
        return $this->render('zone_fan/profile.html.twig', $vars);
    }

    /**
     * @Route("/zone/fan/profile", name="FanProfile")
     */
    public function profile(Request $req) {
        $cefan = new Fan();
        $formulaireEmailFan = $this->createForm(FanEmailType::class, $cefan);
        $formulaireEmailFan->handleRequest($req);
        //die()
        $formulairePseudoFan = $this->createForm(FanPseudoType::class, $cefan);
        $formulairePseudoFan->handleRequest($req);

        $formulaireAvatarFan = $this->createForm(FanAvatarType::class, $cefan);
        $formulaireAvatarFan->handleRequest($req);

        if ($formulaireEmailFan->isSubmitted() && $formulaireEmailFan->isValid()) {
            dump($formulaireEmailFan);
            dump($cefan);
            //die();

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository(Fan::class);
            $currentfanuser = $this->getUser();
            $monprofil = $rep->find($currentfanuser->getId());

            //!!faire try-catch pour si email pas unique???
            //!!faire if si avatar pas changé???

            $monprofil->setEmail($cefan->getEmail());
            //dump($monprofil);
            //die();
            $em->flush();
            //return new Response("Email uploaded et BD mise à jour!");
        } else if ($formulairePseudoFan->isSubmitted() && $formulairePseudoFan->isValid()) {
            //die();

            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository(Fan::class);
            $currentfanuser = $this->getUser();
            $monprofil = $rep->find($currentfanuser->getId());

            //!!faire try-catch pour si email pas unique???
            //!!faire if si avatar pas changé???
            $monprofil->setPseudo($cefan->getPseudo());

            $em->flush();
            //return new Response("Pseudo uploaded et BD mise à jour!");
        } else if ($formulaireAvatarFan->isSubmitted() && $formulaireAvatarFan->isValid()) {
            //die();
            // obtenir le fichier (pas un "string" mais un objet de la class UploadedFile)
            $fichier = $cefan->getAvatar();
            //dump($fichier );
            //die();
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            // stocker le fichier dans le serveur (on peut indiquer un dossier)
            $fichier->move("dossierFichiers", $nomFichierServeur);
            // affecter le nom du fichier de l'entité. Ça sera le nom qu'on aura dans la BD (un string, pas un objet UploadedFile cette fois)
            //si j'ai le temps, supprimer le fichier précédant de la base de donnée???
            $em = $this->getDoctrine()->getManager();
            $rep = $em->getRepository(Fan::class);
            $currentfanuser = $this->getUser();
            $monprofil = $rep->find($currentfanuser->getId());

            $monprofil->setAvatar($nomFichierServeur);
            //dump($monprofile);
            //die();

            $em->flush();
            //return new Response("fichier uploaded et BD mise à jour!");
        }

        $vars = ['formulaireEmailFan' => $formulaireEmailFan->createView(), 'formulairePseudoFan' => $formulairePseudoFan->createView(), 'formulaireAvatarFan' => $formulaireAvatarFan->createView()];
        return $this->render('zone_fan/profileUpdate.html.twig', $vars);
    }

    /**
     * @Route("/zone/fan/fan/comments/delete/{idfancomment}", name="fan_fanComment_delete")
     */
    public function FanCommentDelete(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $unfancomment = $em->getRepository(FanComment::class)->find($req->get('idfancomment'));
        $em->remove($unfancomment);
        $em->flush();

        //return redirectoaction tous fans
        return $this->redirect("/looks/one/" . $unfancomment->getIdLook()->getId());
    }

//ici les concours ne peuvent être vus ET participés par Fans connectés. Si peuvent être vus par tous peut-être changer de place???
    /**
     * @Route("/zone/fan/concours", name="fanConcours")
     */
    public function concours() {
        $em = $this->getDoctrine()->getManager();
        $ceconcours = $em->getRepository(Concours::class)->findOneByDate();
        $pastvote =  $em->getRepository(Vote::class)->findOneBy(array ('id_concours'=>$ceconcours, 'id_fan'=>$this->getUser()));
        //dump($ceconcours);
        //die();
        $vars = ['ceconcours' => $ceconcours, 'pastvote' => $pastvote];

        return $this->render('zone_fan/concours.html.twig', $vars);
    }

    /**
     * @Route("/zone/fan/concours/calcul/{idconcours}/{idlook}", name="fanConcoursCalcul")
     */
    public function concoursCalcul(Request $req) {
        $em = $this->getDoctrine()->getManager();
        $concoursnow = $em->getRepository(Concours::class)->find($req->get('idconcours'));
        $lookchoisi = $em->getRepository(Look::class)->find($req->get('idlook'));

        //dump($lookchoisi);
        //dump($req->get('idlook'));

        $votenow = new Vote();
        $votenow->setDateVote(new DateTime());
        $votenow->setIdConcours($concoursnow);
        $votenow->setIdLook($lookchoisi);
        $votenow->setIdFan($this->getUser());

        //dump($votenow);
        //die();
        $em->persist($votenow);
        $em->flush();

        return $this->redirect("/zone/fan/concours");
    }

}
