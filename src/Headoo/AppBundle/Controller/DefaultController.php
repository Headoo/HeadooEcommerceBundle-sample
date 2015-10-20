<?php

namespace Headoo\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * Displays the homepage
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {

    }
}
