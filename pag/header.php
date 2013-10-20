<?php
GLOBAL $CFG;
@session_start();
?>
<div class="imgTopo">
    <h2>JARBAS</h2>
    <h5>Sistema de gerenciamento de eventos acadêmicos</h5>
</div>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?= $CFG->www ?>index.php">Home</a> 
            <span class="divider">/</span>
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
                    echo "$u <span class='divider'>/</span>";
                } else {
                    echo str_replace("_", " ", $u);
                }

                echo "</li>";
            }
        }
        ?>
    </ul>
</div>