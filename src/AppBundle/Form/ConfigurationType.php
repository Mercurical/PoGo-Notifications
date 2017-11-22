<?php

namespace AppBundle\Form;

use AppBundle\Data\Pokemons;
use AppBundle\Entity\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('skype_username', TextType::class, [
            'label' => 'Skype Username',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->add('pokemonIDs', ChoiceType::class, [
            'choices' => Pokemons::getParsedPokemons(),
            'multiple' => true,
            'label' => 'Pokemon IDs',
            'attr' => [
                'class' => 'form-control',
            ],
        ])
        ->get('pokemonIDs')
            ->addModelTransformer(new CallbackTransformer(
                function ($stringToArray) {
                    return json_decode($stringToArray, true);
                },
                function ($arrayToString) {
                    return json_encode($arrayToString);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Configuration::class,
        ));
    }
}
