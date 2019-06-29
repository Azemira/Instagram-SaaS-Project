<!DOCTYPE html>
<html lang="<?= ACTIVE_LANG ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="theme-color" content="#fff">

        <meta name="description" content="<?= site_settings("site_description") ?>">
        <meta name="keywords" content="<?= site_settings("site_keywords") ?>">

        <link rel="icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">
        <link rel="shortcut icon" href="<?= site_settings("logomark") ? site_settings("logomark") : APPURL."/assets/img/logomark.png" ?>" type="image/x-icon">

        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/plugins.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/core.css?v=".VERSION ?>">

        <title><?= __("Chatbot") ?></title>
    </head>

    <body>
        <?php 
            $Nav = new stdClass;
            $Nav->activeMenu = "accounts";
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>
         <?php 
            $TopBar = new stdClass;
            $TopBar->title = __("CHATBOT");
            $TopBar->btn = false;
            require_once(APPPATH.'/views/fragments/topbar.fragment.php'); 
        ?>
            <div class="skeleton" id="chatbot">
                <div class="container-1200">
                    <div class="row clearfix">
                    
                        <div class="col s12 m12 l12 mt-30">
                            <section class="section">
                                CHATBOT
                            </section>
                        </div>
                    </div>
                </div> 
            </div>


        <?php require_once(APPPATH.'/views/fragments/google-analytics.fragment.php'); ?>
    </body>
</html>