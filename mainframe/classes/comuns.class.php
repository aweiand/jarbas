<?php

/**
 * Esta Classe prove métodos úteis para utilização Geral de construção de campos e forms
 *  
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @version 0.1
 * @access public
 * @name comuns
 * @category field constructors
 * @package comuns
 */
class comuns extends admComuns {

    /**
     * Retorna um formulário para inserção, com valores padrão
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return String
     */
    function setTipos($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsTableId("tipos", $param->id)->FetchObject();
            $btn = "Alterar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId("tipos");
            $rs = parent::getRsTableId("tipos", $param->id)->FetchObject();
            $btn = "Cadastrar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                                        <div class='fullCenter'>
                                                <fieldset>
                                                        <legend>Inserindo Dados</legend>
                                                        $mens
                                                        <div class='leftFloat'>                                                        
                                                                <label for='nome'>Nome</label>
                                                                <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                                                $id
                                                                <input type='hidden' name='table' id='table' value='tipos' />        
                                                                <input type='hidden' name='action' value='_insUpdt' />
                                                                <br />
                                                                <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                                        </div>
                                                        
                                                </fieldset>
                                                <br />
                                                <div class='fullCenter'>
                                                        <button class='btn btn-warning'>$btn</button>
                                                </div>
                                        </div>
                                </form>";
        return $str;
    }

    /**
     * Retorna uma lista com valores padrão e botões de ateração
     * edição e deleção
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return string
     */
    function getTipos($table, $param) {
        GLOBAL $CFG;
        @session_start();
        $_SESSION['return'] = "pg/comuns/getTipos/tipos.php";

        $str = $this->setTipos($table, $param);
        $rs = parent::getRsTableId("tipos");

        if (isset($param->err))
            $mens = $this->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $this->trataMens($param->mens);
        else
            $mens = "";

        $str.= "<div class='fullCenter' style='margin-top: 5px; margin-bottom: 5px;'>
                                        $mens
                                        <button class='btn btn-primary' onclick='$(\"#frm-Insert-Simple\").animate({ height: \"toggle\", opacity: \"toggle\" }, \"slow\"); $(this).remove(); return false;'>Inserir</button>
                             </div>
                             <fieldset>
                                <legend>Lista de Tipos Cadastradas</legend>
                                <table class='fullCenter table table-hover'  id='lst-field-full' cellpadding='10' cellspacing='10'>
                                        <thead>
                                                <tr>
                                                        <th>
                                                                #
                                                        </th>
                                                        <th>
                                                                Nome
                                                        </th>
                                                        <th>
                                                                &nbsp;
                                                        </th>
                                                </tr>
                                        </thead>
                                        <tbody>";

        while ($o = $rs->FetchNextObject()) {
            $str.="<tr>
                                        <td>
                                                $o->ID
                                        </td>
                                        <td>
                                                $o->NOME
                                        </td>
                                        <td>
                                                <a class='btn' href='$CFG->www/pg/comuns/setTipos/tipos.php?id=$o->ID' title='Editar este Tipo'>
                                                        <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn' href='#' onclick=\"if (confirm('Você tem certeza?')) return true; return false;\" title='Deletar a Pessoa'>
                                                        <i class='icon-remove'></i>
                                                </a>
                                        </td>
                                </tr>";
        }

        $str.= "        </tbody>
                                </table>
                        </fieldset>
                        
                        <script>
                                $(function(){
                                        tblShort('lst-field-full');
                                })
                        </script>";
        return $str;
    }

    /**
     * Retorna um formulário para inserção, com valores padrão
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return String
     */
    function setSalas($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsTableId("salas", $param->id)->FetchObject();
            $btn = "Alterar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId("salas");
            $rs = parent::getRsTableId("salas", $param->id)->FetchObject();
            $btn = "Cadastrar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                                        <div class='fullCenter'>
                                                <fieldset>
                                                        <legend>Inserindo Dados</legend>
                                                        $mens
                                                        <div class='leftFloat'>                                                        
                                                                <label for='nome'>Nome</label>
                                                                <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                                                $id
                                                                <input type='hidden' name='table' id='table' value='salas' />        
                                                                <input type='hidden' name='action' value='_insUpdt' />
                                                                <br />
                                                                <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                                        </div>
                                                        
                                                </fieldset>
                                                <br />
                                                <div class='fullCenter'>
                                                        <button class='btn btn-warning'>$btn</button>
                                                </div>
                                        </div>
                                </form>";
        return $str;
    }

    /**
     * Retorna uma lista com valores padrão e botões de ateração
     * edição e deleção
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return string
     */
    function getSalas($table, $param) {
        GLOBAL $CFG;
        @session_start();
        $_SESSION['return'] = "pg/comuns/getSalas/tipos.php";

        $str = $this->setSalas($table, $param);
        $rs = parent::getRsTableId("salas");

        if (isset($param->err))
            $mens = $this->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $this->trataMens($param->mens);
        else
            $mens = "";

        $str.= "<div class='fullCenter' style='margin-top: 5px; margin-bottom: 5px;'>
                                        $mens
                                        <button class='btn btn-primary' onclick='$(\"#frm-Insert-Simple\").animate({ height: \"toggle\", opacity: \"toggle\" }, \"slow\"); $(this).remove(); return false;'>Inserir</button>
                             </div>
                             <fieldset>
                                <legend>Lista de Tipos Cadastradas</legend>
                                <table class='fullCenter table table-hover'  id='lst-field-full' cellpadding='10' cellspacing='10'>
                                        <thead>
                                                <tr>
                                                        <th>
                                                                #
                                                        </th>
                                                        <th>
                                                                Nome
                                                        </th>
                                                        <th>
                                                                &nbsp;
                                                        </th>
                                                </tr>
                                        </thead>
                                        <tbody>";

        while ($o = $rs->FetchNextObject()) {
            $str.="<tr>
                                        <td>
                                                $o->ID
                                        </td>
                                        <td>
                                                $o->NOME
                                        </td>
                                        <td>
                                                <a class='btn' href='$CFG->www/pg/comuns/setSalas/salas.php?id=$o->ID' title='Editar esta Sala'>
                                                        <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn' href='#' onclick=\"if (confirm('Você tem certeza?')) return true; return false;\" title='Deletar a Pessoa'>
                                                        <i class='icon-remove'></i>
                                                </a>
                                        </td>
                                </tr>";
        }

        $str.= "        </tbody>
                                </table>
                        </fieldset>
                        
                        <script>
                                $(function(){
                                        tblShort('lst-field-full');
                                })
                        </script>";
        return $str;
    }

    /**
     * Retorna um formulário para inserção, com valores padrão
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return String
     */
    function setRegras($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsTableId("regras", $param->id)->FetchObject();
            $btn = "Alterar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId("regras");
            $rs = parent::getRsTableId("regras", $param->id)->FetchObject();
            $btn = "Cadastrar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                                        <div class='fullCenter'>
                                                <fieldset>
                                                        <legend>Inserindo Dados</legend>
                                                        $mens
                                                        <div class='leftFloat'>                                                        
                                                                <label for='nome'>Nome</label>
                                                                <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                                                $id
                                                                <input type='hidden' name='table' id='table' value='regras' />        
                                                                <input type='hidden' name='action' value='_insUpdt' />
                                                                <br />
                                                                <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                                        </div>
                                                        
                                                        <div class='rightFloat'>
                                                                <label>Descrição</label>
                                                                <textarea name='descricao' id='descricao'>$rs->DESCRICAO</textarea>
                                                        </div>
                                                
                                                </fieldset>
                                                <br />
                                                <div class='fullCenter'>
                                                        <button class='btn btn-warning'>$btn</button>
                                                </div>
                                        </div>
                                </form>";
        return $str;
    }

    /**
     * Retorna uma lista com valores padrão e botões de ateração
     * edição e deleção
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return string
     */
    function getRegras($table, $param) {
        GLOBAL $CFG;
        @session_start();
        $_SESSION['return'] = "pg/comuns/getRegras/regras.php";

        $str = $this->setRegras($table, $param);
        $rs = parent::getRsTableId("regras");

        if (isset($param->err))
            $mens = $this->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $this->trataMens($param->mens);
        else
            $mens = "";

        $str.= "<div class='fullCenter' style='margin-top: 5px; margin-bottom: 5px;'>
                                        $mens
                                        <button class='btn btn-primary' onclick='$(\"#frm-Insert-Simple\").animate({ height: \"toggle\", opacity: \"toggle\" }, \"slow\"); $(this).remove(); return false;'>Inserir</button>
                             </div>
                             <fieldset>
                                <legend>Lista de Tipos Cadastradas</legend>
                                <table class='fullCenter table table-hover'  id='lst-field-full' cellpadding='10' cellspacing='10'>
                                        <thead>
                                                <tr>
                                                        <th>
                                                                #
                                                        </th>
                                                        <th>
                                                                Nome
                                                        </th>
                                                        <th>
                                                                Descrição
                                                        </th>
                                                        <th>
                                                                &nbsp;
                                                        </th>
                                                </tr>
                                        </thead>
                                        <tbody>";

        while ($o = $rs->FetchNextObject()) {
            $str.="<tr>
                                        <td>
                                                $o->ID
                                        </td>
                                        <td>
                                                $o->NOME
                                        </td>
                                        <td>
                                                $o->DESCRICAO
                                        </td>
                                        <td>
                                                <a class='btn' href='$CFG->www/pg/comuns/getRegras/regras.php?id=$o->ID' title='Editar esta Regra'>
                                                        <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn' href='#' onclick=\"if (confirm('Você tem certeza?')) return true; return false;\" title='Deletar a Pessoa'>
                                                        <i class='icon-remove'></i>
                                                </a>
                                        </td>
                                </tr>";
        }

        $str.= "        </tbody>
                                </table>
                        </fieldset>
                        
                        <script>
                                $(function(){
                                        tblShort('lst-field-full');
                                })
                        </script>";
        return $str;
    }

    /**
     * Retorna a mensagem de aviso/alerta formatada
     * @param String $mens
     * @return string
     */
    function trataMens($mens) {
        $str = "<div class='error alert alert-success'>";

        switch ($mens) {
            case "insOk" : {
                    $str.= "Envio realizado com sucesso!";
                } break;

            case "uptOk" : {
                    $str.= "Atualização realizada com sucesso!";
                } break;

            default : {
                    $str.= "OBA!! Algo de bom ocoreu :)";
                } break;
        };

        $str.= "</div>
                                <script>
                                        $(function(){
                                                $('.alert-success').delay(2000).fadeOut();
                                        });
                                </script>";
        return $str;
    }

    /**
     * Retorna a mensagem de erro formatada
     * @param String $errMens
     * @return string
     */
    function trataError($errMens) {
        $str = "<div class='error alert alert-error'>";

        switch ($errMens) {
            case "envImg" : {
                    $str.= "Erro com a Imagem";
                } break;

            case "directory" : {
                    $str.= "Erro de diretórios";
                } break;

            case "upImg" : {
                    $str.= "Erro ao enviar a Imagem";
                } break;

            case "insrt" : {
                    $str.= "Erro ao inserir o(s) dado(s)";
                } break;

            case "updt" : {
                    $str.= "Erro ao atualizar o(s) dado(s)";
                } break;

            default : {
                    $str.= "Algum erro ocoreu...
                            <br />
                            $errMens";
                } break;
        };

        $str.= "</div>";
        return $str;
    }

    /**
     * Função para inserir logs de ação na tabela actlogs
     * @param type $action
     * @param type $modulo
     * @param type $text
     * @param type $codusuario
     * @return boolean
     */
    function _insActlog($action = "_login", $modulo = "site", $text = "", $codusuario = false) {
        if ((!$codusuario) && isset($_SESSION['usuid'])) {
            $arr['pessoa'] = $_SESSION['usuid'];
        } else {
            $arr['pessoa'] = $codusuario;
        }

        $arr['action'] = $action;
        $arr['modulo'] = $modulo;
        $arr['text'] = $text;

        if (parent::_insrt("public.actlogs", $arr)) {
            return true;
        } else {
            return false;
        }
    }

    function cadastroalteracao($table, $param) {
        GLOBAL $CFG;
        $str = "<fieldset>
                    <legend>Cadastros / Alterações</legend>
                    <div id='tabs'>
                      <ul>
                        <li>
                            <a href='#tabs-1'>Início</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/pessoas/getPessoas/pessoas.php'>Dados do Usuário</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getPapeis/papeis.php'>Papéis</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/eventos/getEventos/eventos.php'>Eventos</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getTipos/tipos.php'>Tipos</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getSalas/salas.php'>Salas</a>
                        </li>
                      </ul>
                      <div id='tabs-1'>
                        <p>Olá, selecione algum item.</p>
                      </div>
                    </div>
                          
                </fieldset>";

        $str.= "<script>
                    $(function() {
                        $( '#tabs' ).tabs({
                            beforeLoad: function( event, ui ) {
                                ui.jqXHR.error(function() {
                                    ui.panel.html('Desculpe, não consegui carregar este conteúdo... :(');
                                });
                            }
                        });
                    });
                </script>";

        return $str;
    }

    function vinculopapeiseventos($table, $param) {
        GLOBAL $CFG;
        $pes = new admPessoas();
        $evnt = new admEventos();

        $str = "<fieldset>
                    <legend>Vínculo de Papéis e Eventos</legend>
                          
                    <div class='fullCenter'>
                    
                        <div class='span12' style='text-align: right;'>
                            <label>Evento</label>
                            " . $evnt->getSelectEvento() . "
                        </div>
                    
                        <div class='span4'>
                            <label>Papéis</label>
                            <select name='papel' id='papel' multiple>";

        $rs = parent::getRsTableId("regras");
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                        <div class='span4' style='width: 29%;'>
                            <button class='btn btn-primary'>Vincular >></button>
                            <br />
                            <br />
                            <button class='btn btn-warning'><< Desvincular</button>
                        </div>
                        
                        <div class='span4'>
                            <label>Pessoas</label>
                            <select name='pessoa' id='pessoa' multiple>";

        $rs = $pes->getRsPessoasId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                    </div>
                    
                </fieldset>";

        return $str;
    }

    function vinculopessoaseventos($table, $param) {
        GLOBAL $CFG;
        $pes = new admPessoas();
        $evnt = new admEventos();

        $str = "<fieldset>
                    <legend>Matrícula de Pessoas em Eventos</legend>
                          
                    <div class='fullCenter'>
                    
                        <div class='span12' style='text-align: right;'>
                            <label>Evento</label>
                            " . $evnt->getSelectEvento() . "
                        </div>
                    
                        <div class='span4'>
                            <label>Pessoas</label>
                            <select name='papel' id='papel' multiple>";

        $rs = $pes->getRsPessoasId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                        <div class='span4' style='width: 29%;'>
                            <button class='btn btn-primary'>Vincular >></button>
                            <br />
                            <br />
                            <button class='btn btn-warning'><< Desvincular</button>
                        </div>
                        
                        <div class='span4'>
                            <label>Pessoas no Evento</label>
                            <select name='pessoa' id='pessoa' multiple>";

        $rs = $evnt->getRsPessoasEvento(0);
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                    </div>
                    
                </fieldset>";

        return $str;
    }
    
    function lancapresencas($table, $param) {
        GLOBAL $CFG;
        $pes = new admPessoas();
        $evnt = new admEventos();

        $str = "<fieldset>
                    <legend>Matrícula de Pessoas em Eventos</legend>
                          
                    <div class='fullCenter'>
                    
                        <div class='span12' style='text-align: right;'>
                            <label>Evento</label>
                            " . $evnt->getSelectEvento() . "
                        </div>
                    
                        <div class='span4'>
                            <label>Pessoas</label>
                            <select name='papel' id='papel' multiple>";

        $rs = $pes->getRsPessoasId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                        <div class='span4' style='width: 29%;'>
                            <button class='btn btn-primary'>Vincular >></button>
                            <br />
                            <br />
                            <button class='btn btn-warning'><< Desvincular</button>
                        </div>
                        
                        <div class='span4'>
                            <label>Pessoas Presentes no Evento</label>
                            <select name='pessoa' id='pessoa' multiple>";

        $rs = $evnt->getRsPessoasEvento(0);
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                    </div>
                    
                </fieldset>";

        return $str;
    }

}
