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
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/" . $idname. "/assets/js/switchery/dist/switchery.min.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/" . $idname. "/assets/js/steps/jquery.steps.css?v=".VERSION ?>">

        <title><?= htmlchars($Account->get("username")) . " - " . __("Boost") ?></title>
        <script type="text/javascript">
          var boostPath = '<?=PLUGINS_URL."/" . $idname. "/"; ?>';
          var boostUrl  = '<?=APPURL . "/e/" . $idname. "/"; ?>';
          var boostVersion = '<?= $GLOBALS['_PLUGINS_']['boost']['config']['version']; ?>';
      </script>
    </head>

    <body>
        <?php 
            $Nav = new stdClass;
            $Nav->activeMenu = $idname;
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>

        <?php 
            $TopBar = new stdClass;
            $TopBar->title = htmlchars($Account->get("username"));
            $TopBar->btn = false;
            require_once(APPPATH.'/views/fragments/topbar.fragment.php'); 
        ?>

         <?php
            if (strpos($_SERVER['REQUEST_URI'], "wizard") == false && !$Settings->get("data.wizard"))
            {
              require_once(__DIR__.'/fragments/schedule.fragment.php');
            } else {
              require_once(__DIR__.'/fragments/wizard.fragment.php');
            }
        ?>
        
        <script type="text/javascript" src="<?= APPURL."/assets/js/plugins.js?v=".VERSION ?>"></script>
        <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
        <script type="text/javascript" src="<?= APPURL."/assets/js/core.js?v=".VERSION ?>"></script>
         <script type="text/javascript" src="<?= APPURL."/assets/js/language.js?v=".VERSION  . "&" . date('l jS \of F Y h:i:s A') ?>"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/" . $idname. "/assets/js/switchery/dist/switchery.min.js?v=".VERSION ?>"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/".$idname."/assets/js/core.js" ?>"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/".$idname."/assets/js/steps/jquery.steps.js?a=v=41".VERSION ?>"></script>
        <script type="text/javascript" charset="utf-8">
            Boost.in18 = {
              searching : '<?= __("Searching... wait"); ?>',
              no_result : '<?= __("No result found"); ?>',
              copy_success : '<?= __("Targets copied successfuly."); ?>',
            }
            $(function(){
              Boost.Index();
              Boost.ScheduleForm();
              Boost.CommentsForm();
              Boost.MessagesForm();
            })
        </script>

        <!-- GOOGLE ANALYTICS -->
        <?php require_once(APPPATH.'/views/fragments/google-analytics.fragment.php'); ?>
    </body>
</html>