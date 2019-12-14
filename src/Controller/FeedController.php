<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Forms\EntryType;
use App\Service\ImageUploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FeedController
 *
 * @package App\Controller
 */
class FeedController extends AbstractController
{
    /**
     * @var ImageUploadService
     */
    private $imgService;

    /**
     * FeedController constructor.
     * @param ImageUploadService $imgService
     */
    public function __construct(ImageUploadService $imgService)
    {
        $this->imgService = $imgService;
    }


    /**
     * @return Response
     */
    public function indexAction()
    {
        $entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();

        return $this->render('Feed/feed.html.twig', [
            'entries' => $entries
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
            var_dump($file); exit;
            //Media Upload
            if(isset($file['media'])){
                $entry->setMedia($this->imgService->upload($file['cover']));
            }

            $entityManager->persist($entry);
            $entityManager->flush();


            return $this->redirectToRoute("book_list_admin");
        }

        return $this->render('book/admin/form.html.twig', [
            'form' => $form->createView(),
            'entry' => $entry
        ]);
    }
}