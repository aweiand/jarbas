<?php

/**
 * Classe de administração da tabela de pessoas
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @author Deividi Schumacher Velho <deividivelho@gmail.com>
 * @version 0.1
 */
class admComuns extends database {

    function getRsTableId($table, $id = "") {
        $sql = "SELECT * FROM $table ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY 1 ASC";
        return parent::query($sql);
    }

    function getNextId($table) {
        return parent::seed($table, "id");
    }

    function getAutoCompleteSalas($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'salas', "key" => "id", "data" =>
                    array('nome'), "name" => 'sala', "searchclass" => "admComuns", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "comuns/getJSONSalas"));
    }

    function getJSONSalas($table, $param) {
        $rs = parent::query("SELECT * FROM salas
                                WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                    OR capacidade = " . intval($param->term) . "
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
                        "username" :"' . $rs->Fields("nome") . '", "email":"' . $rs->Fields("capacidade") .
                    '", "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

    function getAutoCompleteInstituicoes($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'instituicoes', "key" => "id", "data" =>
                    array('nome'), "name" => 'instituicao', "searchclass" => "admComuns", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "comuns/getJSONInstituicoes"));
    }

    function getJSONInstituicoes($table, $param) {
        $rs = parent::query("SELECT * FROM instituicoes
                                WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                   OR UPPER(sigla) LIKE UPPER('%" . strtoupper($param->term) . "%') 
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
                        "username" :"' . $rs->Fields("nome") . '", "email":"' . $rs->Fields("sigla") .
                    '", "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

    function getAutoCompleteTipos($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'tipos', "key" => "id", "data" =>
                    array('nome'), "name" => 'tipo', "searchclass" => "admComuns", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "comuns/getJSONTipos"));
    }

    function getJSONTipos($table, $param) {
        $rs = parent::query("SELECT * FROM tipos
                                WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
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
                        "username" :"' . $rs->Fields("nome") . '", "email":" ",
                        "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

    function getSelectPapel($id = '') {
        $uti = new utils();
        $sql = "SELECT * FROM regras ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "regras", "id", "nome", "regra", parent::query($sql));

        return $str;
    }

}
