<?php

namespace App\Controller;

use Twig\Environment;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuestionController extends AbstractController
{
    
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment): Response
    {
        // Exemple d'utilisation du service twig directement 
        $contenuHtml = $twigEnvironment->render('question/homepage.html.twig');

        return new Response($contenuHtml);
    //   return $this->render('question/homepage.html.twig');
    }
    /**
     * @Route("/questions/{slug}", name="app_question_show")
     */
    public function show($slug, MarkdownParserInterface $markdownParser, CacheInterface $cache)
    {
        $questionText = '_I\'ve been turned into a cat, any ```thoughts``` on how to turn back? While I\'m **adorable**, I don\'t really care for cat food._';
        // $parsedQuestionText = $markdownParser->transform($questionText);
        $parsedQuestionText = $cache->get('markdow_'.md5($questionText), function() use($questionText, $markdownParser) {
            return $markdownParser->transformMarkdown($questionText);
        });

        $answers = [
            'Make sure your cat is sitting `purrrfectly` still ?',
            'Honestly, I like furry shoes better than MY cat',
            'Maybe... try saying the spell backwards?',
        ];
        return $this->render('question/show.html.twig', [
            'question' => str_replace('-', ' ', $slug), 
            'answers' => $answers,
            'questionText' => $questionText,
            'parsedQuestionText' => $parsedQuestionText
        ]);
    }
}
