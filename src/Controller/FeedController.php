<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Forms\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

/**
 * Class FeedController
 *
 * @package App\Controller
 */
class FeedController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $entry = new Entry();
        $entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();
        $form = $this->createForm(EntryType::class, $entry);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entry->setAuthor($this->security->getUser());

            $this->getDoctrine()->getManager()->persist($entry);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Willkommen bei Roundabout. Sie haben sich erfolgreich registriert.');

            return $this->redirectToRoute('feed');
        }

        return $this->render('Feed/feed.html.twig', [
            'entries' => $entries,
            'form' => $form->createView()
        ]);
    }

    public function createAction()
    {

    }
}