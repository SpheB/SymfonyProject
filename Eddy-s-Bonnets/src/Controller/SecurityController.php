<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\Concours;
use App\Entity\Vote;

class SecurityController extends AbstractController {

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response {

        //avant le log, met les concours à jour pour que tout soit en ordre si personne va chercher par concours,...
        $em = $this->getDoctrine()->getManager();
        $repconcours = $em->getRepository(Concours::class);

        //je m'occupe de trouver les councours finis qui n'ont pas de gagnants
        $concoursToUpdateMaybe = $repconcours->findByConcoursEnCours();
        //dump('meh', $concoursToUpdateMaybe);
        //voir si on a des votes pour les updater
        for ($i = 0; $i < count($concoursToUpdateMaybe); $i++) {
            $repvote = $em->getRepository(Vote::class);

            $votegagnant = $repvote->findByExampleField($concoursToUpdateMaybe[$i]);

            //dump($votegagnant[0]->getIdLook());
            if ($votegagnant != null) {
                $concoursToUpdateMaybe[$i]->setGagnant($votegagnant[0]->getIdLook());
                $em->flush();
            }
            //die();
        }
        //fin truc concernat concours-------------------
        
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

}
