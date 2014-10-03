<?php

require_once 'includes.php';

if (!empty($page = $_GET['page'])) {

    $data = array(
        'about' => array('model' => 'AboutModel', 'view' => 'AboutView', 'controller' => 'AboutController'),
        'patterns' => array('model' => 'PatternsModel', 'view' => 'PatternsView', 'controller' => 'PatternsController'),
        'settings' => array('model' => 'SettingsModel', 'view' => 'SettingsView', 'controller' => 'SettingsController')
    );

//    foreach($data as $key => $components){
//        if ($page == $key) {
//            $model = $components['model'];
//            $view = $components['view'];
//            $controller = $components['controller'];
//            break;
//        }
//    }

    echo "WWWWW!!!!!" . $page;

    if (array_key_exists($page, $data)) {
        $components = $data[$page];
        $model = $components['model'];
        $view = $components['view'];
        $controller = $components['controller'];
    }

    if (isset($model)) {
        $m = new $model();
        $c = new $controller($model);
        $v = new $view($model);
        echo $v->output();
    }
} else {
    $model = new Model();
    $view = new View();
    $controller = new Controller();
}

echo $view->output();

