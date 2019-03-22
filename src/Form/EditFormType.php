<?php

namespace App\Form;

use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('instrument', EntityType::class, [
                'class' => Instru::class,
                'choice_label' => 'instruName',
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                //  'empty_data' => '',
                //'by_reference' => false,


            ])
            ->add('style', EntityType::class, [
                'class' => Style::class,
                'choice_label' => 'styleName',
                'mapped' => false,
                'multiple' => false,
                'expanded' => false,
                'empty_data' => '',
                //'by_reference' => false,

            ])
            ->add('groupe', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'expanded' => true,

            ])
            ->add('description', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
