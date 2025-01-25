<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
        //session_Start()
        $session = $request->getSession();
        if($session->has('nbreVisite')){
            $nbreVisite = $session->get('nbreVisite') + 1;
            $session->set('nbreVisite', $nbreVisite);
        }else{
            $nbreVisite = 1;
        }
        $session->set('nbreVisite', $nbreVisite);
        return $this->render('session/index.html.twig');
    }
}
