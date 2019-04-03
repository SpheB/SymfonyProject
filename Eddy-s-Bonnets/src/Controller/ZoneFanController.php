<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Form\FanType;
use App\Entity\Fan;

class ZoneFanController extends AbstractController {

    /**
     * @Route("/zone/fan", name="zone_fan")
     */
    public function index() {
        return $this->render('zone_fan/index.html.twig', [
                    'controller_name' => 'ZoneFanController',
        ]);
    }

    /**
     * @Route("/zone/fan/profile", name="fanProfile")
     */
    public function profile() {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Fan::class);

        $currentfanuser = $this->getUser();
        //dump($currentfanuser->getId());
        //die();
        $monprofil = $rep->find($currentfanuser->getId());
        dump($monprofil);
        //die();
        
        $vars = ['monprofil' => $monprofil];
        return $this->render('zone_fan/profile.html.twig', $vars);
    }

    /**
     * @Route("/zone/fan/profile/update", name="FanProfileUpdate")
     */
    public function profileUpdate(Request $req) {
        $cefan = new Fan();
 
        $fanrecherche = $this->getUser();
        
        $cefan->setEmail($fanrecherche->getEmail());
        $cefan->setPseudo($fanrecherche->getPseudo());

        
  

        //dump($fanrecherche);
        //die();
        // créer un formulaire associé à cette entité
        $formulaireFan = $this->createForm(FanType::class, $cefan);
        
        // gérer la requête (et hydrater l'entité)
        $formulaireFan->handleRequest($req);
        
        

        if ($formulaireFan->isSubmitted() && $formulaireFan->isValid()) {
       
            // obtenir le fichier (pas un "string" mais un 
            // objet de la class UploadedFile)
            $fichier = $cefan->getAvatar();
            //dump($fichier );
            //die();
            // obtenir un nom de fichier unique 
            // pour éviter les doublons dans le dossier
            
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            // stocker le fichier dans le serveur (on peut indiquer un dossier)
            $fichier->move("dossierFichiers", $nomFichierServeur);
            // affecter le nom du fichier de l'entité. Ça sera le nom qu'on
            // aura dans la BD (un string, pas un objet UploadedFile cette fois)
            $cefan->setAvatar($nomFichierServeur);

            dump($cefan);
            //die();
            // stocker l'objet dans la BD, ou faire update
            $em = $this->getDoctrine()->getManager();
            $em->persist($cefan);
            $em->flush();
            return new Response("fichier uploaded et BD mise à jour!");
        } else {

            return $this->render('zone_fan/profileUpdate.html.twig', ['formulairetest' => $formulaireFan->createView()]
            );
        }
    }

    //ici les concours ne peuvent être vus ET participés par Fans connectés. Si peuvent être vus par tous peut-être changer de place???
    /**
     * @Route("/zone/fan/concours", name="fanConcours")
     */
    public function concours() {
        return $this->render('zone_fan/profile.html.twig', [
                    'controller_name' => 'ZoneFanController',
        ]);
    }

}
