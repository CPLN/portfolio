<?php

namespace PortfolioBundle\Controller;

use PortfolioBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class UserController extends Controller
{
   /**
    * @Route("/user/")
    * @Method({"GET"})
    * @Template()
    */
   public function listAction() {
       $em = $this->getDoctrine()->getManager();
       $users = $em->getRepository('PortfolioBundle:User')->findAll();
       return ['users' => $users];
   } 
   
   /**
    * @Route("/login")
    * @Method({"GET", "POST"})
    * @Template()
    */
    public function loginAction(Request $request) {
        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, ['label' => 'Adresse e-mail'])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer un e-mail de connexion'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('PortfolioBundle:User')->findOneByEmail($form->getData()['email']);
            if ($user == null) {
                $user = new User();
                $user->setEmail($form->getData()['email']);
                $em->persist($user);
            }
            $user->setConnectionToken($this->generateToken());
            
            $em->flush();
            
            // TODO Enlever ce code destiné à la version de dev
            echo '<script>alert("Lien de connexion : ' . $this->generateUrl('portfolio_user_connection', ['token' => $user->getConnectionToken()], UrlGeneratorInterface::ABSOLUTE_URL) . '")</script>';
            
            // TODO Envoi d'un e-mail lors du passage en prod
        }
        return ['form' => $form->createView()];
    }
    
    /**
     * @Route("/connection/{token}")
     * @Method({"GET"})
     */
    public function connectionAction($token) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PortfolioBundle:User')->findOneByConnectionToken($token);
        if ($user != null) {
            if ($user->connect($token)) {
                $this->container->get('fos_user.security.login_manager')->loginUser('main', $user);
                $user->setConnectionToken(null);
                $user->setConnectionRequestTime(null);
                $em->flush();
            }
        }
        return $this->redirect($this->generateUrl('portfolio_task_index'));
    }
    
    private function generateToken($length = 20) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
          $index = rand(0, $count - 1);
          $result .= substr($chars, $index, 1);
        }
        return $result;
    }
}
