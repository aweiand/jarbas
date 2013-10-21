<?php

/**
 * Classe de administração da tabela de pessoas
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @author Deividi Schumacher Velho <deividivelho@gmail.com>
 * @version 0.1
 */
class admEventos extends database {

    function getRsEventosId($id = "") {
        $sql = "SELECT * FROM eventos ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getRsGradeId($id = "") {
        $sql = "SELECT * FROM eventos ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getNextId() {
        return parent::seed("eventos", "id");
    }

    function getSelectEvento($id = "") {
        $uti = new utils();
        $sql = "SELECT * FROM eventos ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "eventos", "id", "nome", "evento", parent::query($sql));

        return $str;
    }

    function getSelectTipo($id = "") {
        $uti = new utils();
        $sql = "SELECT * FROM tipos ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "tipos", "id", "nome", "tipo", parent::query($sql));

        return $str;
    }

    function getSelectSala($id = "") {
        $uti = new utils();
        $sql = "SELECT * FROM salas ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "salas", "id", "nome", "sala", parent::query($sql));

        return $str;
    }

    function getRsPessoasEvento($evento) {
        $sql = "SELECT * FROM inscricoes i
                    INNER JOIN pessoas p ON (i.pessoa = p.id)
                WHERE i.evento = $evento
                    ORDER BY nome ASC";

        return parent::query($sql);
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

}
