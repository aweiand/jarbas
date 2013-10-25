function pesquisaPessoa() {
    _load(1);
    if ($("#ui-tabs-1").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#pessoa").val();
    } else {
        $("#ui-tabs-1").load(_dir() + "jarbas/act/pessoas/getPessoas/pessoas.php?id=" + $("#pessoa").val(), {}, function() {
            _load(0);
        });
    }
}

function pesquisaRegra() {
    _load(1);
    if ($("#ui-tabs-2").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#regra").val();
    } else {
        $("#ui-tabs-2").load(_dir() + "jarbas/act/pessoas/getPapeis/papeis.php?id=" + $("#regra").val(), {}, function() {
            _load(0);
        });
    }
}

function pesquisaEventos() {
    _load(1);
    if ($("#ui-tabs-3").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#evento").val();
    } else {
        $("#ui-tabs-3").load(_dir() + "jarbas/act/eventos/getEventos/eventos.php?id=" + $("#evento").val(), {}, function() {
            _load(0);
        });
    }
}

function pesquisaTipo() {
    _load(1);
    if ($("#ui-tabs-4").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#tipo").val();
    } else {
        $("#ui-tabs-4").load(_dir() + "jarbas/act/comuns/getTipos/tipos.php?id=" + $("#tipo").val(), {}, function() {
            _load(0);
        });
    }
}

function pesquisaSala() {
    _load(1);
    if ($("#ui-tabs-5").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#sala").val();
    } else {
        $("#ui-tabs-5").load(_dir() + "jarbas/act/comuns/getSalas/salas.php?id=" + $("#sala").val(), {}, function() {
            _load(0);
        });
    }
}

function pesquisaInstituicao() {
    _load(1);
    if ($("#ui-tabs-6").size() == 0) {
        var url = window.location.href;
        if (url.indexOf("?") > -1) {
            url = url.substr(0, url.indexOf("?")).toLowerCase();
        }
        window.location = url + "?id=" + $("#instituicao").val();
    } else {
        $("#ui-tabs-6").load(_dir() + "jarbas/act/comuns/getInstituicoes/Cadastro_e_Alteracao_de_Insituicoes.php?id=" + $("#instituicao").val(), {}, function() {
            _load(0);
        });
    }
}

function recarregaPaginaEvnt() {
    var url = window.location.href;
    if (url.indexOf("?") > -1) {
        url = url.substr(0, url.indexOf("?")).toLowerCase();
    }
    window.location = url + "?evento=" + $("#evento :selected").val();
}

function vinculaPessoaEvento() {
    _load(1);

    var selectedOptions = $.map($('#pessoas :selected'),
            function(e) {
                return $(e).val();
            });
    var pessoas = selectedOptions.join(',');

    $.post(action, {
        "action": "matriculaEvento",
        "evento": $("#evento :selected").val(),
        "pessoas": pessoas,
        "regra": $("#regra :selected").val()
    }, function(result) {
        alert(result);
        if (result == "Oba!") {
            window.location.reload();
        }
        _load(0);
    });
}

function desvinculaPessoaEvento() {
    _load(1);

    var selectedOptions = $.map($('#pessoaEvento :selected'),
            function(e) {
                return $(e).val();
            });
    var pessoas = selectedOptions.join(',');

    $.post(action, {
        "action": "desMatriculaEvento",
        "evento": $("#evento :selected").val(),
        "pessoas": pessoas
    }, function(result) {
        alert(result);
        if (result == "Oba!") {
            window.location.reload();
        }
        _load(0);
    });
}

function inscreverNoEvento(pessoa, evento) {
    _load(1);
    $.post(action, {
        "action": "matriculaEvento",
        "pessoas": pessoa,
        "evento": evento,
        "regra": 8
    }, function(result) {
        alert(result);
        _load(1);
        window.location.reload();
    });
}