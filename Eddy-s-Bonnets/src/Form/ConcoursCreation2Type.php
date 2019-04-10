<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Concours;

class ConcoursCreation2Type extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('theme', TextType::class)
                ->add('date_debut', DateType::class, ['widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'])
                ->add('date_fin', DateType::class, ['widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'])
                ->add('comment_concours', TextareaType::class)
                ->add('looks', EntityType::class, [
                    'class' => 'App\Entity\Look',
                    'choice_label' => 'picture',
                    'multiple' => true,
                    'expanded' => true,
                    'required' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Concours::class,
        ]);
    }

}
