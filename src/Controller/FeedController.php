<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Forms\EntryType;
use App\Service\ImageUploadService;
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
     * @var ImageUploadService
     */
    private $imgService;

    /**
     * @return Response
     */
    private $security;

    public function __construct(Security $security, ImageUploadService $imgService)
    {
        $this->security = $security;
        $this->imgService = $imgService;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();

        return $this->render('Feed/feed.html.twig', [
            'entries' => $entries,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function createAction(Request $request)
    {
        $entry = new Entry();
        $entry->setAuthor($this->getUser());
        return $this->handleRequest($request, $entry);
    }

    /**
     * @param Request $request
     * @param Entry $entry
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    private function handleRequest(Request $request, Entry $entry){
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $file = $request->files->get("media");
            var_dump($file); exit();
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

        return $this->render('feed', [
            'form' => $form->createView(),
        ]);
    }
}