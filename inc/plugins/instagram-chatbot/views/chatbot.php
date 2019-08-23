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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">


        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/plugins.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= APPURL."/assets/css/core.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/instagram-chatbot/assets/css/core.css?v=12" ?>">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


        <title><?= __("Chatbot") ?></title>
    </head>

    <body>
    
        <?php 
               $Nav = new stdClass;
               $Nav->activeMenu = "instagram-chatbot";
               require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>

        <?php 
            $TopBar = new stdClass;
            $TopBar->title = __("Chatbot");
            $TopBar->btn = false;
            require_once(APPPATH.'/views/fragments/topbar.fragment.php'); 
        ?>
        <script type="text/javascript" src="<?= PLUGINS_URL."/instagram-chatbot/assets/js/core.js?v=12" ?>"></script>
        <script type="text/javascript" src="<?= APPURL."/assets/js/plugins.js?v=".VERSION ?>"></script>
        <script type="text/javascript" src="<?= APPURL."/assets/js/core.js?v=".VERSION ?>"></script>

        <?php require_once(__DIR__.'/fragments/chatbot.fragment.php'); ?>
        
        <script type="text/javascript" charset="utf-8">
            $(function(){
                InstagramChatboot.ScheduleForm();
            })
        </script>

        <!-- GOOGLE ANALYTICS -->
        <?php require_once(APPPATH.'/views/fragments/google-analytics.fragment.php'); ?>
    </body>
</html>
