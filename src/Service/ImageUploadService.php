<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ImageUploadService
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * @param ParameterBagInterface $params
     * @param TokenStorageInterface $token
     */
    public function __construct(ParameterBagInterface $params, TokenStorageInterface $token)
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

            return $this->targetDirectory . $fileName;
        } catch (FileException $e) {
            error_log($e->getMessage());

            return null;
        }
    }

    /**
     * @param ParameterBagInterface $params
     * @param TokenStorageInterface $token
     * @return string
     */
    private function generateTargetDirectory(ParameterBagInterface $params, TokenStorageInterface $token)
    {
        return $params->get('kernel.project_dir') . "/public/uploads/".$token->getToken()->getUsername()."/";
    }
}