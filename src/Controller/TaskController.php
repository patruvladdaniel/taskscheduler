<?php


namespace App\Controller;


use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function administer()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        return $this->render('tasks/administer.html.twig', ['tasks' => $tasksRepository->findAll()]);
    }

    /**
     * @Route("/tasks")
     * @return Response
     */
    public function getTasks()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        return $this->render('tasks/tasks.html.twig', ['tasks' => $tasksRepository->findAll()]);
    }

    /**
     * @Route("/addTask", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function addTask(Request $request, EntityManagerInterface $entityManager)
    {
        //build task object
        $task = new Task();
        $task->setText($request->get('text'));
        $task->setHours(new \DateTime(date("H:i:s", mktime(
            (int)$request->get('hours'),
            ($request->get('hours')-(int)$request->get('hours'))*60,
            0)
        )));
        //commit object to database
        $entityManager->persist($task);
        $entityManager->flush();
        //return
        return $this->json(["message" => "Task added successfully!"]);
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