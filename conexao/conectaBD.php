<?php

$host = 'localhost';
$dbname = 'alpha';
$user = 'postgres';
$password = 'root';

$conn_string = "host=$host dbname=$dbname user=$user password=$password";
$conn = pg_connect($conn_string);

/*
if ($conn) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Erro na conexão.";
}*/
?>
