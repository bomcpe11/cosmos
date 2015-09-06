<?php

/*return [
    'class' => 'yii\db\Connection',
    'dsn' => 'oci:host=localhost;dbname=localhost/orcl.168.1.6;charset=UTF8',
    'username' => 'ewarning_db_prod',
    'password' => 'ewarning_db_prod',
//     'charset' => 'utf8',
]; */
return [
    'class' => 'yii\db\Connection',
//     'dsn' => 'oci:host=192.168.2.13;dbname=192.168.2.13/osrddb2;charset=UTF8',
	'dsn' => 'mysql:host=103.13.28.239;dbname=envfund;charset=UTF8',
    'username' => 'envfund',
    'password' => 'envfund_2015',
//     'charset' => 'utf8',
];

// return [
//     'class' => 'yii\db\Connection',
// //     'dsn' => 'oci:host=192.168.2.13;dbname=192.168.2.13/osrddb2;charset=UTF8',
// 	'dsn' => 'mysql:host=localhost;dbname=envfund;charset=UTF8',
//     'username' => 'root',
//     'password' => 'password',
// //     'charset' => 'utf8',
// ]; 