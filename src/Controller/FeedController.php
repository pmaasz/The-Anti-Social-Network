<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Forms\EntryType;
use App\Service\ImageUploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @var ImageUploadService
     */
    private $imgService;

    /**
     * FeedController constructor.
     *
     * @param ImageUploadService $imgService
     */
    public function __construct(ImageUploadService $imgService)
    {
        $this->imgService = $imgService;
    }

    /**
     * @return RedirectResponse|Response
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        $entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();

        return $this->render('Feed/feed.html.twig', [
            'entries' => $entries,
        ]);
    }

    /**
     * @param Request $request
     * @param Security $security
     *
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, Security $security)
    {
        $entry = new Entry();
        $entry->setAuthor($security->getUser());

        return $this->handleRequest($request, $entry);
    }

    /**
     * @param Request $request
     * @param Entry $entry
     * @return RedirectResponse|Response
     */
    private function handleRequest(Request $request, Entry $entry){
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $file = $request->files->get("media");

            //Media Upload
            if(isset($file['media'])){
                $entry->setMedia($this->imgService->upload($file['media']));
            }

            //YT-Videos
            $text = $entry->getBody();
            preg_match_all('/https:\/\/www\.youtube\.com\/watch\?v=([^\s]*)( |$)/', $text, $matches);

            foreach ($matches[1] as $key => $id) {
                $entry->setLink($id);
                $text = str_replace($matches[1][$key], "", $text);
            }

            $entityManager->persist($entry);
            $entityManager->flush();

            $this->addFlash('success', 'Willkommen bei Roundabout. Sie haben sich erfolgreich registriert.');

            return $this->redirectToRoute('index');
        }

        return $this->render('Feed/feedInput.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}