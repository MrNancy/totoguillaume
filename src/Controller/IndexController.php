<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $images = [];
        $dir = new \DirectoryIterator('./partner');
        foreach ($dir as $fileInfo) {
            if (!$fileInfo->isDot()) {
                $images[] = $fileInfo->getFilename();
            }
        }

        return $this->render('index/index.html.twig', [
            'images' => $images,
        ]);
    }
}
