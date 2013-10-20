<?php

class eventos extends admEventos {

    /**
     * Retorna um formulário para inserção, com valores padrão
     * @global GLOBAL $CFG
     * @param String $table
     * @param Array $param
     * @return String
     */
    function getEventos($table, $param) {
        GLOBAL $CFG;

        if (isset($param->id)) {
            $rs = parent::getRsEventosId($param->id)->FetchObject();
            $btn = "Alterar";
            $id = "<input type='hidden' name='id' id='id' value='$param->id' />";
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsEventosId($param->id)->FetchObject();
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

                                <div class='leftFloat' style='text-align: left;'> 
                                    <label for='tipo'>Tipo</label>                                                                
                                    " . parent::getSelectTipo($rs->TIPO) . "
                                </div>

                                <div class='leftFloat' style='text-align: left;'>
                                    <label for='local'>Local</label>
                                    <input type='text' name='local' id='local' value='$rs->LOCAL' />
                                </div>

                                <div class='leftFloat' style='text-align: left;'> 
                                    <label for='tipo'>Evento Pai</label>                                                                
                                    " . parent::getSelectEvento($rs->EVENTOPAI) . "
                                </div>

                                <div class='rightFloat' style='width:100%; text-align: left;'>                                                        
                                    <label for='resumo'>Resumo</label>                                                                
                                    <textarea name='resumo' id='resumo'>$rs->RESUMO</textarea>
                                </div>

                                <div class='leftFloat' style='text-align: left;'>                                                        
                                    <label for='iniinscricao'>Abertura de Inscrições</label>
                                    <input type='text' name='iniinscricao' id='iniinscricao' value='$rs->INIINSCRICAO' class='span4' />
                                </div>
                                
                                <div class='rightFloat' style='text-align: left;'>                                                        
                                    <label for='fiminscricao'>Fim de Inscrições</label>
                                    <input type='text' name='fiminscricao' id='fiminscricao' value='$rs->FIMINSCRICAO' class='span4' />
                                </div>
                                
                                <div class='leftFloat' style='text-align: left;'>                                                        
                                    <label for='inievento'>Início do Evento</label>
                                    <input type='text' name='inievento' id='inievento' value='$rs->INIEVENTO' class='span4' />
                                </div>
                                
                                <div class='rightFloat' style='text-align: left;'>                                                        
                                    <label for='fimevento'>Fim do evento</label>
                                    <input type='text' name='fimevento' id='fimevento' value='$rs->FIMEVENTO' class='span4' />
                                </div>
                                
                                <div class='leftFloat' style='text-align: left;'>                                                        
                                    <label for='sala'>Sala</label>
                                    " . parent::getSelectSala($rs->SALA) . "
                                </div>
                                
                                <div class='rightFloat' style='text-align: left;'>                                                        
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

        $str.="                  </select>
                                </div>

                                <div class='fullCenter'>
                                    <label>Logo do Evento</label>
                                    <img src='' />
                                    <input type='file' />
                                </div>
                                
                                <div class='fullCenter'>
                                    <button class='btn btn-primary'>$btn</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>
                 
                <script>
                    $(function(){
                        $('#fimevento, #inievento, #fiminscricao, #iniinscricao').datepicker();
                    })
                </script>";

        return $str;
    }

    function todoseventos($table, $param) {
        GLOBAL $CFG;

        $str = "<fieldset>
                    <legend>Eventos Correntes</legend>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Evento
                                </th>
                            </tr>
                        </thead>
                        <tbody>";

        $rs = parent::getRsEventosId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "<tr>
                        <td>
                            $o->ID
                        </td>
                        <td>
                            $o->NOME
                        </td>
                    </tr>";
        }


        $str.="     </tbody>
                </table>
            </fieldset>";

        return $str;
    }

    function gradedehorarios($table, $param) {
        GLOBAL $CFG;
        @session_start();

        if (!isset($param->evento)) {
            $rs = parent::getRsGradeId();
        } else {
            $rs = parent::getRsGradeId($param->evento);
        }

        $str = "<fieldset>
                    <legend>Grade de Horário do Evento - EVENTO XXXXXX</legend>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Evento
                                </th>
                            </tr>
                        </thead>
                        <tbody>";

        while ($o = $rs->FetchNextObject()) {
            $str.= "<tr>
                        <td>
                            $o->ID
                        </td>
                        <td>
                            $o->NOME
                        </td>
                    </tr>";
        }


        $str.="     </tbody>
                </table>
            </fieldset>";

        return $str;
    }

}
