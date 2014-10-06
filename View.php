<?php

/**
 * Class View
 */
class View {
    private $model;
    private $controller;

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
        $content = <<< HTML
<ul>
<li>One</li>
<li>Two </li>
<li>Three</li>
</ul>

HTML;

        $data = [
            'title' => "Velomania Parser",
            'content' => $content
        ];

        require_once($this->model->template);
    }

} 