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
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'todoseventos/Eventos.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>pg/eventos/todoseventos/Eventos.php">Eventos</a>
    </li>
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'gradedehorarios/Grade_de_Horarios.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>pg/eventos/gradedehorarios/Grade_de_Horarios.php">Grade de Horários</a>
    </li>                        
    <?php
    if (isset($_SESSION['usuid'])) {
        ?>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'emissaodecertificado/Emissao_de_Certificado.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/pessoas/emissaodecertificado/Emissao_de_Certificado.php">Emissão de Certificados</a>
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
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'cadastroalteracao/Cadastros_e_Alteracoes.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/cadastroalteracao/Cadastros_e_Alteracoes.php">Cadastro / Alteração</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'vinculopapeiseventos/Papeis_e_Eventos.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/vinculopapeiseventos/Papeis_e_Eventos.php">Papéis / Eventos</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'vinculopessoaseventos/Pessoas_e_Eventos.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/vinculopessoaseventos/Pessoas_e_Eventos.php">Pessoas / Eventos</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'lancapresencas/Digitando_Presencas.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/lancapresencas/Digitando_Presencas.php">Presenças</a>
        </li>
        <li>
            <a href="<?= $CFG->www ?>mainframe/actions.php?action=logoff">Sair</a>
        </li>                    
    </ul>
    <?php
}