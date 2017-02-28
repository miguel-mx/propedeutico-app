<?php

namespace SimBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolicitudType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('paterno')
            ->add('materno')
            ->add('sexo', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Masculino' => 'M',
                    'Femenino' => 'F',
                ),
                'choices_as_values' => true,
            ))
            ->add('mail')
            ->add('procedencia')
            ->add('carrera')
            ->add('universidad')
            ->add('programa', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Licenciatura' => 'Licenciatura',
                    'Maestría' => 'Maestría',
                ),
                'choices_as_values' => true,
            ))
            ->add('avance')
            ->add('promedio')
            ->add('razones', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array('required' => false))
            ->add('beca', 'Symfony\Component\Form\Extension\Core\Type\ChoiceType', array(
                'choices'  => array(
                    'Beca de alimentos y hospedaje' => 'Beca de alimentos y hospedaje',
                    'Beca de alimentos' => 'Beca de alimentos',
                    'NO' => 'NO',
                ),
                'choices_as_values' => true,
            ))
            ->add('profesor1')
            ->add('univprofesor1')
            ->add('mailprofesor1')
            ->add('profesor2')
            ->add('univprofesor2')
            ->add('mailprofesor2')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SimBundle\Entity\Solicitud'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'simbundle_solicitud';
    }


}
