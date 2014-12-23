<?php

namespace Gajdaw\BDDTutorial\GeographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class OceansController extends Controller
{
    /**
     * @Route("/geography/oceans/pacific.html")
     * @Template()
     */
    public function pacificAction()
    {
        return array(
                // ...
            );    }

}
