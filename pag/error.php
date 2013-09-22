<?php
GLOBAL $CFG;
if (isset($_GET['id']) && $_GET['id'] == 403) {
        ?>
        <div style="margin: 0 auto; text-align: center;">
                <img src="<?= $CFG->www ?>/assets/imgs/easter_2.jpeg" />
                <p>
                        403 - Ops, houve algum erro...
                </p>
        </div>
<?php } else { ?>
        <div style="margin: 0 auto; text-align: center;">
                <img src="<?= $CFG->www ?>/assets/imgs/easter.jpeg" />
                <p>
                        404 - Ops, houve algum erro...
                </p>
        </div>
<?php
}
