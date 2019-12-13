<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OverviewController
 *
 * @package App\Controller
 */
class OverviewController extends AbstractController
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('./landingpage/landingpage.html.twig');
    }
}