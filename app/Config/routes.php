<?php
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));

Router::connect(
    '/statistics/utm/list',
    array('controller' => 'statistics', 'action' => 'utm_list')
);

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
