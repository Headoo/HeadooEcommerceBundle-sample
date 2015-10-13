<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ManagementController extends Controller
{
    /**
     * Displays the template to manage the store
     *
     * @Template()
     */
    public function indexAction(Request $request)
    {
    }
}
