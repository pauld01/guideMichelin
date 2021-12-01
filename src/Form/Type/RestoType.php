<?php
namespace App\Form\Type;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Entity\Resto;
use App\Entity\Chef;

class RestoType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('nom', TextType::class)
            ->add('etoiles', TextType::class)
            ->add('idChef', EntityType::class,
                array('class'=>Chef::class))
            ->add('plats_proposes', EntityType::class,
                array('class'=>Plat::class,'multiple'=>true));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => Resto::class,));
    }
}