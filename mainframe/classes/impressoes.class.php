<?php

GLOBAL $CFG;
require_once $_SERVER['DOCUMENT_ROOT'] . $CFG->affix . "/" . $CFG->lib . "plugins/MPDF56/mpdf.php";

class impressoes extends database {

    /**
     * Imprime a lista de presença do evento completa
     * @param type $table
     * @param type $param
     */
    function imprimirListasDePresenca($table, $param) {
        $mpdf = new mPDF();
        $evnt = new admEventos();
        $uti = new utils();

        $evento = $evnt->getRsEventosId($param->evento)->FetchObject();
        $atividades = $evnt->getRsAtividadesId($param->evento);

        while ($o = $atividades->FetchNextObject()) {
            $inscritos = $evnt->getRsPessoasEvento($o->ID);
            $num = 1;

            $str.=" <h2 style='font-family: Arial; color: #fff; background-color: #3665ab; text-align: center; padding: 10px;'>Lista de Presença do Evento - $evento->NOME</h2>
                    <h5 style='text-align: center;'>
                        " . $uti->formatDateTime($evento->INIEVENTO) . "
                      - " . $uti->formatDateTime($evento->FIMEVENTO) . "
                    </h5>
                    <hr />
                    <h3 style='font-family: Arial; text-align: center;'>$o->TNOME - $o->NOME</h3>
                    <table style='font-family: Arial; width: 100%; text-align: center;'>
                        <thead>
                            <tr style='font-family: Arial;'>
                                <th>
                                    #
                                </th>
                                <th>
                                    Pessoa
                                </th>
                                <th>
                                    Presente / Não Presente
                                </th>
                                <th>
                                    Assinatura
                                </th>
                            </tr>
                        </thead>
                        <tbody>";

            while ($ob = $inscritos->FetchNextObject()) {
                $str.= "    <tr style='font-family: Arial;'>
                                <td>
                                    $num
                                </td>
                                <td>
                                    $ob->NOME ($ob->NOMER)
                                </td>
                                <td>
                                    [   ] Sim / [   ] Não
                                </td>
                                <td>
                                    ________________________________
                                </td>
                            </tr>";

                $num++;
            }

            $str.="     </tbody>
                    </table>
                    
                    <hr /> <pagebreak />";
        }

        $mpdf->WriteHTML($str);
        $mpdf->Output();
        exit();
    }

    function imprimirCrachas($table, $param) {
        $mpdf = new mPDF();
        $evnt = new admEventos();
        $uti = new utils();

        $eventos = implode(",", $uti->getArraySelectDB($evnt->getRsAtividadesId($param->evento), 0));
        $inscritos = $evnt->query("SELECT DISTINCT(pessoa), p.*
                                        FROM inscricoes i
                                    INNER JOIN pessoas p ON (p.id = i.pessoa)
                                        WHERE evento IN ($eventos)");

        while ($o = $inscritos->FetchNextObject()) {
            $evento = $evnt->getRsEventosId($param->evento)->FetchObject();

            $str.=" <table style='margin: 0 auto; width: 80%; text-align: center; background-color: #e6e6e6; padding: 0px;' border='0'>
                        <thead>
                            <tr style='background-color: #3665ab; padding: 0px;'>
                                <th colspan='1'>
                                    <h2 style='font-family: Arial; color: #fff; text-align: center; padding: 50px;'>Identificação</h2>
                                </th>
                            <tr>
                                <th>
                                    <h4 style='font-family: Arial; color: #000; text-align: justify;'>Evento: $o->NOMER $evento->NOME</h4>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                <br />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h2 style='font-family: Arial; color: #000; text-align: justify;'>Nome: <b>$o->NOME</b> </h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <br />
                                </td>
                            </tr>
                        </tbody>
                        <tr style='background-color: #3665ab; padding: 0px;'>
                                <th colspan='1'>
                                    <h6 style='font-family: Arial; color: #fff; text-align: center; padding: 50px;'>Jarbas Printer</h6>
                                </th>
                            <tr>
                    </table>
                    
                    <br />";
        }

        $mpdf->WriteHTML($str);
        $mpdf->Output();
        exit();
    }

    function imprimirIdentificacaoDaSala($table, $param) {
        $mpdf = new mPDF();
        $evnt = new admEventos();
        $uti = new utils();

        $evento = $evnt->getRsEventosId($param->evento)->FetchObject();
        $atividades = $evnt->getRsAtividadesId($param->evento);

        while ($o = $atividades->FetchNextObject()) {
            $str.=" <h1 style='font-family: Arial; color: #fff; background-color: #3665ab; text-align: center; padding: 10px; text-align: center;'>
                        Identificação de Sala
                    </h1>
                    <h2 style='font-family: Arial;'> Evento - $evento->NOME </h2>
                    <h5 style='text-align: center;'>
                        " . $uti->formatDateTime($evento->INIEVENTO) . "
                      - " . $uti->formatDateTime($evento->FIMEVENTO) . "
                    </h5>
                    <hr />
                    <h3>$o->TNOME - $o->NOME</h3>
                    <h4>Sala - $o->SNOME</h4>
                    <hr /> <pagebreak />";
        }

        $mpdf->WriteHTML($str);
        $mpdf->Output();
        exit();
    }

    function imprimirCertificado($table, $param) {
        $mpdf = new mPDF();
        $evnt = new admEventos();
        $uti = new utils();

        $evento = $evnt->getRsAtividadesId($param->evento);

        while ($oeventos = $evento->FetchNextObject()) {
            if (isset($param->pessoa)) {
                $inscritos = $evnt->getRsPessoasEvento($oeventos->ID, $param->pessoa);
            } else {
                $inscritos = $evnt->getRsPessoasEvento($oeventos->ID);
            }

            while ($o = $inscritos->FetchNextObject()) {
                $str.=" <h1 style='font-family: Arial; color: #fff; background-color: #3665ab; text-align: center; padding: 50px;'>CERTIFICADO</h1>
                        <table border='0' style='margin: 250 auto; width: 100%; text-align: center;'>
                        <tbody>
                            <tr>
                                <td style=' font-size: 26px; font-family: Arial; color: #000; text-align: justify; padding: 50px;'>
                                    Certifica-se que <b>$o->NOME</b> participou do(a) <b>$oeventos->NOME</b> realizada no(a) $oeventos->INOME no dia ".$uti->formatDateTime($oeventos->INIEVENTO, "data").".
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h4 style='font-family: Arial; color: #fff; background-color: #3665ab; text-align: center; padding: 20px;'>Jarbas Certification</h4>
                    <pagebreak />";
            }
        }

        $mpdf->WriteHTML($str);
        $mpdf->Output();
        exit();
    }

}
