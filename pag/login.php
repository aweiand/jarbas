<?php
GLOBAL $CFG;
?>
<div class="frm-login container ui-corner-all">
        <form class="form-signin" action="<?= $CFG->affix . $CFG->lib ?>/actions.php" method="POST">
                <h2 class="form-signin-heading">Bem Vindo! Faça seu Login.</h2>
                <div class="input-prepend">
                        <span class="add-on"><i class="icon-tag"></i></span>
                        <input class="input-block-level" name="username" type="text" placeholder="Login" value="<?= @$_COOKIE['lembrar'] ?>" required>
                </div>
                <br />
                <div class="input-prepend">
                        <span class="add-on"><i class="icon-barcode"></i></span>
                        <input class="input-block-level" name="pass" type="password" placeholder="Senha" required>
                </div>
                <label class="checkbox">
                        <input type="checkbox" name="lembrar" value="lembrar">
                        Lembrar-me
                </label>
                <div style="text-align: center; float: left; width: 50%">
                        <button class="btn btn-large btn-primary" type="submit">Login</button>
                </div>
                <div style="text-align: center; float: left; width: 50%">
                        <button class="btn btn-large btn-inverse" type="submit">Cadastre-se</button>
                </div>
        </form>
        <?php
        if (isset($_GET['action']) && ($_GET['action'] == 'erroLogin'))
                echo "  <div class='ui-state-error ui-corner-all frm-login-err ui-corner-all'>
                                        Você não foi Logado!
                                        <br />
                                        Por favor cheque suas credenciais de acesso.
                                        <br />
                                        <br />
                                </div>";

        if (isset($_GET['action']) && ($_GET['action'] == 'logOff'))
                echo "  <div class='ui-state-error ui-corner-all frm-login-err ui-corner-all'>
                                        Você foi deslogado...
                               </div>";
        ?>
</div>