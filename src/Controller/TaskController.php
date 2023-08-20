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
//use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use Symfony\Component\Security\Core\User\UserInterface;

use Doctrine\Persistence\ManagerRegistry;


class TaskController extends AbstractController
{
    
    public function index(ManagerRegistry $doctrine): Response
    {
        // Prueba de Entidades y Relaciones
       
        
        $task_repo = $doctrine->getRepository(Task::Class);
        
        $tasks = $task_repo->findAll();
        
        foreach($tasks as $task){
            echo $task->getTitle()." - ".$task->getUser()->getEmail()."</br>";
            
        }
        echo "</br>";echo "</br>";echo "</br>";
        
        $user_repo = $doctrine->getRepository(User::class);
        $users = $user_repo->findAll();
        
        foreach($users as $user){
            echo $user->getName()."</br>";
            
            foreach($user->getTasks() as $task){
                echo $task->getTitle()."</br>";
            }
            echo "</br>";
        }
       
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }
}
