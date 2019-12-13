<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class OverviewController
 *
 * @package App\Controller
 */
class OverviewController extends AbstractController
{
    public function indexAction()
    {
        $this->render('index.html.twig');
    }
}