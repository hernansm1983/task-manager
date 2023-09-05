<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('assigneduserid', ChoiceType::class, array( // Agregar campo de selección para usuarios
                    'label' => 'Asignada a',
                    'choices' => $options['users'], // Opciones de usuarios pasadas desde el controlador
                    'choice_value' => 'id',
                    'choice_label' => function ($user) {
                        return $user->getSurname().', '.$user->getName();
                    },
        ))
                ->add('title', TextType::class, array(
                    'label' => 'Titulo'
        ))
                ->add('content', TextareaType::class, array(
                    'label' => 'Contenido'
        ))
                ->add('priority', ChoiceType::class, array(
                    'label' => 'Prioridad',
                    'choices' => array(
                        'Alta' => 'high',
                        'Media' => 'medium',
                        'Baja' => 'low'
                    )
                    
        ))
                ->add('hours', TextType::class, array(
                    'label' => 'Horas Presupuestadas'
        ))
                ->add('state', ChoiceType::class, array(
                    'label' => 'Estado',
                    'choices' => array(
                        'Activa' => 'active',
                        'Inactiva' => 'inactive',
                        'Finalizada' => 'finished'
                    )
                    
        ))                
                ->add('submit', SubmitType::class, array(
                    'label' => 'Guardar'
        ));
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'users' => [], // Definir la opción 'users' aquí
        ]);
    }

}
