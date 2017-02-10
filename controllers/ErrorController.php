<?php

namespace app\controllers;

use app\controllers\extend\AbstractController;

/**
 * Class ErrorController
 *
 * @package app\controllers
 */
class ErrorController extends AbstractController
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'view' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
}