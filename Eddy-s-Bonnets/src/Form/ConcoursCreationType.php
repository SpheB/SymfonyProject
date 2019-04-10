<?php

namespace App\Form;

use App\Entity\Concours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Look;

class ConcoursCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme', TextType::class)
            ->add('date_debut', DateType::class,
                        ['widget'=>'single_text',
                         'format'=>'yyyy-MM-dd'])
            ->add('date_fin', DateType::class,
                        ['widget'=>'single_text',
                         'format'=>'yyyy-MM-dd'])
            ->add('comment_concours', TextAreaType::class)
            ->add('looks', Look::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concours::class,
        ]);
    }
}
