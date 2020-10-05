<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private function getTasks(){
        return [
            [
                'text' => "Lorem Ipsum",
                'hours' => random_int(1, 20),
                'done' => false
            ],
            [
                'text' => "Lorem Ipsum amet sit dolor",
                'hours' => random_int(1, 20),
                'done' => true
            ],
            [
                'text' => "Lorem Ipsum",
                'hours' => random_int(1, 20),
                'done' => false
            ],

        ];
    }
    /**
     * @Route("/")
     * @return Response
     */
    public  function administer()
    {
        return $this->render('tasks/administer.html.twig', ['tasks' => $this->getTasks()]);
        return new Response('administration');
    }

    /**
     * @Route("/organize")
     * @return Response
     */
    public function organize()
    {
        return $this->render('tasks/organize.html.twig',
            ['number' => 10]
        );
    }
}