<?php

namespace app\controllers;

use app\controllers\extend\AbstractController;

class NoticeController extends AbstractController
{
    public $defaultAction = 'list';

    /**
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    public function actionCreate()
    {
    }

    public function actionDelete($id)
    {

    }
}