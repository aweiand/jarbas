<?php

/**
 * Classe de administração da tabela de pessoas
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @author Deividi Schumacher Velho <deividivelho@gmail.com>
 * @version 0.1
 */
class admEventos extends database {

    function getRsEventosId($id = "") {
        if ($id == "") {
            $id = " eventopai IS NULL ";
        } else {
            $id = " id = $id ";
        }

        $sql = "SELECT * FROM eventos WHERE $id ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getRsAtividadesId($id = "") {
        if ($id == "") {
            $id = " IS NOT NULL ";
        } else {
            $id = " = $id ";
        }

        $sql = "SELECT e.*, t.nome as tnome, s.nome snome
                    FROM eventos e 
                INNER JOIN tipos t ON (e.tipo = t.id)
           LEFT OUTER JOIN salas s ON (e.sala = s.id)
                    WHERE eventopai $id ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getRsGradeId($id = "") {
        $sql = "SELECT * FROM eventos WHERE eventopai = $id ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getNextId() {
        return parent::seed("eventos", "id");
    }

    function getSelectEvento($id = "", $extra = "") {
        $uti = new utils();
        $sql = "SELECT * FROM eventos WHERE eventopai IS NULL ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "eventos", "id", "nome", "evento", parent::query($sql), false, $extra);

        return $str;
    }

    function getSelectAtividades($id = "", $extra = "") {
        $uti = new utils();
        $sql = "SELECT * FROM eventos WHERE eventopai IS NOT NULL ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "eventos", "id", "nome", "evento", parent::query($sql), false, $extra);

        return $str;
    }

    function getSelectInstituicao($id = "", $extra = "") {
        $uti = new utils();
        $sql = "SELECT * FROM instituicoes ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "instituicoes", "id", "nome", "instituicao", parent::query($sql), false, $extra);

        return $str;
    }

    function getSelectTipo($id = "") {
        $uti = new utils();
        $sql = "SELECT * FROM tipos ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "tipos", "id", "nome", "tipo", parent::query($sql), false);

        return $str;
    }

    function getSelectSala($id = "") {
        $uti = new utils();
        $sql = "SELECT * FROM salas ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "salas", "id", "nome", "sala", parent::query($sql), false);

        return $str;
    }

    function getBotaoInscricao($evnt) {
        if (parent::query("SELECT pessoa FROM inscricoes WHERE pessoa = {$_SESSION['usuid']} AND evento = $evnt")->RecordCount() == 0) {
            $str = "<button class='btn btn-primary' onclick='inscreverNoEvento({$_SESSION['usuid']}, $evnt)'>Inscrever-me</button>";
        } else {
            $str = "<span class='label label-success'>Já Inscrito</span>";
        }

        return $str;
    }

    function getRsPessoasEvento($evento, $pessoa = "") {
        if ($pessoa != "") {
            $pessoa = " AND p.id = $pessoa ";
        } else {
            $pessoa = " ";
        }

        $sql = "SELECT p.*, r.nome as nomer FROM inscricoes i
                    INNER JOIN pessoas p ON (i.pessoa = p.id)
                    INNER JOIN regras r ON (i.regra = r.id)
                WHERE i.evento = $evento $pessoa
                    ORDER BY nome ASC";

        return parent::query($sql);
    }

    function getRadioPresenteEvento($evento, $pessoa) {
        $presente = parent::query("SELECT presente FROM presencas WHERE pessoa = $pessoa AND evento = $evento");

        if ($presente->RecordCount() == 0) {
            return "<label title='Presente'>
                        Presente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='1' />
                    </label>
                    <label title='Ausente'>
                        Ausente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='0' />
                    </label>";
        }

        if (!$presente->Fields(0)) {
            return "<label title='Presente'>
                        Presente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='1' />
                    </label>
                    <label title='Ausente'>
                        Ausente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='0' checked='checked' />
                    </label>";
        } else {
            return "<label title='Presente'>
                        Presente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='1' checked='checked' />
                    </label>
                    <label title='Ausente'>
                        Ausente <input type='radio' name='pessoa[$pessoa]' id='$pessoa' value='0' />
                    </label>";
        }
    }

    function getAutoCompleteEvento($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'eventos', "key" => "id", "data" =>
                    array('nome'), "name" => 'evento', "searchclass" => "admEventos", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "eventos/getJSONEventos"));
    }

    function getJSONEventos($table, $param) {
        $rs = parent::query("SELECT * FROM eventos
                                WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                    OR UPPER(resumo) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                    OR UPPER(local) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                            LIMIT 10 OFFSET 0");
        $json = '[';
        $first = true;
        while (!$rs->EOF) {
            if (!$first) {
                $json .= ',';
            } else {
                $first = false;
            }
            $json .= '{"id": ' . $rs->Fields("id") . ' , "value":"' . $rs->Fields("nome") . '",
                        "username" :"' . $rs->Fields("nome") . '", "email":"",
                        "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

    function getRsAtividadesDoEvento($evento) {
        $uti = new utils();
        $rs = $uti->getArraySelectDB(parent::query("SELECT id FROM eventos WHERE eventopai = $evento"), 0);

        return $uti->getMultiselect(array("cod" => $rs, "table" => 'eventos', "key" => "id", "data" =>
                    array('nome'), "name" => 'atividadesdoevento', "searchclass" => "admEventos", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "eventos/getJSONEventos"));
    }

    function getEventosPessoa($pessoa = null){
        if ($pessoa == null){
            @session_start();
            $pessoa = $_SESSION['usuid'];
        }

        $sql = "SELECT e.*, r.nome as rnome FROM eventos e
                    INNER JOIN inscricoes i ON (e.id = i.evento)
                    INNER JOIN regras r ON (i.regra = r.id)
                WHERE pessoa = $pessoa
                    ORDER BY nome ASC";

        return parent::query($sql);
    }

}
