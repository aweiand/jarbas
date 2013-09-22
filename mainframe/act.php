<?php

/**
 * Função genérica que instancia classes e chama seus métodos passando
 * por parâmetro (em formato objeto) o que vem na url. EX.:
 *      www.example.com/pg/classe/metodo/tabela.php?id=2&field=teste
 * $com = new classe();
 * echo $com->metodo($tabela, stdClass(objeto->id = 2 , objeto->field = teste)
 * 
 */
require_once "autoload.php";

$url = $_SERVER['REQUEST_URI'];
$url = substr($url, strpos($url, "/act/") + 5, strlen($url));
$url = explode("/", $url);

$param = substr($url[2], strpos($url[2], ".php?") + 5, strlen($url[2]));
parse_str($param, $param);
$param = json_decode(json_encode($param), FALSE);

$com = new $url[0]();
echo $com->$url[1](substr($url[2], 0, strpos($url[2], ".php")), $param);