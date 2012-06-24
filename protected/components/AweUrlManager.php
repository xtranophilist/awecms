<?php

class AweUrlManager extends CUrlManager {

    public $appendParams = false;

    public function createUrl($route, $params = array(), $ampersand = '&') {

        //for admin and admin/*
        $parts = explode('/', $route);

        //do not mess with gii
        if ($parts[0] == 'gii')
            return parent::createUrl($route, $params, $ampersand);

        if (Yii::app()->hasModule($parts[0]) && isset($parts[1]) && $parts[1] == Yii::app()->getModule($parts[0])->defaultController) {
            unset($parts[1]);
            $route = implode('/', $parts);
        }

        if (substr(Yii::app()->getRequest()->pathInfo, 0, 6) == 'admin/' || Yii::app()->getRequest()->pathInfo == 'admin') {
            $route = 'admin/' . $route;
        }

        return parent::createUrl($route, $params, $ampersand);
    }

    public function parseUrl($request) {
        return parent::parseUrl($request);
    }

}