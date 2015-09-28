<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ManagementController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        
        return array('name' => 'ana');
    }
}
