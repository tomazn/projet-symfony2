<?php

namespace Ecommerce\EcommerceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class produitsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add("nom",TextType::class)
                ->add("prix",IntegerType::class)
                ->add("description",TextareaType::class)
                ->add("image", imageType::class, array('data_class' => 'Ecommerce\EcommerceBundle\Entity\image'))
                ->add("stock",IntegerType::class)
                ->add("archive",CheckboxType::class, array("required"=>false))
                ->add('categorie', EntityType::class, array(
                    'class' => 'EcommerceEcommerceBundle:categorie',
                    'choice_label' => 'intitule'
                ))
                ->add('save', SubmitType::class, array('label' => 'Ajouter'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\produits'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommerce_ecommercebundle_produits';
    }


}
