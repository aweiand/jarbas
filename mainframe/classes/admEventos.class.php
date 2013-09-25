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

        function getNextId() {
                return parent::seed("eventos", "id");
        }


}