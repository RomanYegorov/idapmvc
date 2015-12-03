<?php

class Controller
{
    public function connectDb()
    {
        return new PDO('mysql:host=' . $GLOBALS['config']['mysql']['host'] . ';dbname=' . $GLOBALS['config']['mysql']['db'] . '', $GLOBALS['config']['mysql']['username'], $GLOBALS['config']['mysql']['password']);
    }

    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';

        return new $model($this->connectDb());
    }

    protected function view($view, $data = false)
    {
        require_once '../app/views/' . $view . '.php';
    }


}