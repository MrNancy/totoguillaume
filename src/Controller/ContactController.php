<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(
        Request $request,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createFormBuilder()
                     ->add('subject', TextType::class, [
                         'label' => $translator->trans('contact-message.subject'),
                     ])
                     ->add('email', EmailType::class, [
                         'label' => $translator->trans('contact-message.email'),
                     ])
                     ->add('message', TextareaType::class, [
                         'label' => $translator->trans('contact-message.message'),
                     ])
                     ->add('submit', SubmitType::class, [
                         'label' => $translator->trans('send'),
                         'attr'  => [
                             'class' => 'btn w-100 btn-light',
                         ],
                     ])
                     ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('warning', $translator->trans('contact-message.failed'));

                return $this->redirectToRoute('contact');
            }

            $this->addFlash('success', $translator->trans('contact-message.success'));

            return $this->redirectToRoute('index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
