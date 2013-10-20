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
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsPessoasId($param->id)->FetchObject();
            $btn = "Cadastrar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
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
                                <button class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                $mens
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    $id
                                    <input type='hidden' name='table' id='table' value='pessoas' />        
                                    <input type='hidden' name='action' value='_insUpdt' />
                                    <br />
                                    <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                </div>

                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='email'>E-mail</label>                                                                
                                    <input type='email' name='email' id='email' value='$rs->EMAIL' />
                                </div>

                                <div class='leftFloat' style='text-align: left;'>
                                    <label for='cpf'>CPF</label>
                                    <input type='text' name='cpf' id='cpf' value='$rs->CPF' placeholder='xxx.xxx.xxx-xx' maxlenght='15' class='span4' />
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
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Cancelar</button>
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
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsPapeisId($param->id)->FetchObject();
            $btn = "Cadastrar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        }

        $str = "   <fieldset>
                        <legend>Cadastro / Alteração</legend>
                        <div class='fullCenter'>
                            <div class='leftFloat input-prepend'>
                                <label>Pesquisar</label>
                                <span class='add-on'><i class='icon-search'></i></span>
                                <input class='input-block-level' name='pesq' id='pesq' type='text' placeholder='Pesquisar' />
                            </div>
                            <div class='rightFloat'>
                                <br />
                                <button class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    $id
                                    <input type='hidden' name='table' id='table' value='pessoas' />        
                                    <input type='hidden' name='action' value='_insUpdt' />
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
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>";
        return $str;
    }

    function autocadastro($table, $param) {
        GLOBAL $CFG;
        $evnt = new admEventos();

        $str = "<fieldset>
                    <legend>Cadastro de Usuários</legend>
                    
                    <form action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                        <table class='table'>
                            <tr>
                                <td>
                                    <label>Nome</label>
                                </td>
                                <td>
                                    <input type='text' name='nome' id='nome' />
                                </td>
                                <td rowspan='4'>
                                    <label>Eventos</label>
                                    <select name='evento' id='evento' multiple>";

        $rs = $evnt->getRsEventosId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "                    <option value='$o->ID'>$o->NOME</option >";
        }

        $str.="                     </select>
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
                                    <input type='text' name='cpf' id='cpf' />
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

    function emissaodecertificado($table, $param) {
        GLOBAL $CFG;
        $admE = new admEventos();

        $str = "   <fieldset>
                        <legend>Emissão de Certificados</legend>
                        <div class='fullCenter'>
                            <label>Selecione o Evento</label>
                            " . $admE->getSelectEvento() . "

                            <div class='fullCenter'>
                                <button class='btn btn-primary'>Gerar</button>
                            </div>
                        </div>
                 </fieldset>";
        return $str;
    }

}
