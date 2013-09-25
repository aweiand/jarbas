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

}