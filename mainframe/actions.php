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
    $retorno = "../../" . $_SESSION['return'];
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
                exit();
            } break;

        case "upAnexo" : {
                require('plugins/jquery/jQuery-File-Upload/server/php/UploadHandler.php');
                $upload_handler = new UploadHandler(array("upload_dir" => "../assets/docs/anexos/", "upload_url" => "assets/docs/anexos/"));
                exit();
            } break;

        case "cancelainscricao" : {
                if (isset($_SESSION['usuid']) && $_GET['pessoa'] == $_SESSION['usuid']){
                    $admP = new admPessoas();

                    if ($admP->cancelaInscricaoPessoaEvento($_GET['pessoa'], $_GET['evento'])){
                        header("Location: $retorno?mens=OK");
                    } else {
                        header("Location: $retorno?err=Error");    
                    }
                }
            } break;

        case "deletaRegistro" : {
                if ($db->command("DELETE FROM {$_GET['table']} WHERE id = {$_GET['id']}")) {
                    header("Location: jarbas/$retorno?mens=OK");
                } else {
                    header("Location: jarbas/$retorno?err=error");
                }
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
                    exit();
                }
            } break;

        case "_InsUpdtEventos" : {
                if (isset($_POST['eventopai']) && $_POST['eventopai'] == 0) {
                    $_POST['eventopai'] = null;
                }
                if (isset($_POST['sala']) && $_POST['sala'] == 0) {
                    $_POST['sala'] = null;
                }
                if (isset($_POST['instituicao']) && $_POST['instituicao'] == 0) {
                    $_POST['instituicao'] = null;
                }

                if (isset($_POST['iniinscricao'])) {
                    $_POST['iniinscricao'] = $uti->formatDateTime($_POST['iniinscricao'], "americanoFull");
                }
                if (isset($_POST['iniinscricao'])) {
                    $_POST['fiminscricao'] = $uti->formatDateTime($_POST['fiminscricao'], "americanoFull");
                }
                if (isset($_POST['iniinscricao'])) {
                    $_POST['inievento'] = $uti->formatDateTime($_POST['inievento'], "americanoFull");
                }
                if (isset($_POST['iniinscricao'])) {
                    $_POST['fimevento'] = $uti->formatDateTime($_POST['fimevento'], "americanoFull");
                }

                if (isset($_FILES['logo']) && $_FILES['logo']['name'] != "") {
                    try {
                        $filename = uniqid($_FILES['logo']['name']) . $_FILES['logo']['name'];

                        if ($_FILES['logo']['error'] != 0) {
                            header("Location: $retorno?err=Houve_Erro_ao_enviar_a_imagem_o_processo_foi_interrompido_tente_novamente...");
                            exit();
                        } else if (!file_exists("../assets/data/") && !mkdir("../assets/data/", 0777, true)) {
                            header("Location: $retorno?err=Houve_Erro_com_as_permissoes_o_processo_foi_interrompido_tente_novamente...");
                            exit();
                        } else if (!move_uploaded_file($_FILES['logo']['tmp_name'], "../assets/data/" . $filename)) {
                            header("Location: $retorno?err=Houve_algum_problema_ao_salvar_a_imagem_o_processo_foi_interrompido_tente_novamente...");
                            exit();
                        }
                        $_POST['logo'] = $filename;
                    } catch (Exception $e) {
                        header("Location: $retorno?err=$e");
                        exit();
                    }
                }

                if ($db->query("SELECT 0 FROM eventos WHERE id = {$_POST["id"]}")->RecordCount() == 0) {
                    try {
                        $db->_insrt("eventos", $_POST);
                    } catch (exception $e) {
                        header("Location: $retorno?err=$e");
                        exit();
                    }
                } else {
                    try {
                        $db->_updt("eventos", $_POST, "id = {$_POST["id"]}");
                    } catch (exception $e) {
                        header("Location: $retorno?err=$e");
                        exit();
                    }
                }

                $atvds = $db->query("SELECT id FROM eventos WHERE eventopai = {$_POST["id"]}");
                while ($o = $atvds->FetchNextObject()) {
                    if (!$db->_updt("eventos", array("eventopai" => null), "id = $o->ID")) {
                        header("Location: $retorno?err=Desvinculando_atividades");
                        exit();
                    }
                }

                if (isset($_POST['atividadesdoevento']) && $_POST['atividadesdoevento'] != "") {
                    if (!$db->_updt("eventos", array("eventopai" => $_POST['id']), "id IN ({$_POST['atividadesdoevento']})")) {
                        header("Location: $retorno?err=Vinculando_atividades");
                        exit();
                    }
                }

                header("Location: $retorno?mens=OK");
                exit();
            } break;

        case "matriculaEvento" : {
                $pessoa = explode(",", $_POST['pessoas']);
                foreach ($pessoa as $p) {
                    try {
                        $db->_insrt("inscricoes", array("pessoa" => $p,
                            "evento" => $_POST['evento'],
                            "regra" => $_POST['regra']));
                    } catch (exception $e) {
                        echo "Ops, houve um erro.... $e";
                        exit();
                    }
                }

                echo "Oba!";
                exit();
            } break;

        case "desMatriculaEvento" : {
                try {
                    $db->command("DELETE FROM inscricoes WHERE pessoa
                                    IN ({$_POST['pessoas']}) AND evento = {$_POST['evento']}");
                } catch (exception $e) {
                    echo "Ops, houve um erro.... $e";
                    exit();
                }

                echo "Oba!";
                exit();
            } break;

        case "MarcaPresencaEvento" : {
                foreach ($_POST['pessoa'] as $id => $presenca) {
                    if ($db->query("SELECT id FROM presencas WHERE pessoa = $id AND evento = {$_POST['evento']}")->RecordCount() != 0) {
                        try {
                            $db->_updt("presencas", array(
                                "presente" => $presenca,
                                "userid" => $_SESSION['usuid']
                                    ), "pessoa = $id AND evento = {$_POST['evento']}");
                        } catch (exception $e) {
                            header("Location: $retorno?evento={$_POST['evento']}&err=$e");
                            exit();
                        }
                    } else {
                        try {
                            $db->_insrt("presencas", array(
                                "evento" => $_POST['evento'],
                                "pessoa" => $id,
                                "presente" => $presenca,
                                "userid" => $_SESSION['usuid']
                            ));
                        } catch (exception $e) {
                            header("Location: $retorno?evento={$_POST['evento']}&err=$e");
                            exit();
                        }
                    }
                }

                header("Location: $retorno?evento={$_POST['evento']}&mens=OK");
                exit();
            } break;
    }
}

header("Location: $retorno?mens=ops");
