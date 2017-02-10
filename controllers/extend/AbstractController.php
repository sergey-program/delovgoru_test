<?php

namespace app\controllers\extend;

use app\models\Notice;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class AbstractController
 *
 * @package app\controllers\extend
 */
abstract class AbstractController extends Controller
{
    /**
     * @param int  $id
     * @param bool $exception
     *
     * @return Notice
     * @throws NotFoundHttpException
     */
    public function loadNotice($id, $exception = true)
    {
        $model = Notice::findOne($id);

        if (!$model && $exception) {
            throw new NotFoundHttpException('Notice model not found.');
        }

        return $model;
    }
}