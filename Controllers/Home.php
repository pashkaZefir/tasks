<?php


namespace Controllers;


use Models\Task;

class Home extends Base
{
    public function index($params)
    {
        $values = [];
        $page = (int)$params['page'] ?? 1;
        $orderBy = $params['orderBy'] ?? null;
        $orderDirection = $params['orderDirection'] ?? null;

        $saveOrder = null;
        if ($orderBy && $orderDirection) {
            $saveOrder = "orderBy=$orderBy&orderDirection=$orderDirection";
        }

        if (isset($params['success_login'])) {
            $values['alert'] = static::alert("Вы успешно вошли", 'success');
        }
        if (isset($params['success_create'])) {
            $values['alert'] = static::alert("Вы успешно добавили таск", 'success');
        }

        $values['tasks'] = Task::select($page, [], join(" ", array_filter([$orderBy, $orderDirection])));
        $values['pagination'] = $this->renderPartial('Pagination',
            ['pages' => Task::getPagination(), 'current' => $page, 'saveOrder' => $saveOrder]
        );
        $values['page'] = $page;
        $values['orderDirection'] = $orderDirection;
        $values['orderBy'] = $orderBy;

        return $this->render('Home', $values);
    }
}