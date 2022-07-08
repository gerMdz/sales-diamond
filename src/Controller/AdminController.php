<?php


namespace App\Controller;



use App\Manager\UsuarioManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{



    public function __construct()
    {


    }

    /**
     * @Route("/",name="app_admin_index")
     */
    public function index(): Response
    {
        return $this->render("admin/main.html.twig");

    }
    /**
     * @Route("/cooming_soom",name="cooming_soon")
     */
    public function coomingSoom(){
        return $this->render("Default/comming_soom.html.twig");

    }
    /**
     * @Route("/cooming_soom2",name="cooming_soon2")
     */
    public function inventario(){
        return $this->render("Default/comming_soom.html.twig");

    }




}
