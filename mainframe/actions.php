<?php

require_once "autoload.php";
@session_cache_expire(180); // 2 hours
@session_start();

/*
  echo "<pre>";
  print_r($_POST);
  exit();
 */

if (isset($_SESSION['return']))
    $retorno = "../" . $_SESSION['return'];
elseif (isset($_SERVER['HTTP_REFERER'])) {
    $retorno = explode("?", $_SERVER['HTTP_REFERER']);
    $retorno = $retorno[0];
} else {
    $retorno = $_SERVER['SERVER_NAME'];
}

//##################################
$db = new database();
$uti = new utils();
$com = new comuns();
//#################################

/**
 * Login na seção
 */
if (isset($_POST["username"]) && (isset($_POST['pass']))) {
    @session_cache_expire(180); // 2 hours
    @session_start();
    if (!$uti->badWords($_POST)) {
        return "Não Logado";
        exit();
    }

    $admpe = new admPessoas();
    $log = $admpe->_login($_POST['username'], $_POST['pass']);
    if (isset($log['usuid'])) {
        $_SESSION['usuid'] = $log['usuid'];
        $_SESSION['usu'] = $log['usu'];
        $_SESSION['email'] = $log['email'];
        $_SESSION['autenticado'] = true;

        if (!$_SESSION['autenticado']) {
            $com->_insActlog("_err-login", "login", "Erro de Login = " . $_POST['username']);
            header("Location: " . $CFG->affix . "index.php?action=erroLogin");
        } else {
            $com->_insActlog("_login", "login", "Login = " . $_POST['username']);
            header("Location: " . $CFG->affix . "home.php");
            exit();
        }
    } else {
        $com->_insActlog("_err-login", "login", "Erro de Login = " . $_POST['username']);
        session_destroy();
        header("Location: " . $CFG->affix . "index.php?action=erroLogin");
    }
}
/*
  echo "<pre>";
  print_r($_POST);
  exit();
 */
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        /**
         * LogOff na sessão
         */
        case "logoff" : {
                session_destroy();
                header("Location: ../index.php?action=logOff");
            } break;

        case "upAnexo" : {
                require('plugins/jquery/jQuery-File-Upload/server/php/UploadHandler.php');
                $upload_handler = new UploadHandler(array("upload_dir" => "../assets/docs/anexos/", "upload_url" => "assets/docs/anexos/"));
                exit();
            } break;
    }
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        /**
         *  @param String $_POST['table'] Tabela 
         *  @param Array $_POST['campo'] campo para seed
         *  @return Integer
         */
        case "seed" : {
                echo $db->seed($_POST['table'], $_POST['campo']);
            } break;

        /**
         * Função para inserir dados
         *  @param String $_POST['table'] Tabela
         *  @param String $_POST['field'] Campo da chave primária
         *  @param Array $_POST['data'] Dados
         *  @return Integer
         */
        case "_insrtData" : {
                $table = $_POST['table'];
                $field = $_POST['field'];
                parse_str($_POST['data'], $_POST);

                if (!isset($_POST['data']['id'])) {
                    $id = $db->seed("$table", $field);
                } else
                    $id = $_POST['data']['id'];

                $_POST['id'] = $id;
                if ($db->_insrt("$table", $_POST))
                    echo $id;
                else
                    echo '-1';
            } break;

        /**
         * Função para inserir coisas e retornar
         */
        case "_insrtDataReturn" : {
                if ($db->_insrt($_POST['table'], $_POST))
                    header("Location: $retorno?mens=OK");
                else
                    header("Location: $retorno?err=Error");
            } break;

        /**
         * Função para atualizar dados
         *  @param String $_POST['table'] Tabela
         *  @param String $_POST['field'] Campo da chave primária
         *  @param Integer $_POST['id'] ID da chave primária
         *  @param Array $_POST['data'] Dados
         *  @return Boolean
         */
        case "_updtData" : {
                $table = $_POST['table'];
                $field = $_POST['field'];
                $id = $_POST['id'];

                parse_str($_POST['data'], $_POST);

                if ($db->_updt("$table", $_POST, "$field = $id"))
                    echo true;
                else
                    echo false;
            } break;

        /**
         * Função para deletar dados
         *  @param String $_POST['table'] Tabela
         *  @param String $_POST['field'] Campo da chave primária
         *  @param Integer $_POST['id'] ID da chave primária
         *  @return Boolean
         */
        case "_delData" : {
                $table = $_POST['table'];
                $field = $_POST['field'];
                $id = $_POST['id'];

                if ($db->command("DELETE FROM $table WHERE $field = $id"))
                    echo true;
                else
                    echo false;
            } break;

        /**
         * Função para atualizar dados
         *  @param String $_POST['table'] Tabela
         *  @param String $_POST['field'] Campo da chave primária
         *  @param Integer $_POST['id'] ID da chave primária
         *  @param Array $_POST['data'] Dados
         *  @return Boolean
         */
        case "_InsUpdt" : {
                $table = $_POST['table'];
                $field = $_POST['field'];
                $id = $_POST[$field];

                if ($db->query("SELECT 0 FROM $table WHERE $field = $id")->RecordCount() == 0) {
                    if (isset($_POST[$field]) && $_POST[$field] == "-1")
                        unset($_POST[$field]);
                    try {
                        $db->_insrt($table, $_POST);
                    } catch (exception $e) {
                        header("Location: $retorno?err=$e");
                    }
                } else {
                    try {
                        $db->_updt($table, $_POST, "$field = $id");
                    } catch (exception $e) {
                        header("Location: $retorno?err=$e");
                    }

                    header("Location: $retorno?mens=OK");
                }
            } break;
    }
}



