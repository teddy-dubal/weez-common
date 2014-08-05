<?php

use Pimple\Container;
use Weez\Model\ModelFactory;
use Weez\ZendModelGenerator\demo\Core\Model\Entity\User;
use Zend\Db\Adapter\Adapter;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$config    = require_once '../config/config.php';
$app       = new Container();
$app['db'] = array(
    'driver'   => 'Pdo_Mysql',
    'host'     => $config['db.host'],
    'dbname'   => 'testzdmg',
    'username' => $config['db.user'],
    'password' => $config['db.password'],
    'charset'  => 'utf8',
);

$app['entity'] = function() use ($app) {
    $db           = new Adapter($app['db']);
    $modelFactory = new ModelFactory($db);
    return $modelFactory;
};

$userManager = $app['entity']->get('\Weez\ZendModelGenerator\demo\Core\Model\Table\User');
$user        = new User();
$user->setOptions(array('name' => 'Teddy_' . time()));
$result      = $userManager->saveEntity($user);
echo sprintf('Last inserted id %s', $result) . PHP_EOL;
$result      = $userManager->fetchAll();
foreach ($result as $v) {
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
    $userToDelete = new User();
    $userToDelete->setOptions($v);
    $userManager->deleteEntity($userToDelete);
}
//echo '<pre>';
//var_dump($result);
//echo '</pre>';


