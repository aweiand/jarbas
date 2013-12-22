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

        if (isset($param->id)) {
            $rs = parent::getRsTableId("tipos", $param->id)->FetchObject();
            $btn = "Alterar";
        } else {
            $param->id = parent::getNextId("tipos");
            $rs = parent::getRsTableId("tipos", $param->id)->FetchObject();
            $btn = "Cadastrar";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <fieldset>
                        <legend>Cadastro / Alteração</legend>
                        $mens
                        <div class='fullCenter'>
                            <div class='leftFloat'>
                                <label>Pesquisar</label>
                                " . parent::getAutoCompleteTipos(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaTipo()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='id' id='id' value='$param->id'/>
                                    <input type='hidden' name='field' id='field' value='id'/>
                                    <input type='hidden' name='table' id='table' value='tipos'/>
                                    <input type='hidden' name='action' id='action' value='_InsUpdt'/>
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='text-align: left;'>
                                    <label for='status'>Status</label>
                                    <select name='status' id='status'>";

        switch ($rs->STATUS) {
            case 1 :
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
            case -1 :
                $str.="<option value='1'>Ativa</option>
                       <option value='0' selected='selected'>Deletada</option >";
                break;
            default:
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
        }

        $str.="            </select>
                                </div>

                                <br />
                                <div class='fullCenter'>
                                    <button class='btn btn-primary'>$btn</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
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

        if (isset($param->id)) {
            $rs = parent::getRsTableId("salas", $param->id)->FetchObject();
            $btn = "Alterar";
        } else {
            $param->id = parent::getNextId("salas");
            $rs = parent::getRsTableId("salas", $param->id)->FetchObject();
            $btn = "Cadastrar";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <fieldset>
                        <legend>Cadastro / Alteração</legend>
                        $mens
                        <div class='fullCenter'>
                            <div class='leftFloat'>
                                <label>Pesquisar</label>
                                " . parent::getAutoCompleteSalas(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaSala()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='id' id='id' value='$param->id'/>
                                    <input type='hidden' name='field' id='field' value='id'/>
                                    <input type='hidden' name='table' id='table' value='salas'/>
                                    <input type='hidden' name='action' id='action' value='_InsUpdt'/>
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='capacidade'>Capacidade</label>
                                    <input type='number' name='capacidade' class='span2' id='capacidade' value='$rs->CAPACIDADE' placeholder='digite um valor...' />
                                </div>
                                
                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='status'>Status</label>
                                    <select name='status' id='status' class='span2'>";

        switch ($rs->STATUS) {
            case 1 :
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
            case -1 :
                $str.="<option value='1'>Ativa</option>
                       <option value='0' selected='selected'>Deletada</option >";
                break;
            default:
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
        }

        $str.="            </select>
                                </div>

                                <br />
                                <div class='fullCenter'>
                                    <button class='btn btn-primary'>$btn</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Excluir</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
        return $str;
    }

    function getInstituicoes($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsTableId("instituicoes", $param->id)->FetchObject();
            $btn = "Alterar";
        } else {
            $param->id = parent::getNextId("instituicoes");
            $rs = parent::getRsTableId("instituicoes", $param->id)->FetchObject();
            $btn = "Cadastrar";
        }

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "   <fieldset>
                        <legend>Cadastro / Alteração</legend>
                        $mens
                        <div class='fullCenter'>
                            <div class='leftFloat'>
                                <label>Pesquisar</label>
                                " . parent::getAutoCompleteInstituicoes(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaInstituicao()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='id' id='id' value='$param->id'/>
                                    <input type='hidden' name='field' id='field' value='id'/>
                                    <input type='hidden' name='table' id='table' value='instituicoes'/>
                                    <input type='hidden' name='action' id='action' value='_InsUpdt'/>
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='sigla'>Sigla</label>
                                    <input type='text' name='sigla' id='sigla' value='$rs->SIGLA' placeholder='digite um valor...' />
                                </div>
                                
                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='email'>E-mail</label>
                                    <input type='email' name='email' id='email' value='$rs->EMAIL' placeholder='digite um valor...' />
                                </div>
                                
                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='capacidade'>Telefone</label>
                                    <input type='text' name='telefone' id='telefone' value='$rs->TELEFONE' placeholder='digite um valor...' />
                                </div>
                                
                                <div class='leftFloat' style='width:100%; text-align: left;'>
                                    <label for='status'>Status</label>
                                    <select name='status' id='status' class='span2'>";

        switch ($rs->STATUS) {
            case 1 :
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
            case -1 :
                $str.="<option value='1'>Ativa</option>
                       <option value='0' selected='selected'>Deletada</option >";
                break;
            default:
                $str.="<option value='1' selected='selected'>Ativa</option>
                       <option value='0'>Deletada</option >";
                break;
        }

        $str.="            </select>
                                </div>

                                <br />
                                <div class='fullCenter'>
                                    <button class='btn btn-primary'>$btn</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Excluir</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
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
                        $('.alert-success').delay(4000).fadeOut(function (){ this.remove() });
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
        $_SESSION['return'] = "pg/comuns/cadastroalteracao/cadastros.php";

        if (isset($param->err))
            $mens = $this->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $this->trataMens($param->mens);
        else
            $mens = "";

        $str = "<fieldset>
                    <legend>Cadastros / Alterações</legend>
                    $mens
                    <div id='tabs'>
                      <ul>
                        <li>
                            <a href='#tabs-1'>Início</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/pessoas/getPessoas/Cadastro_e_Alteracao_de_Usuarios.php'>Dados do Usuário</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/pessoas/getPapeis/Cadastro_e_Alteracao_de_Papeis.php'>Papéis</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/eventos/getEventos/Cadastro_e_Alteracao_de_Eventos.php'>Eventos</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getTipos/Cadastro_e_Alteracao_de_Tipos.php'>Tipos</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getSalas/Cadastro_e_Alteracao_de_Salas.php'>Salas</a>
                        </li>
                        <li>
                            <a href='$CFG->www/act/comuns/getInstituicoes/Cadastro_e_Alteracao_de_Insituicoes.php'>Instituições</a>
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

    /**
     * 
     * @global GLOBAL $CFG
     * @param type $table
     * @param type $param
     * @return string
     * @deprecated since version 0.1 - Esta função não será necessária
     */
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

        if (!isset($param->evento)) {
            $param->evento = 0;
        }

        $str = "<fieldset>
                    <legend>Matrícula de Pessoas em Eventos</legend>
                          
                    <div class='fullCenter'>
                    
                        <div class='span12' style='text-align: right; margin-bottom: 40px'>
                            <label>Evento</label>
                            " . $evnt->getSelectAtividades($param->evento, "class='span8' onchange='recarregaPaginaEvnt()'") . "
                        </div>
                    
                        <div class='span4'>
                            <label>Pessoas</label>
                            <select name='pessoas' id='pessoas' multiple>";

        $rs = $pes->getRsPessoasId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="             </select>
                        </div>
                        
                        <div class='span4' style='width: 29%;'>
                            <button class='btn btn-primary' onclick='vinculaPessoaEvento()'>Vincular >></button>
                            <br />
                            <br />
                            <label>Papel</label>
                            " . parent::getSelectPapel(8) . "
                            <br />
                            <br />
                            <button class='btn btn-warning' onclick='desvinculaPessoaEvento()'><< Desvincular</button>
                        </div>
                        
                        <div class='span4'>
                            <label>Pessoas no Evento</label>
                            <select name='pessoaEvento' id='pessoaEvento' multiple>";

        $rs = $evnt->getRsPessoasEvento($param->evento);
        while ($o = $rs->FetchNextObject()) {
            $str.= "            <option value='$o->ID'>$o->NOME ($o->NOMER)</option >";
        }

        $str.="             </select>
                        </div>
                        
                    </div>
                    
                </fieldset>";

        return $str;
    }

    function lancapresencas($table, $param) {
        GLOBAL $CFG;
        $_SESSION['return'] = "pg/comuns/lancapresencas/Digitando_Presencas.php";
        $pes = new admPessoas();
        $evnt = new admEventos();

        if (!isset($param->evento)) {
            $param->evento = 0;
        }

        if (isset($param->err))
            $mens = $this->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $this->trataMens($param->mens);
        else
            $mens = "";

        $str = "<fieldset>
                    <legend>Marcação de Presenças</legend>
                    $mens
                    <div class='fullCenter'>
                    
                        <form action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <input type='hidden' name='action' value='MarcaPresencaEvento' />

                            <div class='span11' style='text-align: right;'>
                                <label>Evento</label>
                                " . $evnt->getSelectAtividades($param->evento, "class='span8' onchange='recarregaPaginaEvnt()'") . "
                            </div>

                            <div class='span11'>
                                <label>Pessoas Presentes no Evento</label>
                                <ul style='list-style-type: none;'>";

        $rs = $evnt->getRsPessoasEvento($param->evento);
        while ($o = $rs->FetchNextObject()) {
            $str.= "                <li style='float: left; width: 40%; padding: 5px; text-align: left; background-color: #F5F5F5; margin: 5px;'>
                                        <b>$o->NOME</b> ($o->NOMER)
                                        <br />
                                        " . $evnt->getRadioPresenteEvento($param->evento, $o->ID) . "
                                    </li>";
        }

        $str.="                 </ul>
                            </div>
                        
                            <div class='span11' style='text-align: center;'>
                                <button class='btn btn-mini btn-info' onclick=\"$('input[type=radio][value=1]', 'form').each(function(){ $(this).attr('checked', true) }); return false;\"><i class='icon icon-plus'></i> Todos</button>
                                <button class='btn btn-primary'>Marcar Presencas</button>
                            </div>
                        </form>
                    </div>
                    
                </fieldset>";

        return $str;
    }

    function impressaodemateriais($table, $param) {
        GLOBAL $CFG;
        $pes = new admPessoas();
        $evnt = new admEventos();

        if (!isset($param->evento)) {
            $param->evento = "";
        }

        $str = "<fieldset>
                    <legend>Impressão de Materiais para o Evento</legend>
                          
                    <div class='fullCenter'>
                    
                        <div class='span12' style='text-align: right;'>
                            <label>Evento</label>
                            " . $evnt->getSelectEvento($param->evento, "onchange='recarregaPaginaEvnt()'") . "
                        </div>";

        if ($param->evento != "") {
            $str.= "    <div class='fullCenter'>
                            <div class='span4' style='margin: 20px 0 20px 0;'>
                                <a class='btn btn-primary' target='_new' href='$CFG->www/act/impressoes/imprimirListasDePresenca/presenca.php?evento=$param->evento'>
                                    <i class='icon-list'></i>
                                    Listas de Presença
                                </a>
                            </div>

                            <div class='span4' style='margin: 20px 0 20px 0;'>
                                <a class='btn btn-info' target='_new' href='$CFG->www/act/impressoes/imprimirCrachas/cracha.php?evento=$param->evento'>
                                    <i class='icon-bookmark'></i>
                                    Crachás
                                </a>
                            </div>

                            <div class='span4' style='margin: 20px 0 20px 0;'>
                                <a class='btn' target='_new' href='$CFG->www/act/impressoes/imprimirIdentificacaoDaSala/sala.php?evento=$param->evento'>
                                    <i class='icon-th-list'></i>
                                    Identificação de Sala
                                </a>
                            </div>

                            <div class='span4' style='margin: 20px 0 20px 0;'>
                                <a class='btn btn-warning' target='_new' href='$CFG->www/act/impressoes/imprimirCertificado/certificado.php?evento=$param->evento'>
                                    <i class='icon-th'></i>
                                    Certificados em Massa
                                </a>
                            </div>
                        </div>";
        }

        $str.="     </div>
                    
                </fieldset>";

        return $str;
    }

}
