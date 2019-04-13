<?php

namespace App\Form;

use App\Entity\Look;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LooksCreationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('picture', FileType::class, array('label' => "Sélectionner un image look "))
                ->add('description', TextType::class)
                ->add('id_style', EntityType::class, [
                    'class' => 'App\Entity\Style',
                    'choice_label' => 'type_style',
                    //'multiple' => true,
                    //'expanded' => true,
                    'required' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Look::class,
        ]);
    }

}
