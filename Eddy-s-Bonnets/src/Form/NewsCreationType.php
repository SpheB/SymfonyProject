<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class NewsCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array ('label'=>"Titre: "))
            ->add('accroche', TextType::class, array ('label'=>"Accroche: "))
            ->add('text_news', TextType::class, array ('label'=>"Contenu: "))
            ->add('date_news', DateType::class, ['label' => 'Date: ', 'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'])
            ->add('picture_news', FileType::class, array('label' => "Sélectionnez un image: "))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
