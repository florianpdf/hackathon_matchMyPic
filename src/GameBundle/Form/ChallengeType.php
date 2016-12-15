<?php

namespace GameBundle\Form;

use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChallengeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('description')
            ->add('type', ChoiceType::class, ['choices'=> ['Privé'=>'private',
                                                           'Public'=>'public',
                                                          ],
                                             ]
            )
            ->add('dureeType', CheckboxType::class, ['label'=> 'Durée infinie',
                                                     'mapped'=>false,
            ])
            ->add('duree', null, ['label'=>'Durée (heures)', 'attr'=> [
                                                                'min'=>1,
                                                             ]
                                 ]
            )
//            ->add('dateCreate')
//            ->add('images')
//            ->add('user_meneur')
//            ->add('user_createur')
            ->add('users', CollectionType::class, [    'entry_type'   => EntityType::class,
                                                     'entry_options'  => ['class'=>'UserBundle\Entity\User',
                                                                          'choice_label'=>'nomprenom'
                                                            ],
                                                         'allow_add'=>true]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GameBundle\Entity\Challenge'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gamebundle_challenge';
    }


}
