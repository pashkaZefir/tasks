<?php


namespace Controllers;


use Models\Task;

class Tasks extends Base
{
    public function index($params)
    {
    }

    public function add($params, $method)
    {
        $values = [];

        if ($method === 'POST') {
            $this->createTask($params);
            return $this->redirection("/?success_create");
        }

        return $this->render("TaskAdd", $values);
    }

    public function edit($params, $method)
    {
        if (!static::isLoggedIn()) {
            return $this->redirection("/Login");
        }

        $values = [];

        if ($method === 'POST') {
            $this->saveTask($params);
            $values['alert'] = static::alert("Вы успешно обновили таск", 'success');
        }

        $task = new Task();
        $values['task'] = $task->get($params['id']);

        return $this->render("TaskEdit", $values);
    }

    protected function createTask($params)
    {
        $task = new Task();
        $task->username = $params['username'];
        $task->email = $params['email'];
        $task->description = $params['description'];

        return $task->create();
    }

    protected function saveTask($params)
    {
        $task = new Task();
        $task->id = $params['id'];
        $task->username = $params['username'];
        $task->email = $params['email'];
        $task->ready = (isset($params['ready']) && $params['ready'] === 'on') ? 1 : 0;
        $task->description = $params['description'];

        return $task->update();
    }

}