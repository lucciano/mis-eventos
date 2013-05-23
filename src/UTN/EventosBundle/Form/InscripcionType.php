<?php

namespace UTN\EventosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InscripcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $inscripcion = $builder->getData();
        $builder
            ->add('nombre')
            ->add('mail')
            //->add('createdAt')
            //->add('updatedAt')
            ;
        $evento = $inscripcion->getEvento();
        if($evento)
            $builder->add('evento', 'hidden', array('data' => $evento->getId()));
        else
            $builder->add('evento');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UTN\EventosBundle\Entity\Inscripcion'
        ));
    }

    public function getName()
    {
        return 'utn_eventosbundle_inscripciontype';
    }
}
