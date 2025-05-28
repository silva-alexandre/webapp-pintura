<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
// Campos extras do form
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            // 'plainPassword' não é mapeado diretamente na entidade
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false, 
                'attr' => ['autocomplete' => 'new-password'],
                // Opções adicionais como 'label' podem ser adicionadas aqui
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Qualquer objeto que implemente UserInterface pode ser passado
            'data_class' => User::class,
        ]);
    }
}
