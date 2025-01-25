<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FirstController extends AbstractController
{
    #[Route('/template', name: 'template')]
    public function template(){
        return $this->render('template.html.twig');
    }

    #[Route('/order/{maVar}', name: 'test.order.route')]
    public function TestOrderRoute($maVar){
        return new Response("
        <html><body>$maVar</body></html>
        ");
    }

    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        //cherche au la base des donnees vos Users
        return $this->render('first/index.html.twig', [
            'name' => 'Yahyaoui',
            'firstName' => 'Ahlem'
        ]);
    }


   // #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello(Request $request,$name,$firstname): Response
    {
       return $this->render('first/hello.html.twig',[
           'nom' => $name,
           'prenom' => $firstname
       ]);
    }
    #[Route(
        'multi/{entier1<\d+>}/{entier2<\d+>}',
        name: 'multiplication',
        )]
    public function multiplication($entier1, $entier2){
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
}
}
