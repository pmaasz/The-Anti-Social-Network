<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class ImageUploadService
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * @param ParameterBagInterface $params
     */
    public function __construct(ParameterBagInterface $params, TokenStorage $token)
    {
        $this->targetDirectory = $this->generateTargetDirectory($params, $token);
    }

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        $fileName = time()."_".rand(0,100) . $file->guessExtension();

        try {
            $file->move($this->targetDirectory . "/uploads", $fileName);

            return "/uploads/" . $fileName;
        } catch (FileException $e) {
            error_log($e->getMessage());

            return null;
        }
    }

    /**
     * @param ParameterBagInterface $params
     *
     * @return string
     */
    private function generateTargetDirectory(ParameterBagInterface $params, TokenStorage $token)
    {
        return $params->get('kernel.project_dir') . "/public/uploads/".$token->getToken()->getUsername()."/";
    }
}