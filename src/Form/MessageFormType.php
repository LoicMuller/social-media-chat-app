<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Envoyer un message...',
                ],
                'label' => 'Message',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Votre message ne peut pas être vide',
                        'max' => 555,
                        'maxMessage' => 'Votre message ne peut pas contenir autant de caractères : ( {{ limit }} caractères autorisés )'
                    ]),
                ],
            ])
            ->add('planified_at', HiddenType::class)
            ->add('socialMedia', ChoiceType::class, [
                'label' => 'Réseau Social',
                'attr' => ['class' => 'form-control col-lg-6 mx-auto'],
                'choices' => [
                    'Slack' => 'Slack',
                    'Discord' => 'Discord',
                    'Les 2' => 'Slack & Discord',
                ],
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
