<?php

use Pimple\Container;
use Weez\Model\ModelFactory;
use Weez\Generator\demo\Core\Model\Entity\Accounts;
use Weez\Generator\demo\Core\Model\Entity\Bugs;
use Weez\Generator\demo\Core\Model\Entity\User;
use Zend\Db\Adapter\Adapter;

require_once '../vendor/autoload.php';

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
    $modelFactory = new ModelFactory($db, $app);
    return $modelFactory;
};

$timestart = microtime(true);
$userManager = $app['entity']->get('\Weez\Generator\demo\Core\Model\Table\User');
$nbUser      = 10;
echo "***********************************************" . "<br>";
//Ajouter x users
echo sprintf('Ajout de %s users', $nbUser) . "<br>";
for ($i = 0; $i < $nbUser; $i++) {
    $user   = new User();
    $user->setOptions(array('name' => 'Teddy_' . $i));
    $user->setOptions(array('name' => 'Teddy'));
    $result = $userManager->saveEntity($user);
    echo sprintf('User id:%s', $result) . "<br>";
}
echo "***********************************************" . "<br>";
//Afficher les x users
echo sprintf('Affichage des %s users', $nbUser) . "<br>";
$result   = $userManager->fetchAll();
$id_Users = array();
foreach ($result as $v) {
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
    $id_Users[] = $v['id'];
}
$key = array_rand($id_Users);
$id  = $id_Users[$key];
echo "***********************************************" . "<br>";
echo sprintf('Find user id : %s', $id) . "<br>";
$u   = $userManager->find($id);

echo '<pre>';
var_dump($u);
echo '</pre>';
echo "***********************************************" . "<br>";
echo "***********************************************" . "<br>";
$name = 'Teddy';
echo sprintf('Find user by criteria (name) : %s', $name) . "<br>";
$u    = $userManager->findBy(array('name' => $name), 'id ASC', 10, null, false);
echo '<pre>';
var_dump($u);
echo '</pre>';
echo "***********************************************" . "<br>";
$name = 'Teddy';
echo sprintf('Count by criteria (name) : %s', $name) . "<br>";
$u    = $userManager->countBy(array('name' => $name));
echo '<pre>';
var_dump($u);
echo '</pre>';
echo "***********************************************" . "<br>";
echo sprintf('Suppression des %s users', $nbUser) . "<br>";
foreach ($id_Users as $v) {
    $userToDelete = new User();
    $userToDelete->setId($v);
    $res          = $userManager->deleteEntity($userToDelete);
}

echo "***********************************************" . "<br>";

$timeend = microtime(true);
$time    = $timeend - $timestart;

$page_load_time = number_format($time, 3);
//echo "Debut du script: " . date("H:i:s", $timestart);
//echo "<br>Fin du script: " . date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";
