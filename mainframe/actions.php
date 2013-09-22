<?php

require_once "autoload.php";
@session_cache_expire(180); // 2 hours
@session_start();

/*
  echo "<pre>";
  print_r($post);
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
$db = new data();
$uti = new Utils();
//#################################

/**
 * Login na seção
 */
if (isset($post["username"]) && (isset($post['pass']))) {
        @session_cache_expire(180); // 2 hours
        @session_start();
        if (!$uti->badWords($post)) {
                return "Não Logado";
                exit;
        }

        $log = $db->_login($post['username'], $post['pass']);
        if (isset($log['usuid'])) {
                $_SESSION['usuid'] = $log['usuid'];
                $_SESSION['usu'] = $log['usu'];
                $_SESSION['email'] = $log['email'];
                $_SESSION['autenticado'] = true;

                if (!$_SESSION['autenticado']) {
                        header("Location: ../index.php?action=erroLogin");
                } else {
                        header("Location: ../home.php");
                        exit();
                }
        } else {
                $uti->_insActlog("_err-login", "login", "Erro de Login = " . $post['username']);
                session_destroy();
                header("Location: ../index.php?action=erroLogin");
        }
}
/*
  echo "<pre>";
  print_r($post);
  exit();
 */
if (isset($get['action'])) {
        switch ($get['action']) {
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

if (isset($post['action'])) {
        switch ($post['action']) {
                /**
                 *  @param String $post['table'] Tabela 
                 *  @param Array $post['campo'] campo para seed
                 *  @return Integer
                 */
                case "seed" : {
                                echo $db->seed($post['table'], $post['campo']);
                        } break;

                /**
                 * Função para inserir dados
                 *  @param String $post['table'] Tabela
                 *  @param String $post['field'] Campo da chave primária
                 *  @param Array $post['data'] Dados
                 *  @return Integer
                 */
                case "_insrtData" : {
                                $table = $post['table'];
                                $field = $post['field'];
                                parse_str($post['data'], $post);

                                if (!isset($post['data']['id'])) {
                                        $id = $db->seed("$table", $field);
                                } else
                                        $id = $post['data']['id'];

                                $post['id'] = $id;
                                if ($db->_insrt("$table", $post))
                                        echo $id;
                                else
                                        echo '-1';
                        } break;

                /**
                 * Função para inserir coisas e retornar
                 */
                case "_insrtDataReturn" : {
                                if ($db->_insrt($post['table'], $post))
                                        header("Location: $retorno?mens=OK");
                                else
                                        header("Location: $retorno?err=Error");
                        } break;

                /**
                 * Função para atualizar dados
                 *  @param String $post['table'] Tabela
                 *  @param String $post['field'] Campo da chave primária
                 *  @param Integer $post['id'] ID da chave primária
                 *  @param Array $post['data'] Dados
                 *  @return Boolean
                 */
                case "_updtData" : {
                                $table = $post['table'];
                                $field = $post['field'];
                                $id = $post['id'];

                                parse_str($post['data'], $post);

                                if ($db->_updt("$table", $post, "$field = $id"))
                                        echo true;
                                else
                                        echo false;
                        } break;

                /**
                 * Função para deletar dados
                 *  @param String $post['table'] Tabela
                 *  @param String $post['field'] Campo da chave primária
                 *  @param Integer $post['id'] ID da chave primária
                 *  @return Boolean
                 */
                case "_delData" : {
                                $table = $post['table'];
                                $field = $post['field'];
                                $id = $post['id'];

                                if ($db->command("DELETE FROM $table WHERE $field = $id"))
                                        echo true;
                                else
                                        echo false;
                        } break;

                /**
                 * Função para atualizar dados
                 *  @param String $post['table'] Tabela
                 *  @param String $post['field'] Campo da chave primária
                 *  @param Integer $post['id'] ID da chave primária
                 *  @param Array $post['data'] Dados
                 *  @return Boolean
                 */
                case "_InsUpdt" : {
                                $table = $post['table'];
                                $field = $post['field'];
                                $id = $post[$field];

                                if ($db->query("SELECT 0 FROM $table WHERE $field = $id")->RecordCount() == 0) {
                                        if (isset($post[$field]) && $post[$field] == "-1")
                                                unset($post[$field]);
                                        try {
                                                $db->_insrt($table, $post);
                                        } catch (exception $e) {
                                                header("Location: $retorno?err=$e");
                                        }
                                } else {
                                        try {
                                                $db->_updt($table, $post, "$field = $id");
                                        } catch (exception $e) {
                                                header("Location: $retorno?err=$e");
                                        }

                                        header("Location: $retorno?mens=OK");
                                }
                        } break;
        }
}



