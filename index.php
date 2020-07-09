<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Entity\Request;
use Entity\User;

session_start();
// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entity"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'dbname' => 'john_unnatural',
    'user' => 'john',
    'password' => '2018',
);
// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$class = "Controllers\\" . (isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'IndexController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET) ? $_GET : null;
$postParams = isset($_POST) ? $_POST : null;
//var_dump($_GET);die;
$request = new Request();
$request->setEm($entityManager);
$request->setPost($postParams);
$request->setGet($getParams);


 if (isset($_SESSION['id']) && !empty ($_SESSION['id']) ) {
    $user = $entityManager->getRepository(User::class)->find($_SESSION["id"]);
    $request->setUser($user);
} 

$params = [
    "request"  => $request,
];

if (class_exists($class, true)) {
    $class = new $class();
    if (in_array($target, get_class_methods($class))) {
        call_user_func_array([$class, $target], $params);
    } else {
        call_user_func([$class, "index"]);
    }
} else {
    echo "404 - Error";
}
