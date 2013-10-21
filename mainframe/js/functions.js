function pesquisaPessoa() {
    _load(1);
    $("#ui-tabs-1").load(_dir() + "jarbas/act/pessoas/getPessoas/pessoas.php?id=" + $("#pessoa").val(), {}, function() {
        _load(0);
    });
}

function pesquisaRegra() {
    _load(1);
    $("#ui-tabs-2").load(_dir() + "jarbas/act/pessoas/getPapeis/papeis.php?id=" + $("#regra").val(), {}, function() {
        _load(0);
    });
}

function pesquisaEventos() {
    _load(1);
    $("#ui-tabs-3").load(_dir() + "jarbas/act/eventos/getEventos/eventos.php?id=" + $("#evento").val(), {}, function() {
        _load(0);
    });
}

function pesquisaTipo() {
    _load(1);
    $("#ui-tabs-4").load(_dir() + "jarbas/act/comuns/getTipos/tipos.php?id=" + $("#tipo").val(), {}, function() {
        _load(0);
    });
}

function pesquisaSala() {
    _load(1);
    $("#ui-tabs-5").load(_dir() + "jarbas/act/comuns/getSalas/salas.php?id=" + $("#sala").val(), {}, function() {
        _load(0);
    });
}