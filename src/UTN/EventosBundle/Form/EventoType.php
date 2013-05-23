<?php

namespace UTN\EventosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('fecha')
            ->add('habilitado', 'checkbox', array(
                'required' => false
            ))
            ->add('descripcion')
            //->add('updatedAt')
            //->add('createdAt')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UTN\EventosBundle\Entity\Evento'
        ));
    }

    public function getName()
    {
        return 'utn_eventosbundle_eventotype';
    }
}
