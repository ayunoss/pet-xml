<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$autoloadFunction = function($class){
    $path = str_replace('\\','/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
};
spl_autoload_register($autoloadFunction);

$url    = $_SERVER['REQUEST_URI'];
$action = null;
switch ($url) {
    case '/sign-up':
        require_once 'public/views/sign-up.php';
        break;
    case '/sign-in':
        require_once 'public/views/sign-in.php';
        break;
    case '/upload-xml':
        require_once 'public/views/upload-xml.php';
        break;
    case '/exec-upload':
        $action     = 'uploadXml';
        $controller = 'Controller\Xml';
        break;
    case '/show-xml-data':
        $action     = 'showXmlData';
        $controller = 'Controller\Xml';
        break;
    case '/exec-sign-up':
        $action     = 'signUp';
        $controller = 'Controller\User';
        break;
    case '/exec-sign-in':
        $action     = 'signIn';
        $controller = 'Controller\User';
        break;
    default:
        require_once 'public/views/index.php';
        break;
}

class App {

    public function run(string $controller, string $action): void {
        $classPath = "app\\{$controller}";
        if (class_exists($classPath)) {
            $actionPath = "{$action}Action";
            if (method_exists($classPath, $actionPath)) {
                $class = new $classPath();
                $class->$actionPath();
            }
        }
    }
}

$app = new App();
if ($action !== null) {
    $app->run($controller, $action);
}