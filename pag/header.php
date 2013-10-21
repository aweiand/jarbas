<?php
GLOBAL $CFG;
@session_start();
?>
<div class="imgTopo">
    <h2>JARBAS</h2>
    <h5>Sistema de gerenciamento de eventos acadêmicos</h5>
</div>

<div class="center">
    <ul class="breadcrumb">
        <li>
            <a href="<?= $CFG->www ?>index.php">Home</a> 
            <span class="divider">></span>
        </li>
        <?php
        $url = explode("/", $_SERVER ['REQUEST_URI']);
        foreach ($url as $k => $u) {
            if (($u != 'jarbas') && ($u != 'pg') && ($u != '')) {
                if (strpos($u, ".")) {
                    $u = substr($u, 0, strpos($u, "."));
                }

                echo "<li class='active'>";

                if ($k != end(array_keys($url))) {
                    echo "$u <span class='divider'>></span>";
                } else {
                    echo str_replace("_", " ", $u);
                }

                echo "</li>";
            }
        }
        ?>
        <li class="pull-right">
            <?php
            if (!isset($_SESSION['usu'])) {
                echo "Olá Visitante - <a href='" . $CFG->www . "home.php'>Login</a>";
            } else {
                echo "Olá <a href='$CFG->www/pg/pessoas/meusdados/Meus_Dados.php' title='Meus dados'>
                        " . $_SESSION['usu'] . "</a>
                        <a href='$CFG->www/mainframe/actions.php?action=logoff' title='Sair'>
                            <i class='icon-off' style='color: red;'></i>
                          </a>";
            }
            ?>
        </li>
    </ul>
</div>