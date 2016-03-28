<?php

require __DIR__ . '/../../../vendor/autoload.php';
global $is_debug;
$is_debug = false;

# exemple 1 : topic de base

$routing_keys = array(
    'user.logged',
    'user.loggedout',
    'user.registered',
    'user.password.forgot',
    'donation.toto',
    'donation.success',
    'delayed.stream.started'
);

$c        = new Pimple\Container();
$ck       = isset($argv[1]) ? $argv[1] : 'local';
$producer = new Weez\Rabbitmq\RabbitMQ($c);
for ($i = 0; $i < 10; $i++) {
    $msg = json_encode(array('blabl' => 'FTW ' . $i));
    $producer->publish($ck, $msg, $routing_keys[array_rand($routing_keys)], array(), $ck);
}


# exemple 2 : dead letter worker

$msg = json_encode(array('app_id' => 0, 'user_id' => 0, 'events' => array()));

// ces deux commandes sont identiques… (le chiffre 2 est le nombre de secondes
// qbRabbitMQ::publishDelayed('default', $msg, 'donation.success', 2);
// qbRabbitMQ::publish('default', $msg, 'delayed.donation.success', array('ttl' => 2));




# Exemple 3 : anonymous consumer

// TODO


# Exemple 4 : RPC

// TODO
