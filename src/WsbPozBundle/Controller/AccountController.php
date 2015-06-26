<?php

namespace WsbPozBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WsbPozBundle\Form\Model\UserRegistration;
use WsbPozBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @Template("WsbPozBundle:Account:register.html.twig")
     */
    public function registerAction()
    {
        $registration = new User();
        $form = $this->createForm(new UserRegistration(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));

        return array('form' => $form->createView());
    }

    /**
     * @Route("/register/account_create", name="account_create")
     * @Template("WsbPozBundle:Account:register.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new UserRegistration(), new User());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $registration = $form->getData();

            $plainPassword = $form->getData('password');
            $user = new User();
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($plainPassword,1);

            $registration->setPassword($encoded);
            $registration->setisActive(1);
            $registration->setisAdmin(0);
            /*
            $form->setData('isActive', true);
            $form->setData('isAdmin', false);
            $form->setData('newsletter', false);
            */
            $em->persist($registration);
            $em->flush();

            return $this->redirectToRoute('login_route');
        }

        return array('form' => $form->createView());
    }

}
