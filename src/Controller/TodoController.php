<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/todo')]

final class TodoController extends AbstractController
{
    #[Route('/' , name: 'app_todo_index')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher notre tableau de todo
        //sinon je l'initialise puis l'affiche
        if(!$session->has('todos')){
            $todos =[
                'achat' => 'acheter clé USB',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"La liste des todos viens d'etre initialisée");
        }
        //si j ai mon tableau de todo dans ma session je ne fait que l'afficher
        return $this->render('todo_conroller/index.html.twig');
    }
    #[Route(
        '/add/{name?test}/{content?test}',
        name: 'todo.add'
    )]
    public function addTodo(Request $request,$name,$content):RedirectResponse{
        $session = $request->getSession();
        //verifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')){
            //si oui
            //verifier si on a deja un todo avec le meme name
            $todos=$session->get('todos');
            if(isset($todos[$name])){
                //si oui afficher erreur
                $this->addFlash('error',"Le todos d'id $name est exixte deja dans la liste");
            }else{
                //si non on l'ajouter et on affiche un msg de succès
                $todos[$name]=$content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todos d'id $name a ete ajouter avec succès");
            }
        }else{
            //si non
            //afficher erreur et en va rediger vers le controlleur index
            $this->addFlash('error',"La liste des todos ne pas encore initialisée");
        }
        return $this->redirectToRoute('app_todo_index');



    }
    #[Route('/update/{name}/{content}',name: 'todo.update')]
    public function updateTodo(Request $request,$name,$content):RedirectResponse{
        $session = $request->getSession();
        //verifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')){
            //si oui
            //verifier si on a deja un todo avec le meme name
            $todos=$session->get('todos');
            if(!isset($todos[$name])){
                //si oui afficher erreur
                $this->addFlash('error',"Le todos d'id $name est n'exixte pas dans la liste");
            }else{
                //si non on l'ajouter et on affiche un msg de succès
                $todos[$name]=$content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todos d'id $name a ete modifier avec succès");
            }
        }else{
            //si non
            //afficher erreur et en va rediger vers le controlleur index
            $this->addFlash('error',"La liste des todos ne pas encore initialisée");
        }
        return $this->redirectToRoute('app_todo_index');



    }
    #[Route('/delete/{name}',name: 'todo.delete')]
    public function deleteTodo(Request $request,$name):RedirectResponse{
        $session = $request->getSession();
        //verifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')){
            //si oui
            //verifier si on a deja un todo avec le meme name
            $todos=$session->get('todos');
            if(!isset($todos[$name])){
                //si oui afficher erreur
                $this->addFlash('error',"Le todos d'id $name est n'exixte pas dans la liste");
            }else{
                //si non on l'ajouter et on affiche un msg de succès
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todos d'id $name a ete supprimer avec succès");
            }
        }else{
            //si non
            //afficher erreur et en va rediger vers le controlleur index
            $this->addFlash('error',"La liste des todos ne pas encore initialisée");
        }
        return $this->redirectToRoute('app_todo_index');



    }
    #[Route('/reset',name: 'todo.reset')]
    public function resetTodo(Request $request):RedirectResponse{
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todo_index');
    }

}
