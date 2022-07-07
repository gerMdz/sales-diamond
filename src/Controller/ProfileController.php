<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Usuario;
use App\Form\ChangePwsdFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile", name="app_user_profile")
 */
class ProfileController extends BaseController
{
    /**
     * @Route("/user", name="app_user_profile")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/cambiar_contrasenha",name="app_user_changepswd")
     * @IsGranted("ROLE_USER")
     */
    public function changePswd(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();
        $form = $this->createForm(ChangePwsdFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password =  $form["justpassword"]->getData();
            $newPassword = $form["newpassword"]->getData();

            if ($this->passwordEncoder->isPasswordValid($user, $password)) {
                $user->setPassword($this->passwordEncoder->encodePassword($user, $newPassword));
            } else {
                $this->addFlash("error", "No se pudo cambiar la contraseña");
                return $this->render("admin/params/changeMdpForm.html.twig", ["passwordForm" => $form->createView()]);
            }

            $this->usuarioManager->updateUser($user);
            $this->addFlash("success", "Contraseña cambiada con exito");
            return $this->redirectToRoute("app_admin_index");
        }
        return $this->render("admin/params/changeMdpForm.html.twig", ["passwordForm" => $form->createView()]);
    }
}
