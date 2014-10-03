<?php

require_once 'includes/includes.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    $data = array(
        'about' => array('model' => 'AboutModel', 'view' => 'AboutView', 'controller' => 'AboutController'),
        'patterns' => array('model' => 'PatternsModel', 'view' => 'PatternsView', 'controller' => 'PatternsController'),
        'settings' => array('model' => 'SettingsModel', 'view' => 'SettingsView', 'controller' => 'SettingsController')
    );

    if (array_key_exists($page, $data)) {
        $components = $data[$page];
        $model = $components['model'];
        $view = $components['view'];
        $controller = $components['controller'];
    }

        $model = new $model();
        $controller = new $controller($model);
        $view = new $view($controller, $model);
        echo $v->output();
} else {
    $model = new Model();
    $controller = new Controller();
    $view = new View($controller, $model);
}

echo $view->output();

