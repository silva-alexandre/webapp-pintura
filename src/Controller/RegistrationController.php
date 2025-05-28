<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    #[IsGranted('ROLE_ADMIN', message: 'Não há nada por aqui!')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        // Cria uma instância vazia do User
        $user = new User();

        // Cria o form com base no RegistrationFormType, ligando ao $user
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Lê os dados submetidos (se houver)
        $form->handleRequest($request);

        // Se o form foi enviado e é válido
        if ($form->isSubmitted() && $form->isValid()) {
            // Pega a senha em texto puro do campo 'plainPassword'
            $plainPassword = $form->get('plainPassword')->getData();
            
            // Se houver senha digitada, gera o hash
            if ($plainPassword) {
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plainPassword
                );
                $user->setPassword($hashedPassword);
            }

            // Persiste o usuário no banco
            $entityManager->persist($user);
            $entityManager->flush();

            // Redireciona, por exemplo, para a página de login
            return $this->redirectToRoute('app_login');
        }

        // Se não foi submetido ou não é válido, renderiza o form
        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
