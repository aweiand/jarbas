<?php
GLOBAL $CFG;
?>
<script>
    $(function() {
        $("#menu-common, #menu-adm").menu();
    });
</script>

<ul id="menu-common">
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'index.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>index.php">Home</a>
    </li>
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'todoseventos/eventos.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>pg/eventos/todoseventos/eventos.php">Eventos</a>
    </li>
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'gradedehorarios/horarios.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>pg/eventos/gradedehorarios/horarios.php">Grade de Horários</a>
    </li>                        
    <?php
    if (isset($_SESSION['usuid'])) {
        ?>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'emissaodecertificado/certificados.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/pessoas/emissaodecertificado/certificados.php">Emissão de Certificados</a>
        </li> 
    <?php } else { ?>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'home.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>home.php">Emissão de Certificados</a>
        </li> 
    <?php } ?>
</ul>

<?php
if (isset($_SESSION['usuid'])) {
    ?>
    <ul id="menu-adm" style="margin-top: 20px">
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'cadastroalteracao/comuns.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/cadastroalteracao/comuns.php">Cadastro / Alteração</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'vinculopapeiseventos/papeis.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/vinculopapeiseventos/papeis.php">Papéis / Eventos</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'vinculopessoaseventos/pessoas.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/vinculopessoaseventos/pessoas.php">Pessoas / Eventos</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'lancapresencas/presencas.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/lancapresencas/presencas.php">Presenças</a>
        </li>
        <li>
            <a href="<?= $CFG->www ?>mainframe/actions.php?action=logoff">Sair</a>
        </li>                    
    </ul>
    <?php
}