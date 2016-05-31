<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PortfolioBundle\Entity\Domain;
use PortfolioBundle\Form\DomainType;

/**
 * @Route("/domain")
 */
class DomainController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $domains = $em->getRepository('PortfolioBundle:Domain')->findBy([], ['name' => 'ASC']);
        return ['domains' => $domains];
    }

    /**
     * @Route("/add")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $domain = new Domain();
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
          $em->persist($domain);
          $em->flush();
          return $this->redirect($this->generateUrl('portfolio_domain_show', ['slug' => $domain->getSlug()]));
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{slug}")
     * @Method({"GET"})
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('PortfolioBundle:Domain')->findOneBySlug($slug);
        return [ 'domain' => $domain ];
    }

    /**
     * @Route("/{slug}/edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('PortfolioBundle:Domain')->findOneBySlug($slug);
        $form = $this->createForm(DomainType::class, $domain);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
          $em->flush();
          return $this->redirect($this->generateUrl('portfolio_domain_show', ['slug' => $domain->getSlug()]));
        }
        return ['form' => $form->createView(), 'domain' => $domain];
    }

    /**
     * @Route("/{slug}/delete", requirements={"method" = "GET"})
     * @Method({"GET"})
     * @Template()
     */
    public function deleteAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('PortfolioBundle:Domain')->findOneBySlug($slug);
        $form = $this->createFormBuilder()
          ->setAction($this->generateUrl('portfolio_domain_delete', ['slug' => $domain->getSlug()]))
          ->setMethod('DELETE')
          ->add('submit', SubmitType::class, ['label' => 'Supprimer'])
          ->getForm();

        return ['domain' => $domain, 'form' => $form->createView()];
    }
    
    /**
     * @Route("/{slug}/delete", requirements={"method" = "DELETE"})
     * @Method({"DELETE"})
     */
    public function confirmDeleteAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('PortfolioBundle:Domain')->findOneBySlug($slug);
        $em->remove($domain);
        $em->flush();
        return $this->redirect($this->generateUrl('portfolio_domain_list'));
    }
}
