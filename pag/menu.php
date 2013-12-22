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
    <li <?php if (strpos($_SERVER['REQUEST_URI'], 'emissaodecertificado/Emissao_de_Certificado.php')) echo 'class="ui-state-focus"' ?>>
        <a href="<?= $CFG->www ?>pg/pessoas/emissaodecertificado/Emissao_de_Certificado.php">Emissão de Certificados</a>
    </li> 
</ul>

<?php
if (isset($_SESSION['usuid']) && permite('Gerente')) {
    ?>
    <ul id="menu-adm" style="margin-top: 20px">
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'cadastroalteracao/Cadastros_e_Alteracoes.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/cadastroalteracao/Cadastros_e_Alteracoes.php">Cadastro / Alteração</a>
            <ul style="z-index: 9999;">
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getPessoas/Cadastro_e_Alteracao_de_Usuarios.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/pessoas/getPessoas/Cadastro_e_Alteracao_de_Usuarios.php'>Dados do Usuário</a>
                </li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getPapeis/Cadastro_e_Alteracao_de_Papeis.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/pessoas/getPapeis/Cadastro_e_Alteracao_de_Papeis.php'>Papéis</a>
                </li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getEventos/Cadastro_e_Alteracao_de_Eventos.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/eventos/getEventos/Cadastro_e_Alteracao_de_Eventos.php'>Eventos</a>
                </li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getTipos/Cadastro_e_Alteracao_de_Tipos.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/comuns/getTipos/Cadastro_e_Alteracao_de_Tipos.php'>Tipos</a>
                </li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getSalas/Cadastro_e_Alteracao_de_Salas.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/comuns/getSalas/Cadastro_e_Alteracao_de_Salas.php'>Salas</a>
                </li>
                <li <?php if (strpos($_SERVER['REQUEST_URI'], 'getSalas/Cadastro_e_Alteracao_de_Insituicoes.php')) echo 'class="ui-state-focus"' ?>>
                    <a href='<?= $CFG->www ?>pg/comuns/getInstituicoes/Cadastro_e_Alteracao_de_Insituicoes.php'>Instituições</a>
                </li>
            </ul>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'vinculopessoaseventos/Pessoas_e_Eventos.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/vinculopessoaseventos/Pessoas_e_Eventos.php">Pessoas / Eventos</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'lancapresencas/Digitando_Presencas.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/lancapresencas/Digitando_Presencas.php">Presenças</a>
        </li>
        <li <?php if (strpos($_SERVER['REQUEST_URI'], 'impressaodemateriais/Impressoes_de_Materiais.php')) echo 'class="ui-state-focus"' ?>>
            <a href="<?= $CFG->www ?>pg/comuns/impressaodemateriais/Impressoes_de_Materiais.php">Impressões</a>
        </li>        
        <li>
            <a href="<?= $CFG->www ?>mainframe/actions.php?action=logoff">Sair</a>
        </li>                    
    </ul>
    <?php
}