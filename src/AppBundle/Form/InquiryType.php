<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Inquiry;

class InquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => '氏名'])
            ->add('email', TextType::class, ['label' => 'メールアドレス'])
            ->add('tel', TextType::class, ['label' => '電話番号', 'required' => 'false'])
            ->add('type', ChoiceType::class, ['label' => 'タイプ', 'choices' => ['公演について' => 1, 'その他' => 9], 'expanded' =>true])
            ->add('content', TextareaType::class, ['label' => 'お問い合わせ内容'])
            ->add('send', SubmitType::class, ['label' => '送信する'])
        ;
    }


}