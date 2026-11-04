<?php
require_once 'config/autoload.php';
require_once 'config/routes.php';
require_once 'config/config.php';
require_once 'helper/url_helper.php';

$url = $_GET['url'] ?? $route['default_controller'] . '/index';
if ($url == '') {
    $url = $route['default_controller']. '/index';
}

$url = trim($url, '/');
$segment = explode('/', $url);

if (isset($segment[0]) && strtolower($segment[0]) == 'c_master') {
    $folder = $segment[0];
    $controller = $segment[1] ?? $route['default_controller'];
    $method = $segment[2] ?? 'index';
    $parameter = $segment[3] ?? null;

    // Cuma ini aja pengamannya: huruf pertama dibesarin
    // penyewa_C069 -> Penyewa_C069
    $controllerName = ucfirst($controller);
    $controllerFile = 'controller/'.$folder.'/'.$controllerName.'.php';
} else {
    $controller = $segment[0] ?? $route['default_controller'];
    $method = $segment[1] ?? 'index';
    $parameter = $segment[2] ?? null;
    $controllerName = ucfirst($controller);
    if (file_exists('controller/'.$controllerName.'.php')) {
        $controllerFile = 'controller/'.$controllerName.'.php';
    } else {
        $controllerFile = 'controller/c_master/'.$controllerName.'.php';
    }
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $objController = new $controllerName();
    if (method_exists($objController, $method)) {
        if ($parameter !== null) {
            $objController->$method($parameter);
        } else {
            $objController->$method();
        }
    } else {
        echo "Method $method tidak ditemukan di $controllerName.";
    }
} else {
    echo "Controller tidak ditemukan: $controllerFile";
}
?>