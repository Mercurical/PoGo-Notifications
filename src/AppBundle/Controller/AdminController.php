<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Configuration;
use AppBundle\Entity\User;
use AppBundle\Form\ConfigurationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
        $configRepo = $this->getDoctrine()->getRepository('AppBundle:Configuration');

        $userID = $this->getUser()->getId();
        $config = $configRepo->findOneBy(['user' => $userID, 'isUsed' => 1]);

        $form = $this->createForm(ConfigurationType::class, $config);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        return $this->render('@App/admin/index.html.twig', ['form' => $form->createView()]);
    }
}