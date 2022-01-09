<?php

namespace App\Form;

use App\Entity\LigneDeCommande;
use App\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneDeCommandeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'query_builder' => function(EntityRepository $entityRepository) use ($options){
                    $qb = $entityRepository->createQueryBuilder('u');

                    return $qb
                        ->where("u.restaurant =" .$options['id'])
                        ->orderBy('u.nom', 'ASC');
                },
            ])
            ->add('quantite')  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneDeCommande::class,
            'id' => 0,
        ]);
        // $resolver->setAllowedTypes('id', 'int');
    }
}
