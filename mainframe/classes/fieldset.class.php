<?php

/**
 * Esta Classe prove uma API de Manipula��o do Banco de Dados porem ela necessita de que seja instanciada juntamente com ela
 *  o pacote ADOBD for PHP que pode ser baixado em:	http://adodb.sourceforge.net/
 *  
 * @author Augusto Weiand <guto.weiand@gmail.com>
 * @version 0.1
 * @access public
 * @name fieldset
 * @category FieldsetMAnipulate
 * @package fieldset
 */
class fieldset extends database {

        function getSelectDb($cod = false, $table, $key = 0, $data = "nome", $name = false, $rs = false, $enUtf8 = true, $extra = false) {
                $uti = new Utils();
                if ($rs)
                        $rs = $rs;
                else
                        $rs = parent::_get($table);

                if (!$name)
                        $name = "sel" . $table;

                if (!$extra) {
                        if (is_array($cod))
                                $extra = " style='width: 500px;' ";
                        else
                                $extra = " style='width: 200px;' ";
                }


                if (is_array($cod))
                        $str = "<select name='" . $name . "[]' id='" . $name . "' multiple='multiple' $extra>";
                else
                        $str = "<select name='" . $name . "' id='" . $name . "' $extra>";

                if (!$cod)
                        $str.= "<option selected='selected'>Selecione um Valor</option>";
                else
                        $str.= "<option>Selecione um Valor</option>";

                while (!$rs->EOF) {
                        if (is_array($data)) {
                                $value = "";
                                foreach ($data as $datas)
                                        $value.=$rs->Fields($datas) . " ";
                        } else
                                $value = $rs->Fields($data);

                        if ($enUtf8)
                                $value = utf8_encode($value);

                        if (is_array($cod)) {
                                if (parent::array_search_recursive($rs->fields($key), $cod))
                                        $str.="<option value='" . $rs->Fields($key) . "' selected='selected'>" . $value . "</option>";
                                else
                                        $str.="<option value='" . $rs->Fields($key) . "'>" . $value . "</option>";
                        } else {
                                if (($cod) && $cod == $rs->fields($key))
                                        $str.="<option value='" . $rs->Fields($key) . "' selected='selected'>" . $value . "</option>";
                                else
                                        $str.="<option value='" . $rs->Fields($key) . "'>" . $value . "</option>";
                        }
                        $rs->MoveNext();
                }

                $str.= "</select>";

                if (is_array($cod)) {
                        $str.="	<script type='text/javascript'>
						$(function(){
							$('#" . $name . "').multiselect({
								mixWidth:550,
								maxWidth:800,
								selectedList:5,
								show: ['slide', 500],
								hide: ['explode', 500],
								autoOpen: false
							}).multiselectfilter();
						});
					</script>";
                }

                return $str;
        }

        function getMultiselect($param, $rs = false) {
                $param = json_decode(json_encode($param), FALSE);

                if (!isset($param->key))
                        $param->key = 0;

                if (!isset($param->name))
                        $param->name = "sel" . $param->table;

                if (!isset($param->style))
                        $param->style = "width: 100px;";

                if (!isset($param->class))
                        $param->class = "";

                if (!isset($param->data))
                        $param->data = "nome";

                if (!isset($param->searchclass))
                        $param->searchclass = "dataCloud";

                if (!isset($param->getJsonDB))
                        $param->getJsonDB = "usuario/getJsonAlunos";

                if (!isset($param->extraparam))
                        $param->extraparam = "";

                if (!isset($param->min))
                        $param->min = 4;

                if (!isset($param->theme))
                        $param->theme = "theme: 'facebook',";
                else
                        $param->theme = "theme: '$param->theme',";

                $str = "<input type='text' name='$param->name' id='$param->name' style='$param->style' class='$param->class' />
            	<script type='text/javascript'>
                    $(function(){
                        $('#$param->name').tokenInput('/cead/admin2/act/$param->getJsonDB/$param->table.php?$param->extraparam', {
                            preventDuplicates: true,
                            queryParam: 'term',
                            $param->theme
                            minChars: $param->min,
                            hintText: 'Procure aqui... :)',
                            noResultsText: ':( não encontramos nada parecido...',
                            searchingText: 'Procurando...',
                            resultsFormatter: function(item){ return \"<li>\" + \"<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>\" + item.value + \"</div><div class='email'>\" + item.email + \"</div></div></li>\" }
                ";

                if (isset($param->cod)) {
                        if (!is_array($param->cod))
                                $str.= ", tokenLimit: 1";

                        $str.= ",
                    prePopulate: [ ";

                        if (is_array($param->cod)) {
                                foreach ($param->cod as $arrdata) {
                                        $cl = new $param->searchclass();
                                        $rs = $cl->_get($param->table, "$param->key = $arrdata");

                                        if (is_array($param->data)) {
                                                $value = "";
                                                foreach ($param->data as $datas)
                                                        $value.= $rs->Fields($datas) . " ";
                                        } else {
                                                $value = $rs->Fields($param->data);
                                        }

                                        if (isset($param->utf8) && $param->utf8 == true)
                                                $str.= "{ 'id' : '" . $rs->Fields($param->key) . "', 'name' : '" . utf8_decode($value) . "' }, ";
                                        else
                                                $str.= "{ 'id' : '" . $rs->Fields($param->key) . "', 'name' : '$value' }, ";
                                }
                        } else {
                                $cl = new $param->searchclass();
                                $rs = $cl->_get($param->table, "$param->key = $param->cod");

                                if (is_array($param->data)) {
                                        $value = "";
                                        foreach ($param->data as $datas)
                                                $value.= $rs->Fields($datas) . " ";
                                } else {
                                        $value = $rs->Fields($param->data);
                                }

                                if (isset($param->utf8) && $param->utf8 == true)
                                        $str.= "{ 'id' : '" . $rs->Fields($param->key) . "', 'name' : '" . utf8_decode($value) . "' } ";
                                else
                                        $str.= "{ 'id' : '" . $rs->Fields($param->key) . "', 'name' : '$value' } ";
                        }

                        $str.= " ]";
                } else {
                        $str.= ", tokenLimit: 1";
                }

                $str.="         });
                     });
                </script>";
                return $str;
        }

}

