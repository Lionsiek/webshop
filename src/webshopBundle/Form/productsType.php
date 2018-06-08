<?php

namespace webshopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use webshopBundle\Entity\products;


class productsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('productName')->add('productPrice')->add('category')->add('description')
            ->add('imageUrl', FileType::class, [
                'data_class' => null,
                'label' => 'Afbeelding toevoegen: ',
                'required' => false]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'webshopBundle\Entity\products'
        ));
        $resolver->setDefaults(array(
            'data_class' => products::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'webshopbundle_products';
    }


}
