<?php

namespace App\Form;

use App\Entity\Look;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class LooksCreationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('picture', FileType::class, array('label' => "Sélectionnez un image: "))
                ->add('description', TextType::class, array('label' => "Nom du Look: "))
                ->add('descr_long', TextType::class, array('label' => "Description: "))
                ->add('id_style', EntityType::class, [
                    'class' => 'App\Entity\Style',
                    'choice_label' => 'type_style',
                    //'multiple' => true,
                    //'expanded' => true,
                    'required' => true
                ])
                ->add('date_look', DateType::class, ['label' => 'Date: ', 'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Look::class,
        ]);
    }

}
