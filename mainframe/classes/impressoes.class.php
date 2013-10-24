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
            $inscritos = $evnt->getRsPessoasEvento($param->evento);
            $num = 1;

            $str.=" <h1 style='text-align: center;'>Lista de Presença do Evento - $evento->NOME</h1>
                    <h5 style='text-align: center;'>
                        " . $uti->formatDateTime($evento->INIEVENTO) . "
                      - " . $uti->formatDateTime($evento->FIMEVENTO) . "
                    </h5>
                    <hr />
                    <h3>$o->TNOME - $o->NOME</h3>
                    <table style='width: 100%; text-align: center;'>
                        <thead>
                            <tr>
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
                $str.= "    <tr>
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

        $evento = $evnt->getRsEventosId($param->evento)->FetchObject();
        $inscritos = $evnt->getRsPessoasEvento($param->evento);

        while ($o = $inscritos->FetchNextObject()) {

            $str.=" <table style='margin: 0 auto; width: 75%; text-align: center;' border='1'>
                        <thead>
                            <tr>
                                <th colspan='2'>
                                    <h1 style='text-align: center;'>$o->NOMER - $evento->NOME</h1>
                                </th>
                            <tr>
                                <th>
                                    Pessoa
                                </th>
                                <th>
                                    Evento
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    $o->NOME
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        </tbody>
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
            $str.=" <h1 style='text-align: center;'>
                        Identificação de Sala
                        <br />
                        Evento - $evento->NOME
                    </h1>
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

        $evento = $evnt->getRsEventosId($param->evento)->FetchObject();
        $inscritos = $evnt->getRsPessoasEvento($param->evento);

        while ($o = $inscritos->FetchNextObject()) {

            $str.="     <h2 style='text-align: center;'>Certificado de Evento</h2>
                        <table style='margin: 0 auto; width: 100%; text-align: center;'>
                        <thead>
                            <tr>
                                <th colspan='2'>
                                    <h1 style='text-align: center;'>$o->NOMER - $evento->NOME</h1>
                                </th>
                            <tr>
                                <th>
                                    Pessoa
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    $o->NOME
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <pagebreak />";
        }

        $mpdf->WriteHTML($str);
        $mpdf->Output();
        exit();
    }

}