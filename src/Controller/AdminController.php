<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/Admin/Home", name="admin_home")
     */
    public function Admin_home()
    {
        return $this->render('Admin/Admin_home.html.twig');
    }
}