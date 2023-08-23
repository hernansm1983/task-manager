<?php
/*
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
*/

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
//use App\Entity\User;
use App\Form\TaskType;
use Symfony\Component\Security\Core\User\UserInterface as UserInterfase;

use Doctrine\Persistence\ManagerRegistry;


class TaskController extends AbstractController
{
    // Muestra el Listado de todas las tareas existentes
    public function index(ManagerRegistry $doctrine): Response
    {
        // Prueba de Entidades y Relaciones
       
        
        $task_repo = $doctrine->getRepository(Task::Class);
        
        $tasks = $task_repo->findBy([], ['id'=>'desc']);
        
        /*
        
        $user_repo = $doctrine->getRepository(User::class);
        $users = $user_repo->findAll();
        
        foreach($users as $user){
            echo $user->getName()."</br>";
            
            foreach($user->getTasks() as $task){
                echo $task->getTitle()."</br>";
            }
            echo "</br>";
        }
       */
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }
    
    
    // Da de Alta una Nueva Tarea
    public function creation(Request $request, UserInterfase $user, ManagerRegistry $doctrine){
        
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);
            
            $em = $doctrine->getManager();
            $em->persist($task);
            $em->flush();
            
            return $this->redirectToRoute('tasks');
            
        }
        
        return $this->render('task/creation.html.twig',[
            'form' => $form->createView()
        ]);
    }
    
    
    // Muestra el Detalle de La Tarea
    public function detail($id, ManagerRegistry $doctrine){
        
        
        $task_repo = $doctrine->getRepository(Task::Class);
        
        $task = $task_repo->find($id);
        
        if(!$task){
            return $this->redirectToRoute('tasks');
        }
        
        return $this->render('task/detail.html.twig',[
            'task' => $task
        ]);
        
    }
}
