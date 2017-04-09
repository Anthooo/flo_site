<?php

namespace FloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;



class ModeleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu', CKEditorType::class, array(
                'config_name' => 'my_config',
            ))
            ->add('categorie')
            ->add('liengaleriecours', ChoiceType::class, array(
                'required' => false,
                'placeholder' => 'Choisir une galerie',
                'choices'  => array(
                    'default' => 'galerie',
                    'cours_adultes_ados' => 'adultes',
                    'cours_ados' => 'ados',
                    'cours_enfants' => 'enfants',
                    'stages' => 'stages',
                        ),
                    ))
            ->add('image', ImageType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FloBundle\Entity\Modele'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'flobundle_modele';
    }


}
