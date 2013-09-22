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
class comuns extends database {

        /**
         * Retorna um formulário para inserção, com valores padrão
         * @global GLOBAL $CFG
         * @param String $table
         * @param Array $param
         * @return String
         */
        function insertFormSimple($table, $param) {
                GLOBAL $CFG;
                if (isset($param->id)) {
                        $rs = parent::_get("$table", "id = " . $param->id);
                        $val = $rs->Fields("nome");
                        $img = "<img src='../../../" . $rs->Fields("imagem") . "' width='50' />
                                        <br />
                                        <span>
                                                Excluir Imagem?
                                                <input type='checkbox' name='imagem' value='' witdh='50'/>
                                        </span>";
                        $btn = "Alterar";
                        $id = "<input type='hidden' name='id' id='id' value='" . $param->id . "' />";
                } else {
                        $id = "";
                        $val = "";
                        $img = "";
                        $btn = "Cadastrar";
                }

                if (isset($param->err))
                        $mens = $this->trataError($param->err);
                elseif (isset($param->mens))
                        $mens = $this->trataMens($param->mens);
                else
                        $mens = "";

                $str = "   <form id='frm-Insert-Simple' action='../../../mainframe/actions.php' method='POST' enctype='multipart/form-data'>
                                        <div class='fullCenter'>
                                                <fieldset>
                                                        <legend>Inserindo Dados</legend>
                                                        $mens
                                                        <div class='leftFloat'>                                                        
                                                                <label for='nome'>Nome</label>
                                                                <input type='text' name='nome' id='nome' value='$val' placeholder='digite um valor...' />
                                                                $id
                                                                <input type='hidden' name='table' id='table' value='$table' />        
                                                                <input type='hidden' name='action' value='upAndup' />
                                                                <br />
                                                                <span class='error alert alert-error' id='errNome' style='display: none;'>Campo Obrigatório!</span>
                                                        </div>
                                                        
                                                        <div class='rightFloat'>                                                        
                                                                <label for='imagem'>Imagem</label>
                                                                $img
                                                                <input type='file' name='imagem' id='imagem' size='10' />
                                                        </div>
                                                        
                                                </fieldset>
                                                <br />
                                                <div class='fullCenter'>
                                                        <button class='btn btn-warning' id='btn-saveSimpleForm'>$btn</button>
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
        function listFormSimple($table, $param) {
                GLOBAL $CFG;
                @session_start();
                $_SESSION['return'] = "pg/comuns/listFormSimple/$table.php";

                $str = $this->insertFormSimple($table, $param);

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
                                <legend>Listagem de $table</legend>
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
                                                                Imagem
                                                        </th>
                                                        <th>
                                                                &nbsp;
                                                        </th>
                                                </tr>
                                        </thead>
                                        <tbody>";
                $rs = parent::_get("$table");

                $cor = $this->bg;
                while (!$rs->EOF) {
                        if ($cor == $this->bg)
                                $cor = $this->bgCor;
                        else
                                $cor = $this->bg;

                        $str.="<tr>
                                        <td>
                                                <span name='id'>" .
                                $rs->Fields("id")
                                . "</span>
                                                </td>
                                        <td>" .
                                $rs->Fields("nome")
                                . "</td>
                                        <td>
                                                <img src='../../../" . $rs->Fields("imagem") . "' width='100' />
                                        </td>
                                        <td>
                                                <a class='btn' href='$CFG->www/pg/comuns/insertFormSimple/$table.php?id=" . $rs->Fields('id') . "' title='Editar este Item'>
                                                        <i class='icon-edit'></i>
                                                </a>
                                                <a class='btn' href='#' id='btn-remove-item' title='Remover este Item' data-table='$table'>
                                                        <i class='icon-remove'></i>
                                                </a>
                                        </td>
                                </tr>";
                        $rs->MoveNext();
                }

                $str.= "</tbody>
                                </table>
                        </fieldset>
                                <script>
                                        $(function(){
                                                tblShort('lst-field-full');
                                                $('#frm-Insert-Simple').css({ display : 'none' });
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

        function downloads($table, $param) {
                $str = "
                <fieldset>
                    <legend>Downloads</legend>
                    <table class='table table-stripped'>
                        <thead>
                            <tr>
                                <th style='min-width: 400px; max-width: 55%;'>Nome</th> 
                                <th style='min-width: 100px; max-width: 15%;'>Versão</th> 
                                <th style='min-width: 100px; max-width: 15%;'>Data</th> 
                                <th style='min-width: 100px; max-width: 15%;'>Download</th>
                            </tr>
                        </thead>
                            <tbody>";

                $ponteiro = opendir($_SERVER['DOCUMENT_ROOT'] . $this->assets);

                while ($nome_itens = readdir($ponteiro)) {
                        $item = explode('.', $nome_itens);
                        if (is_file($_SERVER['DOCUMENT_ROOT'] . $this->assets . $nome_itens)) {
                                $file = @explode('__', $item[0]);
                                $versao = @str_replace('-', '.', $file[1]);
                                $arquivo = @str_replace('_', ' ', $file[0]);
                                $data = @date('d/m/Y', filectime($_SERVER['DOCUMENT_ROOT'] . $this->assets . $nome_itens));

                                $str.= "
                            <tr>
                                <td class='nome_tutorial'>
                                    $arquivo
                                </td>
                                <td class='versão'>
                                    $versao
                                </td>
                                <td class='data'>
                                    $data
                                </td>
                                <td>
                                    <a href='http://www.facos.edu.br/$this->assets/$nome_itens'>
                                            <img width='50px' height='50px' src='http://www.cnecead.com.br/tudown/img/icon_donwload.png'>
                                    </a>
                                </td>
                            </tr>";
                        }
                }
                $str.="         </tbody>
                    </table>
                </fieldset>
                <script>
                    $(function() {
                        $('.table').dataTable({
                            'bPaginate': false,
                            'bLengthChange': true,
                            'bFilter': false,
                            'bSort': true,
                            'bInfo': false,
                            'bAutoWidth': true,
                            'oLanguage': {
                                    'sUrl': '/cead/admin2/mainframe/plugins/jquery/DataTables-1.9.4/datatables.Portuguese.txt'
                            },
                            'bJQueryUI': false
                        });
                    });
                </script>";
                return $str;
        }

}
