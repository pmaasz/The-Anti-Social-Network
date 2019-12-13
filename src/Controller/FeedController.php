<?php

namespace App\Controller;

use App\Entity\Entry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FeedController
 *
 * @package App\Controller
 */
class FeedController extends AbstractController
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();

        return $this->render('feed.html.twig', [
            'entries' => $entries
        ]);
    }
}