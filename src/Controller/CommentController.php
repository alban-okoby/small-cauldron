<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class CommentController extends AbstractController
{
    #[Route('/comments/{id}/vote/{direction<up|down>}', name: 'app_comment', methods: ['POST'])]
    public function commentVoteAction($id, $direction, LoggerInterface $logger)
    {
        // utiliser l'id pour une requête en base de données 

        // utilise cette logique lors d'une insertion en base de données 

        if ($direction == 'up') {
            $logger->info('Un Vote Haut');
            $currentVoteCount = rand(7, 100);
        } else {
            $logger->info('Un Vote Bas');
            $currentVoteCount = rand(0, 5);     
        }
        
        // return new JsonResponse(['votes' => $currentVoteCount]);
        return $this->json(['votes' => $currentVoteCount]);

    }
}
