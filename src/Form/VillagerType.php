<?php

namespace App\Form;

use App\Entity\Villager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VillagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('ugliness')
            ->add('personnality')
            ->add('image_url', FileType::class, [
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG image.',
                    ])
                ],
                'data_class' => null,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Villager::class,
        ]);
    }
}
