<?php

class eventos extends admEventos {

        /**
         * Retorna um formulário para inserção, com valores padrão
         * @global GLOBAL $CFG
         * @param String $table
         * @param Array $param
         * @return String
         */
        function setEventos($table, $param) {
                GLOBAL $CFG;
                $com = new comuns();

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

                if (isset($param->err))
                        $mens = $com->trataError($param->err);
                elseif (isset($param->mens))
                        $mens = $com->trataMens($param->mens);
                else
                        $mens = "";

                $str = "   <form id='frm-Insert-Simple' action='$CFG->affix/$CFG->lib/actions.php' method='POST'>
                                        <div class='fullCenter'>
                                                <fieldset>
                                                        <legend>Inserindo Evento</legend>
                                                        $mens
                                                        <div class='leftFloat'>                                                        
                                                                <label for='nome'>Nome</label>
                                                                <input type='text' name='nome' id='nome' value='$rs->NOME' placeholder='digite um valor...' />
                                                                $id
                                                                <input type='hidden' name='table' id='table' value='pessoas' />        
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
        function getEventos($table, $param) {
                GLOBAL $CFG;
                @session_start();
                $_SESSION['return'] = "pg/eventos/getEventos/pessoas.php";

                $com = new comuns();

                $str = $this->setEventos($table, $param);
                $rs = parent::getRsEventosId();

                if (isset($param->err))
                        $mens = $com->trataError($param->err);
                elseif (isset($param->mens))
                        $mens = $com->trataMens($param->mens);
                else
                        $mens = "";

                $str.= "<div class='fullCenter' style='margin-top: 5px; margin-bottom: 5px;'>
                                        $mens
                                        <button class='btn btn-primary' onclick='$(\"#frm-Insert-Simple\").animate({ height: \"toggle\", opacity: \"toggle\" }, \"slow\"); $(this).remove(); return false;'>Inserir</button>
                             </div>
                             <fieldset>
                                <legend>Listaga de Eventos Cadastradas</legend>
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
                                                                Local
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
                                                $o->LOCAL
                                        </td>
                                        <td>
                                                <a class='btn' href='$CFG->www/pg/eventos/setEventos/eventos.php?id=$o->ID' title='Editar este Evento'>
                                                        <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn' href='#' title='Presenças no Evento'>
                                                        <i class='icon-ok'></i>
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

}