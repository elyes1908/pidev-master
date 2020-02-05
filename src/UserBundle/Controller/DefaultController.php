<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $u = $this->container->get('security.token_storage')->getToken()->getUser();
        try
        {
            switch ($u->getRoles()[0]) {
                case "ADMIN":
                    return $this->redirect('access/admin');
                    break;
                case "PARENT":
                    return $this->redirect('access/parent');
                    break;
                case "ELEVE":
                    return $this->redirect('access/eleve');
                    break;
                case "ENSEIGNANT":
                    return $this->redirect('access/enseignant');
                    break;
            }
        }
        catch (\Throwable $e)
        {
            return $this->redirect('http://localhost/pidev/web/app_dev.php/login');

        };

    }






    public function adminAction()
    {
        return $this->render('@User/Default/admin.html.twig');

    }


    public function parentAction()
    {
        return $this->render('@User/Default/parent.html.twig');

    }



    public function eleveAction()
    {
        return $this->render('@User/Default/eleve.html.twig');

    }


    public function enseignantAction()
    {
        return $this->render('@User/Default/enseignant.html.twig');

    }





}
