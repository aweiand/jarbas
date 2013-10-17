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
        if (isset($_SESSION['breadcrumb'])) {
            echo "<li>asdadasdsa</li>";
            $var = explode("##", $_SESSION['breadcrumb']);
            foreach ($var as $item) {
                echo "<li>
                            <a href='$CFW->www/{$item[1]}'>{$item[0]}</a>
                            <span class='divider'>/</span>
                        </li>";
            }
        }
        ?>
    </ul>
</div>