<?php

namespace Pimterest\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UploadController extends Controller
{
    public function uploadAction(Request $request)
    {
        $files = $request->files;
        $url = '';

        if (!empty($files)) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $files->get('file');
            $targetFile = $this->getMediaRootDirectory();
            $uploadedFile->move($targetFile, $uploadedFile->getClientOriginalName());
            $url= sprintf('%s/media/%s', $request->getBasePath(), $uploadedFile->getClientOriginalName());
        }

        return new JsonResponse([
            'url'=> $url
        ]);
    }

    protected function getMediaRootDirectory()
    {
        $kernelRoot = $this->container->getParameter('kernel.root_dir');

        return realpath($kernelRoot . '/../web/media');
    }
}
