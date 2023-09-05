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
use App\Entity\User;
use App\Form\TaskType;
use Symfony\Component\Security\Core\User\UserInterface as UserInterfase;
use Doctrine\Common\Collections\Criteria;

use Doctrine\Persistence\ManagerRegistry;


class TaskController extends AbstractController
{
    // Muestra el Listado de todas las tareas existentes
    public function index(ManagerRegistry $doctrine, UserInterfase $user,): Response
    {
        // Prueba de Entidades y Relaciones
        $task_repo = $doctrine->getRepository(Task::Class);
        
        $tasks = $task_repo->findBy([], ['id'=>'desc']);
        
        return $this->render('task/index.html.twig', [
            'user' => $user,
            'tasks' => $tasks,
        ]);
    }
    
    
    // Da de Alta una Nueva Tarea
    public function creation(Request $request, UserInterfase $user, ManagerRegistry $doctrine){

        $em = $doctrine->getManager();
        //$users = $em->getRepository(User::class)->findAll()->orderBy('surname', 'DESC') ;

        $repository = $em->getRepository(User::class);
        $queryBuilder = $repository->createQueryBuilder('u'); // 'u' es un alias para la entidad User

        $users = $queryBuilder
            ->orderBy('u.surname', 'DESC') // Reemplaza 'surname' con el nombre del campo que representa el apellido en tu entidad User
            ->getQuery()
            ->getResult();

        /*foreach($users as $user){
            echo $user->id.' '.$user->name.'</br>';
        };die();*/
        

        $task = new Task();
       // $form = $this->createForm(TaskType::class, $task);

        $form = $this->createForm(TaskType::class, $task, [
            'users' => $users, // Pasar la lista de usuarios como opciones al formulario
        ]);
        /*echo '<pre>';
        var_dump($form);
        echo '</pre>'; die();*/
        //echo $request->assigneduserid;
        //var_dump($request->request->all());die();
        //dump($request); die();
        $form->handleRequest($request);
        //echo "no entro"; die();
        
        if($form->isSubmitted() && $form->isValid()){
            //echo "entro al form"; die();
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);

            // Agregamos el Usuario asignado
            // Obtener el usuario seleccionado del formulario
            $assigneduserid = $form->get('assigneduserid')->getData();

            //var_dump($assigneduserid); die();

            // Buscar el usuario en función de su ID
            $assignedUser = $em->getRepository(User::class)->find($assigneduserid);

            // Establecer el usuario asignado a la tarea
            $task->setAssignedUserId($assignedUser);
            
            
            $em = $doctrine->getManager();
            $em->persist($task);
            $em->flush();
            
            $this->addFlash('message', 'La Tarea se ha creado correctamente');
            
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
    
    
    
    // Muestra mis Tareas
    public function myTasks(UserInterfase $user){
        
        $tasks = $user->getTasks();
        
        // Crea un criterio para ordenar por id en orden descendente
        $criteria = Criteria::create()->orderBy(['id' => 'DESC']);

        // Aplica el criterio para ordenar la colección de tareas
        $sortedTasks = $tasks->matching($criteria);
               
        return $this->render('task/my-tasks.html.twig',[
            'user' => $user,
            'tasks' => $sortedTasks
        ]);  
    }
    
    
    
    
    // Edita la Tarea
    public function edit($id, ManagerRegistry $doctrine, Request $request, UserInterfase $user){
        
        $task = $doctrine->getRepository(Task::class)->find($id);
        
        
        //---SOLO DEJA EDITAR AL USUARIO QUE CREO LA TAREA---
        
        if(!$user || $user->getId() != $task->getUser()->getId()){
            return $this->redirectToRoute('tasks');
        }
        
        $form = $this->createForm(TaskType::class, $task);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //$task->setCreatedAt(new \Datetime('now'));
            //$task->setUser($user);
            
            $em = $doctrine->getManager();
            $em->persist($task);
            $em->flush();
            
            $this->addFlash('message', 'La Tarea se ha editado correctamente');
            
            return $this->redirectToRoute('my_tasks');
            
        }
        //var_dump($task);
        return $this->render('task/creation.html.twig',[
            'edit' => true,
            'form' => $form->createView()
            
        ]);  
    }
    
    
    // Elimina una Tarea
    public function delete($id, ManagerRegistry $doctrine){
        
        // Obtén el objeto de la entidad que deseas eliminar
        $task = $doctrine->getRepository(Task::class)->find($id);

        // Comprueba si el registro existe
        if (!$task) {
            throw $this->createNotFoundException('El registro no fue encontrado');
        }
        
        $em = $doctrine->getManager();
        // Elimina el objeto de la entidad
        $em->remove($task);

        // Flushea los cambios para aplicar la eliminación en la base de datos
        $em->flush();
        
        return $this->redirectToRoute('my_tasks');
    }
}