<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * River controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * Homepage
     *
     * @Route("/", name="homepage")
     * @Method("GET")
     * @Template()
     */
    public function homeAction()
    {
        return array();
    }
}
