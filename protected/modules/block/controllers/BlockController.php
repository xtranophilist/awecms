<?php

class BlockController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {
        $model = new Block;
        if (isset($_POST['Block'])) {
            $model->setAttributes($_POST['Block']);


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('/block'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        } elseif (isset($_GET['Block'])) {
            $model->attributes = $_GET['Block'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['Block'])) {
            $model->setAttributes($_POST['Block']);
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('/block'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('', $e->getMessage());
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                $this->redirect(array('/block'));
            }
        }
        else
            throw new CHttpException(400,
                    Yii::t('app', 'Invalid request.'));
    }

    public function actionIndex() {
        $model = new Block('search');
        $model->unsetAttributes();

        if (isset($_GET['Block']))
            $model->setAttributes($_GET['Block']);

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionToggle($id, $attribute, $model) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $model = $this->loadModel($id, $model);
            //loadModel($id, $model) from giix
            ($model->$attribute == 1) ? $model->$attribute = 0 : $model->$attribute = 1;
            $model->save();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/block'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel($id) {
        $model = Block::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        return $model;
    }

}