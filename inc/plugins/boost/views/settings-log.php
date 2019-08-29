<?php if (!defined('APP_VERSION')) die("Yo, what's up?");  ?>
<?php
    $direction = 'ltr';
    $ml = 'ml';
    $mr = 'mr';
    $left = 'left';
    $right = 'right';
    if(ACTIVE_LANG=='he-IL'){ 
        $direction = 'rtl';
        $ml = 'mr';
        $mr = 'ml';
        $left = 'right';
        $right = 'left';
    }
?>
<!DOCTYPE html>
<html lang="<?= ACTIVE_LANG ?>" dir="<?= $direction ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="theme-color" content="#fff">

        <meta name="description" content="<?= site_settings("site_description") ?>">
        <meta name="keywords" content="<?= site_settings("site_keywords") ?>">

        <link rel="icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">

        <?php if($direction=='ltr'){ ?>
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/plugins.css?v=". VERSION . "&" . date('l jS \of F Y h:i:s A') ?>">
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/core.css?v=". VERSION . "&" . date('l jS \of F Y h:i:s A') ?>">
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/".$idname."/assets/css/core.css?v=41".VERSION ?>">
        <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/plugins-rtl.css?v=". VERSION . "&" . date('l jS \of F Y h:i:s A') ?>">
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/core-rtl.css?v=". VERSION . "&" . date('l jS \of F Y h:i:s A') ?>">
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/".$idname."/assets/css/core-rtl.css?v=41".VERSION ?>">
        <style>body{text-align: right}</style>
        <?php } ?>  

        <title><?= __("Boost Module Settings - Log") ?></title>
    </head>

    <body>
        <?php 
            $Nav = new stdClass;
            $Nav->activeMenu = null;
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>

        <?php 
            $TopBar = new stdClass;
            $TopBar->title = __("Boost Module Settings");
            $TopBar->btn = false;
            require_once(APPPATH.'/views/fragments/topbar.fragment.php'); 
        ?>

        <?php require_once(__DIR__.'/fragments/settings-log.fragment.php'); ?>
        
        <script type="text/javascript" src="<?= APPURL."/assets/js/plugins.js?v=".VERSION ?>"></script>
        <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
        <script type="text/javascript" src="<?= APPURL."/assets/js/core.js?v=".VERSION ?>"></script>
         <script type="text/javascript" src="<?= APPURL."/assets/js/language.js?v=".VERSION  . "&" . date('l jS \of F Y h:i:s A') ?>"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/".$idname."/assets/js/core.js?v=41".VERSION ?>"></script>
        <script type="text/javascript" charset="utf-8">
            $(function(){
              Boost.showDebug();
            })
        </script>

        <!-- GOOGLE ANALYTICS -->
        <?php require_once(APPPATH.'/views/fragments/google-analytics.fragment.php'); ?>
    </body>
</html>