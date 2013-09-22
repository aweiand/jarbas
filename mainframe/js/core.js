/**
 * Função para imprimir mensagens na tela
 * 
 * @param {string} mens
 * @returns {undefined}
 */
function _message(mens) {
        alert(mens);
}
;

/**
 * Função que carrega um loader na tela
 * 
 * @param {integer} tipe 1 para exibir e 0 para esconder
 * @returns {undefined}
 */
function _load(tipe) {
        if (tipe) {
                if (!$(".ui-overlay").size()) {
                        var overlay = $('<div class="ui-overlay"  style="position: absolute; top: 0pt; left: 0pt; display: inline-block; overflow: hidden;"><img src=' + loader + ' /><div class="ui-widget-overlay" style="top: 0pt; left: 0pt; width: 9999px; height: 99999px;"></div></div>').hide().appendTo($('body'));
                        $(overlay).width('100%');
                        $(overlay).height('100%');
                        $(".ui-overlay img").position({
                                my: "center",
                                at: "center",
                                of: ".ui-overlay"
                        });
                        $(overlay).fadeIn();
                } else {
                        $(".ui-overlay").fadeIn();
                }
        } else {
                $(".ui-overlay").fadeOut(function() {
                        $(".ui-overlay").remove();
                });
        }
}

/**
 * Função para mostrar um loader
 * @param {type} text
 * @returns {undefined}
 */
function showLoad(text) {

        // < Altura
        if (document.documentElement.scrollHeight > document.documentElement.clientHeight) {
                var height = document.documentElement.scrollHeight + "px";
        }
        else {
                var height = document.documentElement.clientHeight + "px";
        }
        // > Altura END

        if (!document.getElementById('_fullscr')) {

                var div = document.createElement("div");
                div.id = '_fullscr';
                div.innerHTML = "&nbsp;";
                document.body.appendChild(div);

                $('#_fullscr').css({
                        left: '0px',
                        top: '0px',
                        width: '100%',
                        position: 'absolute',
                        zIndex: '1000',
                        display: 'none',
                        opacity: '0.80',
                        filters: 'alpha(opacity=80)',
                        MozOpacity: '0.80',
                        backgroundColor: '#000'
                });

        }
        $('#_fullscr').css({
                height: height
        });

        if (!document.getElementById('_window')) {

                var div = document.createElement("div");
                div.id = '_window';
                div.innerHTML = text;
                document.body.appendChild(div);

                $('#_window').css({
                        border: '3px solid #666666',
                        padding: '30px',
                        backgroundColor: '#FFF',
                        '-webkit-border-radius': '15px',
                        '-moz-border-radius': '15px',
                        color: '#000',
                        zIndex: '1001',
                        display: 'none',
                        fontFamily: 'Arial',
                        fontWeight: 'bold',
                        position: 'absolute'
                });

        }

        $('#_fullscr').fadeIn('fast',
                function() {
                        $("#_window").position({
                                at: "center center",
                                my: "center center",
                                of: $(document)
                        });
                        $('#_window').fadeIn('fast');
                }
        );

}

/**
 * Função genérica para efetuar post para actions
 * 
 * @param {array} data
 * @returns {integer}
 */
function _post(data) {
        _load(1);
        return $.ajax({
                url: action,
                type: 'post',
                data: data,
                async: false,
                success: function(response) {
                        _load(0);
                        return response;
                },
                error: function() {
                        return false;
                }
        });
}
;

/**
 * Função genérica para inserção de dados
 * 
 * @param {string} table
 * @param {array} dados
 * @param {string} field
 * @returns {Boolean}
 */
function _insrt(table, dados, field) {
        var data = {
                "action": "_insrtData",
                "table": table,
                "data": dados,
                "field": field
        };
        var result = _post(data);

        if (!result) {
                _message("Houve algum problema com a inserção!");
                return false;
        } else {
                return result.responseText;
        }
        ;
}
;

/**
 * Função genérica para atualização de dados
 * 
 * @param {string} table
 * @param {array} dados
 * @param {integer} id
 * @param {string} field
 * @returns {Boolean}
 */
function _updt(table, dados, id, field) {
        var data = {
                "action": "_updtData",
                "table": table,
                "data": dados,
                "id": id,
                "field": field
        };
        var result = _post(data);

        if (!result) {
                _message("Houve algum problema com a atualização!");
                return false;
        } else {
                _message("A atualização foi realizada com sucesso!");
                return true;
        }
        ;
}
;

/**
 * Função genérica para deleção de item
 * 
 * @param {string} table
 * @param {integer} id
 * @param {string} field
 * @param {string} obj
 * @returns {Boolean}
 */
function _del(table, id, field, obj) {
        var data = {
                "action": "_delData",
                "table": table,
                "id": id,
                "field": field
        };

        if (!$("#confirm-del").size())
                $('<div id="confirm-del">Você deseja deletar?</div>').appendTo('body');

        $("#confirm-del").dialog({
                modal: true,
                title: 'Confirma Ação?',
                zIndex: 10000,
                autoOpen: true,
                width: '200px',
                resizable: false,
                buttons: {
                        Sim: function() {
                                var result = _post(data);

                                if (!result) {
                                        _message("Houve algum problema com a deleção!");
                                        $("#confirm-del").remove();
                                } else {
                                        _message("A deleção foi realizada com sucesso!");
                                        $("#confirm-del").remove();
                                        if (obj != '') {
                                                var oTable = $('#lst-field-full').dataTable();
                                                oTable.fnDeleteRow($(obj).index());
                                        }
                                }
                                ;
                        },
                        Não: function() {
                                $("#confirm-del").dialog("close");
                        }
                }
        });
}
;

function tblShort(tbl) {
        $('#' + tbl).dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": true,
                "oLanguage": {
                        "sUrl": _dir() + "admin2/mainframe/plugins/jquery/DataTables-1.9.4/datatables.Portuguese.txt"
                },
                "bJQueryUI": false,
                "aLengthMenu": [
                        [10, 100, 200, 300, -1],
                        [10, 100, 200, 300, "Todos"]
                ]
        });
}

/**
 * Habilita edução avançada com tinymce no campo solicitado
 * @param {type} obj
 * @param {type} w
 * @param {type} h
 * @returns {undefined}
 */
function habilitaEdicaoMini(obj, w, h) {
        if (w == '')
                w = 100;
        if (h == '')
                h = 100;

        $(obj).tinymce({
                // Location of TinyMCE script
                script_url: _dir() + 'tools/mainframe/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js',
                // General options
                theme: "advanced",
                language: "pt",
                relative_urls: false,
                plugins: "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,spellchecker",
                // Theme options
                theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "pastetext,pasteword,|,link,unlink,image,jbimages,code,|,absolute,|,tablecontrols",
                theme_advanced_buttons3: "hr,visualaid,|,sub,sup,|,charmap,|,fullscreen,spellchecker,|,styleprops,|,forecolor,backcolor,",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
                file_browser_callback: 'myFileBrowser',
                theme_advanced_resize_horizontal: true,
                width: w,
                height: h
        });
}

/**
 * Habilita edução avançada com tinymce no campo solicitado
 * @param {type} obj
 * @param {type} w
 * @param {type} h
 * @returns {undefined}
 */
function habilitaEdicao(obj, w, h) {
        if (w == '')
                w = 200;
        if (h == '')
                h = 200;

        $(obj).tinymce({
                // Location of TinyMCE script
                script_url: _dir() + 'tools/mainframe/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js',
                // General options
                theme: "advanced",
                language: "pt",
                relative_urls: false,
                plugins: "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist,spellchecker",
                // Theme options
                theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor",
                theme_advanced_buttons2: "pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,image,jbimages,cleanup,help,code,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
                file_browser_callback: 'myFileBrowser',
                theme_advanced_resize_horizontal: true,
                width: w,
                height: h
        });
}

/**
 * Retorna um novo ID para o campo da tabela solicitada
 * @param {type} table
 * @param {type} campo
 * @returns {unresolved}
 */
function seed(table, campo) {
        _load(1);
        var request = $.ajax({
                url: action,
                type: "POST",
                async: false,
                data: {
                        "action": "seed",
                        "table": table,
                        "campo": campo
                },
                success: function(result) {
                        _load(0);
                        return result;
                }
        });
        return request.responseText;
}

/**
 * Retorna true se a variável é inteira
 * @param {type} mixed_var
 * @returns {Boolean|Number}
 */
function is_int(mixed_var) {
        return mixed_var === +mixed_var && isFinite(mixed_var) && !(mixed_var % 1);
}