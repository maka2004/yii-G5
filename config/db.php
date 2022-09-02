<?php

$db_name = getenv('DB_NAME');
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $db_host . ';dbname=' . $db_name,
    'username' => $db_user,
    'password' => $db_password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
