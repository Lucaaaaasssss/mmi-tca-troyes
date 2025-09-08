<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuggyController extends AbstractController
{
    /**
     * @return array<string, int>
     */
    private function getData(): array
    {
        return [
            'key1' => 1,
            'key2' => 2,
        ];
    }

    #[Route('/buggy', name: 'app_buggy_index', methods: ['GET'])]
    public function index(): Response
    {
        // getData() EST utilisée -> plus d’erreur PHPStan "unused"
        return $this->json($this->getData());
    }
}
