<?php


namespace App\Controller;


use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function administer()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        return $this->render('tasks/administer/administer.html.twig', ['tasks' => $tasksRepository->findAll()]);
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
     * @return JsonResponse
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
     * @param $tasks
     * @return array[]
     */
    private function organizeTasksIntoWeeks($tasks)
    {
        $weeks = [
            [
                'tasks' => [],
                'hours' => 0.0,
                'week_number' => 1
            ]
        ];
        foreach($tasks as $task)
        {
            $taskHasBeenSet = false;
            $task_hours = $task->getHoursAsFloat();

            foreach($weeks as $index => $week)
            {
                if($week['hours'] + $task_hours <= 40.0)    //40h work week
                {
                    array_push($weeks[$index]['tasks'], $task);
                    $weeks[$index]['hours'] += $task_hours;
                    $taskHasBeenSet = true;
                }
            }

            if(!$taskHasBeenSet)    //new week
            {
                array_push($weeks, [
                    'tasks' => [$task],
                    'hours' => $task_hours,
                    'week_number' => count($weeks) + 1
                ]);
            }
        }
        return $weeks;
    }

    /**
     * @Route("/organize", name="route-tasks-organize")
     * @return Response
     */
    public function organize()
    {
        $tasksRepository = $this->getDoctrine()->getRepository(Task::class);
        return $this->render('tasks/organize/organize.html.twig',
            ['weeks' => $this->organizeTasksIntoWeeks($tasksRepository->findBy([], ['hours' => 'DESC']))]
        );
    }
}