<?php

/**
 * Classe de administração da tabela de pessoas
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @author Deividi Schumacher Velho <deividivelho@gmail.com>
 * @version 0.1
 */
class admPessoas extends database {

    /**
     * Funcao para efetuar verificacao do Login / Senha
     * @access public
     * @param $user String - Usuario
     * @param $passw String - Senha
     * @return Array
     */
    function _login($user, $passw) {
        $ut = new utils();
        $cmdSQL = "SELECT id, nome, email FROM pessoas WHERE
                                                login = '" . $user . "' AND senha = '$passw'
                                                AND status = 0";
        $rs = parent::query($cmdSQL);
        if ($rs && $rs->RecordCount() != 0) {
            $ret['usuid'] = $rs->Fields("id");
            $ret['usu'] = $rs->Fields("nome");
            $ret['email'] = $rs->Fields("email");
            return $ret;
        } else {
            return array();
        }
    }

    function getRsPessoasId($id = "") {
        $sql = "SELECT * FROM pessoas ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getRsPapeisId($id = "") {
        $sql = "SELECT * FROM regras ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY nome ASC";
        return parent::query($sql);
    }

    function getNextId() {
        return parent::seed("pessoas", "id");
    }

    function getSelectRegraGeral($select = "") {
        $str = "<select name='regrageral' id='regrageral'>";

        switch ($select) {
            case 0 : $str.="<option value='1'>Gerente</option>
                                                   <option value='0' selected='selected'>Usuário</option>";
                break;
            case 1 : $str.="<option value='1' selected='selected'>Gerente</option>
                                                   <option value='0'>Usuário</option>";
                break;
            default: $str.="<option value='1'>Gerente</option>
                                                    <option value='0' selected='selected'>Usuário</option>";
                break;
        }

        $str.="</select>";

        return $str;
    }

    function getAutoCompletePessoa($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'pessoas', "key" => "id", "data" =>
                    array('nome'), "name" => 'pessoa', "searchclass" => "admPessoas", "theme" => "",
                    "utf8" => false, "min" => 1));
    }

    function getAutoCompleteRegras($id = '') {
        $uti = new utils();

        return $uti->getMultiselect(array("cod" => $id, "table" => 'regras', "key" => "id", "data" =>
                    array('nome'), "name" => 'regra', "searchclass" => "admPessoas", "theme" => "",
                    "utf8" => false, "min" => 1, "getJsonDB" => "pessoas/getJSONRegras"));
    }

    function getJSONRegras($table, $param) {
        $rs = parent::query("SELECT * FROM regras
                                WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                    OR UPPER(descricao) LIKE UPPER('%" . strtoupper($param->term) . "%')
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
                        "username" :"' . $rs->Fields("nome") . '", "email":"' . $rs->Fields("descricao") . 
                        '", "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

    function getJSONPessoas($table, $param) {
        $rs = parent::query("SELECT * FROM pessoas
                            WHERE UPPER(nome) LIKE UPPER('%" . strtoupper($param->term) . "%') 
                                    OR UPPER(email) LIKE UPPER('%" . strtoupper($param->term) . "%')
                                    OR UPPER(login) LIKE UPPER('%" . strtoupper($param->term) . "%')
                                    OR UPPER(cpf) LIKE UPPER('%" . strtoupper($param->term) . "%')
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
                        "username" :"' . $rs->Fields("login") . '", "email":"' . $rs->Fields("email") . 
                        '", "name":"' . $rs->Fields("nome") . '" }';
            $rs->MoveNext();
        }
        $json .= ']';
        echo $json;
    }

}
