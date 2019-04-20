<?php

namespace App\Form;

use App\Entity\FanComment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class FanCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text_comment', TextareaType::class)
            ->add('id_look', EntityType::class, [
                    'class' => 'App\Entity\Look',
                    'choice_label' => 'id',
                ])
            ->add('id_fan', EntityType::class, [
                    'class' => 'App\Entity\Fan',
                    'choice_label' => 'id',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FanComment::class,
        ]);
    }
}
