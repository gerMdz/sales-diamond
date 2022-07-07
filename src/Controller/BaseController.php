<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class BaseController extends AbstractController
{
    protected function getUsuario(): UserInterface
    {
        return parent::getUser();
    }

    protected function getId()
    {
        return $this->getUsuario()->getId();
    }
}
