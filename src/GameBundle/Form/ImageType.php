<?php

namespace GameBundle\Form;

use GameBundle\GameBundle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('src', FileType::class, array('label' => 'Image', 'required' => true))
            //->add('validee')
            //->add('type')
            ->add('lat')
            ->add('lng')
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
