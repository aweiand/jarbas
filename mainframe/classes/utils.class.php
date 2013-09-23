<?php

set_time_limit(0);
/**
 * Esta Classe prove métodos úteis para utilização Geral
 *  
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @version 1.0
 * @access public
 * @name utils
 * @category utilitarios  
 * @package utils
 */
/// Date and time constants ///
/**
 * Time constant - the number of seconds in a year
 */
define('YEARSECS', 31536000);

/**
 * Time constant - the number of seconds in a week
 */
define('WEEKSECS', 604800);

/**
 * Time constant - the number of seconds in a day
 */
define('DAYSECS', 86400);

/**
 * Time constant - the number of seconds in an hour
 */
define('HOURSECS', 3600);

/**
 * Time constant - the number of seconds in a minute
 */
define('MINSECS', 60);

/**
 * Time constant - the number of minutes in a day
 */
define('DAYMINS', 1440);

/**
 * Time constant - the number of minutes in an hour
 */
define('HOURMINS', 60);

class utils extends database {

        /**
         * Funcao para verificar se existem letras nao permitidas na sintaxe enviada
         * @access public 
         * @param $post array - variaves vindas por $_POST ou $_GET
         * @return bool - se ha valores nao permitidos ou nao
         */
        function badWords($post) {
                $badwords = array("#", "'", "*", "=", " union ", " insert ", " update ", " drop ", " select ");
                foreach ($post as $value)
                        foreach ($badwords as $word)
                                if (substr_count($value, $word) > 0)
                                        return false;
                                else
                                        return true;
        }

        /**
         * Funcao para envio de e-mails
         * @access public 
         * @param $assunto String - Assunto da Mensagem
         * @param $arq String - Localiza��o do template do E-mail
         * @param $dadosAdic Array - Dados do E-mail  
         * @return bool - com status de envio
         */
        function envEmail($assunto, $arq, $dadosAdic, $anexos = false, $login = "ead@cnec.br", $senha = "cead2013") {
                $mt = new mail($arq);
                //$mt->objMail->SMTPDebug  = 2;  
                $mt->objMail->SMTPSecure = "tls";
                $from = '';

                if ((isset($dadosAdic['nomeFrom'])) && (isset($dadosAdic['emailFrom']))) {
                        $from = $dadosAdic['nomeFrom'] . "<" . $dadosAdic['emailFrom'] . ">";
                } else
                //$from = "CNEC EAD<cead@facos.edu.br>";
                        $from = "CNEC EAD<ead@cnec.br>";

                if ((isset($dadosAdic['nome'])) && (isset($dadosAdic['email'])))
                        $to = $dadosAdic['nome'] . "<" . $dadosAdic['email'] . ">";
                else
                        $to = "CNEC EAD<cead@facos.edu.br>";

                //$mt->setConfig("smtp.facos.edu.br", "cead@facos.edu.br", "cead2013", "587");
                //$mt->setConfig("smtp.gmail.com", "ead@cnec.br", "cead2013", "587");
                $mt->setConfig("smtp.gmail.com", $login, $senha, "587");

                if ($dadosAdic != '') {
                        foreach ($dadosAdic as $pos => $valor)
                                $mt->campos[$pos] = $valor;
                }

                $mt->assunto = $assunto;
                $mt->cabecalhos["From"] = $from;
                $mt->cabecalhos["To"] = $to;
                $mt->campos["momento_envio"] = @date("d-m-Y");

                $mt->parse();
                /*
                  echo $from;
                  echo $mt->send("phpmailer");
                  exit();
                 */
                if ($anexos)
                        foreach ($anexos as $a => $value) {
                                $mt->objMail->AddAttachment($_SERVER['DOCUMENT_ROOT'] . "/" . $value['link']);
                                //$mt->objMail->AddAttachment($_SERVER['DOCUMENT_ROOT'] . "/hubble/img/login-butn.png");
                        };

                $ret = $mt->send("phpmailer");
                if ($ret == 'ok')
                        return true;
                else
                        return $ret;
                //return false;  ////use "view" to debug ou "phpmailer" para envio
                //return $mt->send("phpmailer");
                //return $mt->send("mail");
                //$ret = $mt->send("phpmailer");
        }

        /**
         * Funcao para gerar o proximo autoincremento de um campo
         * 	@access public
         * 	@param $tab String - tabela do banco de dados. Ex.: 'Usuario'
         *  @param $campo String - string com o nome da coluna. Ex.: 'codUsuario'
         *  @return Integer - valor do pr�ximo autoincremento
         * 
         */
        function seed($tab, $campo) {
                $db = new data();

                $sql = "SELECT NEXTVAL('" . $tab . "_" . $campo . "_seq')";
                $ret = $db->query($sql);

                return $ret->Fields('nextval');
        }

        /**
         * Funcao que retorna um array com todos arquivos do diretorio
         * 	@access public
         * 	@param $caminho String - Caminho do diretorio
         *  @param $mask String - Tipo de Arquivo
         *  @return Array com arquivos
         */
        function getFilesFromDir($caminho, $mask = "*") {
                $dir = @ dir("$caminho");

                //List files in images directory 
                while (($file = $dir->read()) !== false) {
                        if ($file != "." && $file != ".." && fnmatch($mask, $file))
                                $l_vdir[] = $file;
                }

                $dir->close();

                array_multisort($l_vdir);

                return($l_vdir);
        }

        /**
         * Funcao que converte as datas de acordo com o modo
         * 	@access public
         * 	@param $datahora date - Data a ser convertida
         *  @param $modo String - Modo de conversao
         *  @return String
         */
        function formatDateTime($datahora, $modo = "") {
                if ($datahora != "") {
                        // Separa data e hora.
                        $dh = explode(" ", $datahora);
                        $data = $dh[0];
                        if (isset($dh[1]) && $dh[1] != '00:00:00')
                                $hora = $dh[1];
                        else
                                $hora = '';
                        // Separa a data.
                        $d = explode("-", $data);
                        @$ano = $d[0];
                        @$mes = $d[1];
                        @$dia = $d[2];
                        @$data = $d[2] . "/" . $d[1] . "/" . $d[0];
                        if ($hora != "")
                                $h = explode(":", $hora);
                        else
                                $h = array();

                        if ($modo == "")
                                return $data . ' ' . $hora;
                        else
                        if ($modo == "dia_mes")
                                return $d[2] . "/" . $d[1];
                        else
                        if ($modo == "dia_mes_escrito")
                                return $d[2] . " de " . $this->getNomeMes(intval($d[1]));
                        else
                        if ($modo == "data_traco_hora")
                                return $data . " - " . $hora;
                        else
                        if ($modo == "dia_mes_traco_hora_min")
                                return $d[2] . "/" . $d[1] . " - " . $h[0] . "h" . $h[1] . "min";
                        else
                        if ($modo == "data_hora")
                                return $data . ' ' . $h[0] . ":" . $h[1];
                        else
                        if ($modo == "data")
                                return $data;
                        else
                        if ($modo == "americano") {
                                //retorna a data no formato americano yyyy-mm-dd, recebendo
                                // por valor data dd/mm/yyyy
                                $d = explode('/', $datahora);
                                return $d[2] . "-" . $d[1] . "-" . $d[0];
                        } else
                        if ($modo == "americanoFull") {
                                //retorna a data no formato americano yyyy-mm-dd H:M:S, recebendo
                                // por valor data dd/mm/yyyy H:M:S
                                $d = explode('/', $datahora);
                                $ano = explode(" ", $d[2]);
                                return $ano[0] . "-" . $d[1] . "-" . $d[0] . " " . $ano[1];
                        } else
                        if ($modo == "brasComData") {
                                //retorna a data no formato brasileira dd-mm-yyyy H:M:S, recebendo
                                // por valor data yyyy/mm/dd H:M:S - 2012-07-31 14:00:00
                                $d = explode('-', $datahora);
                                $ano = explode(" ", $d[2]);
                                return $ano[0] . "-" . $d[1] . "-" . $d[0] . " " . $ano[1];
                        } else
                        if ($modo == "dia_escrito_mes_ano") {
                                setlocale(LC_ALL, 'pt_BR');
                                $tstamp = mktime(0, 0, 0, $mes, $dia, $ano);
                                $Tdate = getdate($tstamp);
                                return $Tdate['weekday'] . ' | ' . $dia . '-' . $mes . '-' . $ano;
                        }
                } else
                        return "";
        }

        /**
         * Funcao que retorna um array com o numero e meses por extenso 
         * 	@access public
         *  @return Array
         */
        function getMeses() {
                $mesext = array('1' => 'Janeiro', '2' => 'Fevereiro', '3' => 'Março', '4' => 'Abril',
                    '5' => 'Maio', '6' => 'Junho', '7' => 'Julho', '8' => 'Agosto',
                    '9' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro');
                return $mesext;
        }

        /**
         * Funcao que retorna o nome do mes 
         * 	@access public
         * 	@param $mes String - Numero do Mes
         *  @return String - Nome do Mes
         */
        function getNomeMes($mes) {
                $mesext = $this->getMeses();
                return $mesext[$mes];
        }

        /**
         * Funcao que retorna o numero de dias de um mes 
         * 	@access public
         * 	@param $mes String - Numero do Mes
         *  @return Integer - Numero de dias do Mes
         */
        function getDiasMes($mes) {
                $ts = $this->iso2unix(date("Y") . "-" . $mes . "-1");
                return date("t", $ts);
        }

        /**
         * Funcao que retorna o salt das senhas do Moodle 
         * 	@access public
         * 	@param $arquivo String com local do config do Moodle
         *  @return String - salt Utilizado
         */
        function getSaltFromMoodle($arquivo) {
                /*
                  $str = file_get_contents($arquivo);
                  $procurar = "/(?<=passwordsaltmain = ').*'/";

                  preg_match_all($procurar, $str, $arr);
                  print_r($arr);
                  $achou = $arr[0][0];
                  $achou = explode("'", $achou);
                  $achou = $achou[0];
                  if ($achou)
                  return $achou;
                 */
                return 'Nq2IIMl?nom.~GJ&]wS,T7LMEvRz';
        }

        /**
         * Fun��o para retirar acentos e caracteres especiais
         * 	@access public
         * 	@param String palavra
         * 	@return String
         */
        function tiraAcento($palavra) {
                $string = str_replace(" ", '_', $palavra);
                $string = iconv('UTF-8', 'ASCII//IGNORE', $palavra);
                return $string;
        }

        /**
         * Fun��o para verificar quantos meses tem entre as datas
         * 	@access public
         * 	@param String $startDate - Data Inicial yyyy-mm-dd
         * 	@param String $endDate   - Data Final yyyy-mm-dd
         * 	@return String
         */
        function monthsBetween($startDate, $endDate) {
                $retval = "";

                // Assume YYYY-mm-dd - as is common MYSQL format
                $splitStart = explode('-', $startDate);
                $splitEnd = explode('-', $endDate);

                if (is_array($splitStart) && is_array($splitEnd)) {
                        $difYears = $splitEnd[0] - $splitStart[0];
                        $difMonths = $splitEnd[1] - $splitStart[1];
                        $difDays = $splitEnd[2] - $splitStart[2];

                        $retval = ($difDays > 0) ? $difMonths : $difMonths - 1;
                        $retval += $difYears * 12;
                }
                return $retval;
        }

        /**
         * Pesquisa recursivamente pelo(s) array em busca do valor
         * @param type $needle
         * @param type $haystack
         * @param type $retornaKeyArrayMulti
         * @return type
         */
        function array_search_recursive($needle, $haystack, $retornaKeyArrayMulti = false) {
                $path = array();
                foreach ($haystack as $id => $val) {
                        if ($val === $needle)
                                $path[] = $id;
                        else if (is_array($val)) {
                                $found = $this->array_search_recursive($needle, $val);
                                if (count($found) > 0) {
                                        $path[$id] = $found;
                                }
                        }
                }
                if ($retornaKeyArrayMulti)
                        return $path[$retornaKeyArrayMulti];
                else
                        return $path;
        }

        /**
         * Retorna a data em dias escrita
         * @param type $datafim
         * @param type $dataini
         * @return type
         */
        function dias($datafim, $dataini = false) {
                if (!$dataini)
                        $dataini = @date("Y-m-d");

                //echo "<b>Data: ".$dataini." - ".$datafim;	

                $datafim = explode("-", $datafim);
                $dataini = explode("-", $dataini);

                $ano = ($datafim[0] - $dataini[0]) * 365;
                $mes = ($datafim[1] - $dataini[1]) * 30;
                $dia = $datafim[2] - $dataini[2];

                if ($mes > 1)
                        $dia++;

                //echo " | ano: ".$ano." - mes: ".$mes." - dia: ".$dia." = ".($dia+$mes+$ano)."</b><br>";

                return $dia + $mes + $ano;
        }

        /**
         * Retorna um array para utilização em select IN a partir de um recordset adodb
         * @param type $rs
         * @param type $field
         * @return type
         */
        function getArrayIn($rs, $field) {
                $in = "";
                while (!$rs->EOF) {
                        $in.= $rs->Fields($field) . ",";
                        $rs->MoveNext();
                };

                $in = substr($in, 0, -1);
                return $in;
        }

        /**
         * Retorna um array a partir de um recordset adodb
         * @param type $rs
         * @param type $field
         * @return type
         */
        function getArraySelectDB($rs, $field) {
                $in = array();
                while (!$rs->EOF) {
                        $in[] = $rs->Fields($field);
                        $rs->MoveNext();
                };
                return $in;
        }

        /**
         * Calcula a diferença de várias maneira, conforme os dados de entrada
         * 
         * 
          "m" Minútos
          "H" Horas
          "h": Horas arredondada
          "D": Dias
          "d": Dias arredontados
         * 
         * 
         * @param date $data1 - Data final
         * @param date $data2 - Data Inicial
         * @param String $tipo - String com o tipo de retorno esperado
         * @return Real - Retorno conforme o tipo solicitado
         */
        function dateDiff($data1, $data2 = false, $tipo = "m") {
                if (!$data1)
                        $data1 = @date("Y-m-d h:i:s");

                for ($i = 1; $i <= 2; $i++) {
                        ${"dia" . $i} = substr(${"data" . $i}, 8, 2);
                        ${"mes" . $i} = substr(${"data" . $i}, 5, 2);
                        ${"ano" . $i} = substr(${"data" . $i}, 0, 4);
                        ${"horas" . $i} = substr(${"data" . $i}, 11, 2);
                        ${"minutos" . $i} = substr(${"data" . $i}, 14, 2);
                        ${"segundos" . $i} = substr(${"data" . $i}, 17, 2);
                }

                $segundos = mktime($horas2, $minutos2, $segundos2, $mes2, $dia2, $ano2) - mktime($horas1, $minutos1, $segundos1, $mes1, $dia1, $ano1);

                switch ($tipo) {
                        case "s": $difere = $segundos;
                                break;
                        case "m": $difere = $segundos / 60;
                                break;
                        case "H": $difere = $segundos / 3600;
                                break;
                        case "h": $difere = round($segundos / 3600);
                                break;
                        case "D": $difere = $segundos / 86400;
                                break;
                        case "d": $difere = round($segundos / 86400);
                                break;
                }

                return $difere;
        }

        /**
         * Adiciona / Retira dias de uma data
         * @param type $date
         * @param type $days
         * @return type
         */
        function add_days($date, $days) {
                $date = strtotime("+" . $days . " days", strtotime($date));
                return date("Y-m-d", $date);
        }

        /**
         * Retorna uma string formatada a partir de algum valor lógico
         * @param type $value
         * @return string
         */
        function getSimNaoTxt($value) {
                if (!$value)
                        return "Não";
                else
                        return "Sim";
        }

        /**
         * Format a date/time (seconds) as weeks, days, hours etc as needed
         *
         * Given an amount of time in seconds, returns string
         * formatted nicely as weeks, days, hours etc as needed
         *
         * @package core
         * @category time
         * @uses MINSECS
         * @uses HOURSECS
         * @uses DAYSECS
         * @uses YEARSECS
         * @param int $totalsecs Time in seconds
         * @param object $str Should be a time object
         * @return string A nicely formatted date/time string
         */
        function format_time($totalsecs, $str = NULL) {

                $totalsecs = abs($totalsecs);

                if (!$str) {  // Create the str structure the slow way
                        $str = new stdClass();
                        $str->day = "Dia";
                        $str->days = "Dias";
                        $str->hour = "Hora";
                        $str->hours = "Horas";
                        $str->min = "Min";
                        $str->mins = "Mins";
                        $str->sec = "Sec";
                        $str->secs = "Secs";
                        $str->year = "Ano";
                        $str->years = "Anos";
                }


                $years = floor($totalsecs / YEARSECS);
                $remainder = $totalsecs - ($years * YEARSECS);
                $days = floor($remainder / DAYSECS);
                $remainder = $totalsecs - ($days * DAYSECS);
                $hours = floor($remainder / HOURSECS);
                $remainder = $remainder - ($hours * HOURSECS);
                $mins = floor($remainder / MINSECS);
                $secs = $remainder - ($mins * MINSECS);

                $ss = ($secs == 1) ? $str->sec : $str->secs;
                $sm = ($mins == 1) ? $str->min : $str->mins;
                $sh = ($hours == 1) ? $str->hour : $str->hours;
                $sd = ($days == 1) ? $str->day : $str->days;
                $sy = ($years == 1) ? $str->year : $str->years;

                $oyears = '';
                $odays = '';
                $ohours = '';
                $omins = '';
                $osecs = '';

                if ($years)
                        $oyears = $years . ' ' . $sy;
                if ($days)
                        $odays = $days . ' ' . $sd;
                if ($hours)
                        $ohours = $hours . ' ' . $sh;
                if ($mins)
                        $omins = $mins . ' ' . $sm;
                if ($secs)
                        $osecs = $secs . ' ' . $ss;

                if ($years)
                        return trim($oyears . ' ' . $odays);
                if ($days)
                        return trim($odays . ' ' . $ohours);
                if ($hours)
                        return trim($ohours . ' ' . $omins);
                if ($mins)
                        return trim($omins . ' ' . $osecs);
                if ($secs)
                        return $osecs;
                return "Agora";
        }

}
