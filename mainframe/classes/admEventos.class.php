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
        $sql = "SELECT * FROM eventos ";

        if ($id != "") {
            $sql.= "WHERE id = $id";
        }

        $sql.= "ORDER BY nome ASC";

        $str = $uti->getSelectDb($id, "eventos", "id", "nome", "evento", parent::query($sql));

        return $str;
    }

    function getRsPessoasEvento($evento) {
        $sql = "SELECT * FROM inscricoes i
                    INNER JOIN pessoas p ON (i.pessoa = p.id)
                WHERE i.evento = $evento
                    ORDER BY nome ASC";

        return parent::query($sql);
    }

}
