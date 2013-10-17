<?php
require_once "mainframe/autoload.php";
GLOBAL $CFG;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="application-name" content="CEAD" /> 
        <meta name="author" content="Augusto Weiand <guto.weiand@gmail.com> | Deividi Schumacher Velho <deividivelho@gmail.com>" />
        <meta name="keywords" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos" />
        <meta property="og:title" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?= $CFG->www ?>"/>
        <meta property="og:image" content="<?= $CFG->www ?>assets/imgs/logo.jpeg"/>
        <meta property="og:site_name" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos"/>
        <meta property="og:description" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos"/>
        <meta name="title" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos" />
        <meta name="description" content="JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos" />
        <link rel="shortcut icon" type="image/x-icon" href="<?= $CFG->www ?>assets/imgs/favicon.ico" />
        <link rel="canonical" href="<?= $CFG->www ?>" />

        <title>JARBAS - Sistema de Gerenciamento de Eventos Acadêmicos</title>

        <?php require_once "mainframe/incs.php"; ?>

        <script type="text/javascript">
            $(function() {
                _browserCompativel();
            });
        </script>
    </head>
    <body>
        <div class="header row-fluid">
            <div class="center">
                <?php
                include "pag/header.php";
                ?>
            </div>    
        </div>

        <div class="row-fluid">
            <div class="center">
                <div class="content span">
                    <div class="row-fluid" style="margin-top: 10px; margin-bottom: 20px;">
                        <div class="span3" style="width: 20%; margin-top: -20px;">
                            <?php
                            include "pag/menu.php";
                            ?>
                        </div>
                        <div class="ui-menu ui-widget ui-widget-content ui-corner-all" style="float: right; width: 77%; padding: 10px; margin-top: -20px;">
                            <h4 style="text-align: center">Eventos em Destaque</h4>
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>

        <div class="footer row-fluid">
            <?php include "pag/footer.php" ?>
        </div>
    </body>
</html>
