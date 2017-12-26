<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminInquiryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('processStatus', ChoiceType::class, [
            'label' => 'ステータス',
            'choices' => [
                '未対応' => 0,
                '対応中' => 1,
                '対応済み' => 9
            ],
            'empty_data' => 0,
            'expanded' => true
        ])
            ->add('processMemo', TextareaType::class, [
            'label' => '対応メモ'
        ])
            ->add('send', SubmitType::class, [
            'label' => '送信する'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => [
                'admin'
            ]
        ]);
    }
}