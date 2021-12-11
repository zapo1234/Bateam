<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;

class PasswordresetController extends AbstractController
{
    /**
     * @Route("/passwordreset", name="passwordreset")
     */
    public function index(Request $request): Response
    {
     $form = $this->createForm(ResetPasswordRequestFormType::class);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                return $this->processSendingPasswordResetEmail(
                    $form->get('email')->getData(),
            
                );

        }
       
         return $this->render('passwordreset/index.html.twig', [
            'controller_name' => 'PasswordresetController',
            'requestForm' => $form->createView(),
        ]);
    }
}
