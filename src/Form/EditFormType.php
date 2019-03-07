<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Form Builder displayed in register twig
        $builder
            ->setMethod('POST')
            ->add('username')
            ->add('mail')
            ->add('instrument', ChoiceType::class, [
                'choices' => [
                    'Guitare' => 'guitare',
                    'Bass' => 'bass',
                    'Batterie' => 'batterie',
                    'Chant' => 'chant',
                    'Autre' => 'autre',
                ],
            ])
            ->add('style', ChoiceType::class, [
                'choices' => [
                    'Metal' => 'metal',
                    'Jazz' => 'jazz',
                    'Reggae' => 'reggae',
                    'Pop' => 'pop',
                    'Smooth' => 'smooth',
                ],
            ])
            ->add('groupe', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
