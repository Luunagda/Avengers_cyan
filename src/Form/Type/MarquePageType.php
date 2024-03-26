<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\MarquePage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\MotsCles;

class MarquePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('url', TextType::class)
        ->add('date_creation', DateType::class)
        ->add('commentaire', TextType::class)
        ->add('mots_cles', EntityType::class, [
            'class' => MotsCles::class,
            'choice_label' => 'mots_cles',
            'multiple' => true,
            'expanded' => true,
        ])
        ->add('valider', SubmitType::class);
    }
    // Ici, on défini de manière explicite le « data_class »
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MarquePage::class,
        ]);
    }
    
    
}