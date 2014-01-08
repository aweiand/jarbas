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
        $uti = new utils();

        if (isset($param->id)) {
            $rs = parent::getRsEventosId($param->id)->FetchObject();
            $btn = "Alterar";
            if ($rs->LOGO != "") {
                $logo = "<img src='$CFG->www/assets/data/$rs->LOGO' width='150' />";
            } else {
                $logo = "";
            }
        } else {
            $param->id = parent::getNextId();
            $rs = parent::getRsEventosId($param->id)->FetchObject();
            $btn = "Cadastrar";
            $logo = "";
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
                                " . parent::getAutoCompleteEvento(null) . "
                            </div>
                            
                            <div class='rightFloat'>
                                <br />
                                <button onclick='pesquisaEventos()' class='btn btn-info btn-large'><i class='icon-ok'></i></button>
                            </div>
                        </div>
                        <hr class='fullCenter' />
                        
                        <form action='$CFG->affix/$CFG->lib/actions.php' method='POST' enctype='multipart/form-data'>
                            <div class='fullCenter'>
                                <div class='leftFloat' style='width:100%; text-align: left;'> 
                                    <label for='nome'>Nome</label>
                                    <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                    <input type='hidden' name='id' id='id' value='$param->id'/>
                                    <input type='hidden' name='field' id='field' value='id'/>
                                    <input type='hidden' name='table' id='table' value='eventos'/>
                                    <input type='hidden' name='action' id='action' value='_InsUpdtEventos'/>
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
                                    " . parent::getSelectEvento($rs->EVENTOPAI, "", "eventopai") . "
                                </div>
                                
                                <div class='leftFloat' style='text-align: left;'> 
                                    <label for='instituicao'>Instituição Org.</label>                                                                
                                    " . parent::getSelectInstituicao($rs->INSTITUICAO) . "
                                </div>

                                <div class='rightFloat' style='width:100%; text-align: left;'>                                                        
                                    <label for='resumo'>Resumo</label>                                                                
                                    <textarea name='resumo' id='resumo'>$rs->RESUMO</textarea>
                                </div>
                                
                                <div class='rightFloat' style='width:100%; text-align: left;'>                                                        
                                    <label for='contato'>Contato</label>                                                                
                                    <textarea name='contato' id='contato'>$rs->CONTATO</textarea>
                                </div>

                                <div class='leftFloat' style='text-align: left;'>                                                        
                                    <label for='iniinscricao'>Abertura de Inscrições</label>
                                    <input type='text' name='iniinscricao' id='iniinscricao' value='" . $uti->formatDateTime($rs->INIINSCRICAO) . "' class='span6' />
                                </div>
                                
                                <div class='rightFloat' style='text-align: left;'>                                                        
                                    <label for='fiminscricao'>Fim de Inscrições</label>
                                    <input type='text' name='fiminscricao' id='fiminscricao' value='" . $uti->formatDateTime($rs->FIMINSCRICAO) . "' class='span6' />
                                </div>
                                
                                <div class='leftFloat' style='text-align: left;'>                                                        
                                    <label for='inievento'>Início do Evento</label>
                                    <input type='text' name='inievento' id='inievento' value='" . $uti->formatDateTime($rs->INIEVENTO) . "' class='span6' />
                                </div>
                                
                                <div class='rightFloat' style='text-align: left;'>                                                        
                                    <label for='fimevento'>Fim do evento</label>
                                    <input type='text' name='fimevento' id='fimevento' value='" . $uti->formatDateTime($rs->FIMEVENTO) . "' class='span6' />
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
                                    $logo
                                    <input type='file' name='logo' id='logo' />
                                </div>
                                
                                <div class='fullCenter'>
                                    <label>Atividades do Evento</label>
                                    " . parent::getRsAtividadesDoEvento($param->id) . "
                                </div>
                                
                                <div class='fullCenter' style='margin-top: 30px'>
                                    <button class='btn btn-primary'>$btn</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class='btn btn-danger'><i class='icon-warning-sign'></i> Cancelar</button>
                                </div>
                            </div>
                        </form>
                 </fieldset>
                 
                <script>
                    $(function(){
                        $('#fimevento, #inievento, #fiminscricao, #iniinscricao').datetimepicker({
                            timeFormat: 'HH:mm',
                            dateFormat: 'dd/mm/yy',
                            timeOnlyTitle: 'time only title',
                            timeText: 'Horário',
                            hourText: 'Hora',
                            minuteText: 'Minuto',
                            secondText: 'Segundo',
                            currentText: 'Agora',
                            closeText: 'Pronto',
                            
                            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
                            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
                            nextText: 'Próximo',
                            prevText: 'Anterior'                            
                        });
                    })
                </script>";

        return $str;
    }

    /**
     * Função que imprime os eventos correntes
     * @global GLOBAL $CFG
     * @param String $table
     * @param Object $param
     * @return html
     */
    function todoseventos($table, $param) {
        GLOBAL $CFG;

        $str = "<fieldset>
                    <legend>Eventos Correntes</legend>
                    <div id='accordion'>";

        $rs = parent::getRsEventosId();
        while ($o = $rs->FetchNextObject()) {
            $atvd = parent::getRsAtividadesId($o->ID);

            $str.= "<h3>$o->NOME</h3>
                    <div>
                        <p>
                            $o->RESUMO
                        </p>
                        <a class='btn btn-primary' style='color: #FFF; margin-bottom: 10px;' href='$CFG->www/pg/eventos/gradedehorarios/Grade_de_Horarios.php?evento=$o->ID'>
                            <i class='icon-calendar'></i> Grade de Horários
                        </a>
                    <div class='accs'>";

            while ($at = $atvd->FetchNextObject()) {
                $str.= "<h3>$at->NOME</h3>
                        <div>
                            <p>
                                $at->RESUMO
                            </p>
                        </div>";
            }

            $str.= "</div>
                </div>";
        }


        $str.="     </div>
            </fieldset>
            
            <script>
                $(function(){
                    $('#accordion, .accs').accordion({
                        collapsible: true,
                        active: false,
                        heightStyle: 'content'
                    });
                })
            </script>";

        return $str;
    }

    /**
     * Função que imprime a grade de horários
     * @global GLOBAL $CFG
     * @param String $table
     * @param Object $param
     * @return html
     */
    function gradedehorarios($table, $param) {
        GLOBAL $CFG;
        $uti = new utils();
        @session_start();

        if (!isset($param->evento)) {
            $str = "<fieldset>
                        <legend>Grade de Horário de Eventos</legend>
                        " . parent::getSelectEvento(null, "class='span8' onchange='recarregaPaginaEvnt()'") . "
                    </fieldset>";
        } else {
            $rs = parent::getRsGradeId($param->evento);
            $str = "<fieldset>
                        <legend>Grade de Horário do Evento - " . $rs->Fields("nome") . "</legend>
                        " . parent::getSelectEvento($param->evento, "class='span8' onchange='recarregaPaginaEvnt()'") . "
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Evento
                                    </th>
                                    <th>
                                        Início
                                    </th>
                                    <th>
                                        Término
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>";

            while ($o = $rs->FetchNextObject()) {
                if (isset($_SESSION['usuid'])) {
                    $insc = parent::getBotaoInscricao($o->ID);
                } elseif (@date("Y-m-d") < $o->FIMEVENTO) {
                    $insc = "<span class='label label-warning'>Inscrições Encerradas</span>";
                } else {
                    $insc = "<a href='{$CFG->www}home.php' class='label label-warning' style='color: white'>Inscreva-se!</span>";
                }

                $str.= "    <tr>
                                <td>
                                    $o->ID
                                </td>
                                <td>
                                    $o->NOME
                                </td>
                                <td>
                                    " . $uti->formatDateTime($o->INIEVENTO) . "
                                </td>
                                <td>
                                    " . $uti->formatDateTime($o->FIMEVENTO) . "
                                </td>
                                <td>
                                    $insc
                                </td>
                            </tr>";
            }


            $str.="     </tbody>
                    </table>
                </fieldset>";
        }

        return $str;
    }

    /**
     * Função que imprime os eventos em destaque na página inicial
     * @global GLOBAL $CFG
     * @return html
    */
    function eventosDestaque(){
        GLOBAL $CFG;

        $str = "";

        $rs = parent::getRsEventosId();
        while ($o = $rs->FetchNextObject()) {
            $str.= "<div class='evntDestaque'>
                        <caption><b>$o->NOME</b></caption>
                        <p>
                            ".substr($o->RESUMO, 0, 100)."...
                        </p>
                        <a class='btn btn-primary' style='color: #FFF;' 
                            href='$CFG->www/pg/eventos/gradedehorarios/Grade_de_Horarios.php?evento=$o->ID'>
                                <i class='icon-calendar'></i> Grade de Horários
                        </a>
                    </div>";
        }

        return $str;        
    }

}
