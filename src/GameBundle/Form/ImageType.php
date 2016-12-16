<?php

namespace GameBundle\Form;

use GameBundle\GameBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('src')
            ->add('file', FileType::class, array('label' => 'Image', 'required' => true))
            //->add('validee')
            //->add('type')
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
            //->add('date')
            //->add('challenges', EntityType::class, array('class' => 'GameBundle\Entity\Challenge', 'choice_label' => 'nom'))
           // ->add('users')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GameBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gamebundle_image';
    }


}
