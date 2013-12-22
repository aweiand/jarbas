<?php
/**
 * Função para autocarregar as classes conforme a necessidade de uso
 *
 *  Uso:
 *  - Deve-se somente declarar a classe que a função a executada
 *    automaticamente pelo sistema, porém deve-se seguir a seguinte
 *    nomenclatura:
 *      - Nome da classe deve ter o mesmo nome do arquivo e do construtor
 *  @param String $classe -> caminho para o diretório principal
 *  @access public
 *  @author Augusto Weiand <guto.weiand@gmail.com>
 *  @version 1.5
 *  @package autoload
 *  @category autoload
 *  @copyright Augusto Weiand <guto.weiand@gmail.com>
 *
 */
unset($CFG);
GLOBAL $CFG;
$CFG = new stdClass();

$CFG->affix = "/jarbas/";
$CFG->data = $_SERVER['DOCUMENT_ROOT'] . $CFG->affix . "/assets/";
$CFG->www = "http://" . $_SERVER['SERVER_NAME'] . $CFG->affix;
$CFG->lib = "mainframe/";

require_once $_SERVER['DOCUMENT_ROOT'] . $CFG->affix . $CFG->lib . "plugins/adodb/adodb.inc.php";

function __autoload($classe) {
    $path = ($_SERVER['DOCUMENT_ROOT'] . "/jarbas/mainframe/classes/");

    if (file_exists($path . $classe . '.class.php')) {
        require_once $path . $classe . '.class.php';
    } else
    if (file_exists($path . $classe . '.php')) {
        require_once $path . $classe . '.php';
    }
}

function permite($regra){
	$db = new database();

	if (!isset($_SESSION['usuid'])){
		return false;
	} else {
		$rs = $db->query("SELECT regrageral FROM pessoas WHERE id = {$_SESSION['usuid']}")->Fields(0);
		if ($regra == "Gerente" && $rs == 1){
			return true;
		} elseif ($regra == "Gerente" && $rs == 0){
			return false;
		} elseif ($regra == "Usuário" && $rs == 0){
			return true;
		} elseif ($regra == "Usuário" && $rs == 1){
			return false;
		}
	}
}