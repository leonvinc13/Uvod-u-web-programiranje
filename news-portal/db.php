<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function db(): mysqli
{
    static $connection = null;

    if ($connection === null) {
        try {
            $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $connection->set_charset('utf8mb4');
        } catch (mysqli_sql_exception $exception) {
            http_response_code(500);
            exit('Povezivanje s bazom nije uspjelo. Provjerite config.php i import baze.');
        }
    }

    return $connection;
}
