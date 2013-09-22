<?php
GLOBAL $CFG;
?>
<div class="center">
    <ul class="nav nav-pills">
        <li class="active">
            <a href="<?= $CFG->affix ?>">Início</a>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="#">Eventos<b class="caret"></b></a>
            <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/eventos/getEventos/eventos.php">Visualizar</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/eventos/cadEventos/eventos.php">Cadastro</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/eventos/getInscritos/eventos.php">Inscritos</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Usuários<b class="caret"></b></a>
            <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/pessoas/getPessoas/pessoas.php">Sistema</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/pessoas/cadPessoas/pessoas.php">Cadastro</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Outros<b class="caret"></b></a>
            <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= $CFG->affix ?>pg/comuns/downloads/downloads.php">Downloads</a></li>
            </ul>
        </li>
        <li class="active pull-right">
            <a href="<?= $CFG->affix . $CFG->lib ?>actions.php?action=logoff" class="btn-danger" title="Sair">
                <i class="icon-off"></i>
            </a>
        </li>
    </ul>
</div>