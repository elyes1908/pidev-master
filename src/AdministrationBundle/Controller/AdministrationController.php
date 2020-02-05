<?php

namespace AdministrationBundle\Controller;

use AdministrationBundle\Entity\etudiant;
use AdministrationBundle\Form\etudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdministrationController extends Controller
{

    public function AjoutAction(Request $request)
    {
        $etudiant = new etudiant();


        $form = $this->createForm(etudiantType::class, $etudiant);
        $form->handleRequest($request);
        $form1 = $form->createView();

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();


        }
        return $this->render('@Administration/Default/ajout.html.twig', array('f' => $form1));

    }
    public function sessionAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        try
        {
            switch ($user->getRoles()[0]) {
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
        return $this->render('@Administration/Default/session.html.twig', array('id'=>$user));
    }

}
