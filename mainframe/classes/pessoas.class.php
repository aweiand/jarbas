<?php

class pessoas extends admPessoas {

    /**
     * Retorna um formulário para inserção, com valores padrão
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return String
     */
    function getPessoas($table, $param) {
        GLOBAL $CFG;
        $com = new comuns();

        if (isset($param->id)) {
            $rs = parent::getRsPessoasId($param->id)->FetchObject();
            $btn = "Alterar";
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsPessoasId($param->id)->FetchObject();
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
                        <div class='fullCenter'>
                            <div class='leftFloat'>
                                <label>Pesquisar</label>
                                " . parent::getAutoCompletePessoa(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaPessoa()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form action='$CFG->affix/$CFG->lib/actions.php' method='POST' onsubmit=\"if (!validaCampos(this)) return false; else return true;\">
                            <div class='fullCenter'>
                                $mens
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='id' id='id' value='$param->id'/>
                                    <input type='hidden' name='field' id='field' value='id'/>
                                    <input type='hidden' name='table' id='table' value='pessoas'/>
                                    <input type='hidden' name='action' id='action' value='_InsUpdt'/>
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='email'>E-mail</label>                                                                
                                    <input type='email' name='email' id='email' value='$rs->EMAIL' />
                                </div>

                                <div class='leftFloat' style='text-align: left;'>
                                    <label for='cpf'>CPF</label>
                                    <input type='text' name='cpf' id='cpf' value='$rs->CPF' placeholder='xxxxxxxxxxx' maxlenght='11' class='span4' />
                                </div>

                                <div class='rightFloat' style='text-align: left;'>                                                        
                                    <label for='senha'>Regra Geral</label>
                                    " . parent::getSelectRegraGeral($rs->REGRAGERAL) . "
                                </div>

                                <div class='rightFloat' style='width:100%; text-align: left;'>                                                        
                                    <label for='login'>Login</label>                                                                
                                    <input type='text' name='login' id='login' value='$rs->LOGIN' class='span2' />
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'>                                                        
                                    <label for='senha'>Senha</label>
                                    <input type='password' name='senha' id='senha' value='$rs->SENHA' class='span2' />
                                </div>

                                <br />
                                <div class='fullCenter'>
                                    <button class='btn btn-primary'>$btn</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class='btn btn-danger' onclick=\"if(confirm('Voce tem certeza que deseja excluir?')) return true; else return false;\" href='{$CFG->affix}{$CFG->lib}actions.php?action=deletaRegistro&table=pessoas&id=$param->id'>
                                        <i class='icon-warning-sign'></i> Excluir
                                    </a>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
        return $str;
    }

    function getPapeis($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsPapeisId($param->id)->FetchObject();
            $btn = "Alterar";
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsPapeisId($param->id)->FetchObject();
            $btn = "Cadastrar";
        }

        $str = "   <fieldset>
                        <legend>Cadastro / Alteração</legend>
                        <div class='fullCenter'>
                            <div class='leftFloat'>
                                <label>Pesquisar</label>
                                " . parent::getAutoCompleteRegras(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaRegra()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='table' id='table' value='regras' />        
                                    <input type='hidden' name='action' value='_InsUpdt' />
                                    <input type='hidden' name='field' value='id' />
                                    <input type='hidden' name='id' value='$param->id' />
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='descricao'>Descrição</label>                                                                
                                    <textarea name='descricao' id='descricao'>$rs->DESCRICAO</textarea>
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
                                    <a class='btn btn-danger' onclick=\"if(confirm('Voce tem certeza que deseja excluir?')) return true; else return false;\" href='{$CFG->affix}{$CFG->lib}actions.php?action=deletaRegistro&table=regras&id=$param->id'>
                                        <i class='icon-warning-sign'></i> Excluir
                                    </a>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
        return $str;
    }

    function autocadastro($table, $param) {
        GLOBAL $CFG;
        $evnt = new admEventos();
        $com = new comuns();

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "<fieldset>
                    <legend>Cadastro de Usuários</legend>
                    $mens
                    <form action='{$CFG->affix}{$CFG->lib}actions.php' method='POST' onsubmit=\"if (!validaCampos(this)) return false; else return true;\">
                        <input type='hidden' name='action' value='_insrtDataReturn' />
                        <input type='hidden' name='table' value='pessoas' />

                        <table class='table'>
                            <tr>
                                <td>
                                    <label>Nome</label>
                                </td>
                                <td>
                                    <input type='text' name='nome' id='nome' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>E-mail</label>
                                </td>
                                <td>
                                    <input type='email' name='email' id='email' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>CPF</label>
                                </td>
                                <td>
                                    <input type='text' name='cpf' id='cpf' maxlength='11' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Login</label>
                                </td>
                                <td>
                                    <input type='text' name='login' id='login' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Senha</label>
                                </td>
                                <td>
                                    <input type='password' name='senha' id='senha' />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type='submit' class='btn btn-primary' value='Cadastrar' />
                                </td>
                                <td colspan='2'>
                                    <input type='reset' class='btn btn-danger' value='Resetar' />
                                </td>
                            </tr>                            
                        </table>
                    </form>
                    
                </fieldset>";
        return $str;
    }

    function meusdados($table, $param) {
        GLOBAL $CFG;
        $com = new comuns();

        $rs = parent::getRsPessoasId($_SESSION['usuid'])->FetchObject();

        if (isset($param->err))
            $mens = $com->trataError($param->err);
        elseif (isset($param->mens))
            $mens = $com->trataMens($param->mens);
        else
            $mens = "";

        $str = "<fieldset>
                    <legend>Minhas Informações</legend>
                    $mens
                    <div id='tabs'>
                      <ul>
                        <li><a href='#meusdados'>Meus Dados</a></li>
                        <li><a href='#meuseventos'>Meus Eventos</a></li>
                      </ul>
                      
                      <div id='meusdados'>
                            <form action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                                <table class='table'>
                                    <tr>
                                        <td>
                                            <label>Nome</label>
                                        </td>
                                        <td>
                                            <input type='text' name='nome' id='nome' value='$rs->NOME'/>
                                            <input type='hidden' name='id' id='id' value='$rs->ID'/>
                                            <input type='hidden' name='field' id='field' value='id'/>
                                            <input type='hidden' name='table' id='table' value='pessoas'/>
                                            <input type='hidden' name='action' id='action' value='_InsUpdt'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>E-mail</label>
                                        </td>
                                        <td>
                                            <input type='email' name='email' id='email' value='$rs->EMAIL' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>CPF</label>
                                        </td>
                                        <td>
                                            <input type='text' name='cpf' id='cpf' value='$rs->CPF' maxlength='11'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Login</label>
                                        </td>
                                        <td>
                                            <input type='text' name='login' id='login' value='$rs->LOGIN' required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Senha</label>
                                        </td>
                                        <td>
                                            <input type='password' name='senha' id='senha' value='$rs->SENHA' required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='4' style='text-align:center'>
                                            <input type='submit' class='btn btn-primary' value='Alterar' />
                                        </td>
                                    </tr>                            
                                </table>
                            </form>
                        </div>
                        
                        <div id='meuseventos'>
                            ".$this->getMeusEventos($table, $param)."
                        </div>
                    
                    </div>
                </fieldset>
                <script>
                    $(function() {
                          $('#tabs').tabs();
                    });
                </script>";
        return $str;
    }

    function getMeusEventos($table, $param){
        GLOBAL $CFG;
        $admE = new admEventos();

        $str = "<table class='table'>
                    <thead>
                        <tr>
                            <th>
                                Evento
                            </th>
                            <th>
                                Inscrição
                            </th>
                            <th>
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>";

        $rs = $admE->getEventosPessoa();
        while($o = $rs->FetchNextObject()){
            $str.= "<tr>
                        <td>
                            $o->NOME
                        </td>
                        <td>
                            $o->RNOME
                        </td>";

            if ((@date("Y-m-d H:m") > $o->INIINSCRICAO ) && (@date("Y-m-d H:m") > $o->FIMINSCRICAO)){
                $str.=" <td>
                            <a class='btn btn-info' href='{$CFG->affix}pg/pessoas/emissaodecertificado/Emissao_de_Certificado.php'>Imprimir Certificado</a>
                        </td>";
            } else {
                $str.=" <td>
                            <a class='btn btn-danger' href='{$CFG->affix}mainframe/actions.php?action=cancelainscricao&pessoa={$_SESSION['usuid']}&evento=$o->ID'>Cancelar Inscrição</a>
                        </td>";
            }

            $str.=" </tr>";
        }

        $str.= "    </tbody>
                </table>";

        return $str;
    }

    function emissaodecertificado($table, $param) {
        GLOBAL $CFG;
        $admE = new admEventos();

        if (!isset($_SESSION['usuid'])){
            $str = "<fieldset>
                        <legend>Emissão de Certificados</legend>
                        <div class='fullCenter'>
                            <p>Olá! Por favor, faça seu <a style='font-weight: bold;' href='{$CFG->www}home.php'><u>login</u></a> para emitir um certificado....</p>
                        </div>
                 </fieldset>";
                 return $str;
        }

        $str = "   <fieldset>
                        <legend>Emissão de Certificados</legend>
                        <div class='fullCenter'>
                            <form action='$CFG->www/act/impressoes/imprimirCertificado/certificado.php' method='GET'>
                                <label>Selecione o Evento</label>
                                " . $admE->getSelectEvento() . "

                                <div class='fullCenter'>
                                    <input type='hidden' name='pessoa' id='pessoa' value='{$_SESSION['usuid']}' />
                                    <button class='btn btn-primary'>Emitir</button>
                                </div>
                            </form>
                        </div>
                 </fieldset>";
        return $str;
    }

}
