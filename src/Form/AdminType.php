<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;

class AdminType extends AbstractType
{
    /**
     * @var UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $userPasswordHasher;
    /**
     * @var Security
     */
    private Security $security;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, Security $security)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /**@var Admin $admin * */
        $admin = $builder->getData();

        $builder
            ->add('username', TextType::class, [
                'disabled' => $builder->getData() ? true : false,
            ]);

        if ($this->security->isGranted('ROLE_SUPER_ADMIN')){
            $builder
                ->add('roles', ChoiceType::class, [
                    'row_attr' => [
                        'class' => 'px-3'
                    ],
                    'choices' => [
                        '超级管理员' => 'ROLE_SUPER_ADMIN',
                        '管理员' => 'ROLE_ADMIN'
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    'help' => '备注：超级管理员具有最高权限！'
                ]);
        }

        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => '两次密码不一致',
                'required' => false,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class);

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($admin) {
                $formData = $event->getData();
                $plainPassword = $formData['plainPassword'];
                if ($plainPassword['first'] !== '') {
                    if ($admin) {
                        //编辑管理员用户
                        $newPassword = $this->userPasswordHasher->hashPassword($admin, $plainPassword['first']);
                        $admin->setPassword($newPassword);
                    }
                }
            });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
