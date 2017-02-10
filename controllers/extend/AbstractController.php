<?php

namespace app\controllers\extend;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class AbstractController
 *
 * @package app\controllers\extend
 */
abstract class AbstractController extends Controller
{
    public function loadNotice($id, $exception = true)
    {
        $model = '';

        if (!$model && $exception) {
            throw new NotFoundHttpException('Notice model not found.');
        }

        return $model;
    }
}