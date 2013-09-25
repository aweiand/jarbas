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

}