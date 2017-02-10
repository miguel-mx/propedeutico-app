<?php

namespace SimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecomendacionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comparacion', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Excepcional' => 'Excepcional',
                    'Arriba del promedio' => 'Arriba del promedio',
                    'Promedio' => 'Promedio',
                    'Debajo del promedio' => 'Debajo del promedio',
                ),
                'choices_as_values' => true,
            ))
            ->add('materias', 'Symfony\Component\Form\Extension\Core\Type\TextareaType')
            ->add('participacion', 'Symfony\Component\Form\Extension\Core\Type\TextareaType')
            ->add('utilidad', 'Symfony\Component\Form\Extension\Core\Type\TextareaType')
            ->add('motivacion', 'Symfony\Component\Form\Extension\Core\Type\TextareaType')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SimBundle\Entity\Recomendacion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'simbundle_recomendacion';
    }


}
