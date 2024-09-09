<?php
$hostname ="localhost";
$bancodedados = "projeto";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname,$usuario,$senha,$bancodedados);
if ($mysqli -> connect_errno){
    $mysqli =  "Falha ao conectar: (". $mysql->connect_errno.")". $mysql->connect_error;
}