<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', ChoiceType::class, [
                'choices' => [
                'Demande de rendez-vous (préciser la date)' => 'Demande de rendez-vous ',
                'Demande particulière pour l\'animal' => 'Demande particulière pour l\'animal',
                'Autre' => 'Autre'
                ]
            ])

            ->add('content')
            ->add('dateAppoitment', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('animal_idanimal', ChoiceType::class, [
                'choices' => [
                    
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
