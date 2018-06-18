<?php

namespace intakeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use intakeBundle\Entity\appointment;


class appointmentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('date',DateType::class, [ 'years' => range(date('Y') -100, date('Y')),])
            ->add('telephoneNumber')
            ->add('category')
            ->add('description');
//            ->add('imageUrl', FileType::class, [
//                'data_class' => null,
//                'label' => 'Afbeelding toevoegen: ',
//                'required' => false]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'intakeBundle\Entity\appointment'
        ));
        $resolver->setDefaults(array(
            'data_class' => appointment::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'intakeBundle_appointment';
    }


}
