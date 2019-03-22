<?php

namespace App\Form;


use App\Entity\Instru;
use App\Form\RegistrationFormType;
use App\Repository\InstruRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstruType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //Form Builder displayed in register twig
        $builder
            ->add('instrument', EntityType::class, [
                //'class' => Instru::class,
                'mapped' => false,
                'choice_label' => 'instruName',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,


            ]);
    }
        public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Instru::class,
        ]);
    }


}