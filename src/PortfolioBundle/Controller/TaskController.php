<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 * @Security("has_role('ROLE_USER')")
 */
class TaskController extends Controller
{
  /**
   * @Route("/")
   * @Template()
   */
  public function indexAction() {
    return [];
  }
}
