<?php
    $Nav = new stdClass;
    $Nav->activeMenu = $idname;
    require_once(APPPATH . '/views/fragments/navigation.fragment.php');
?>

<?php
    $TopBar = new stdClass;
    $TopBar->title = __("Proxies");
    $TopBar->btn = [
        array (
            "icon" => "mdi mdi-server-security",
            "title" => __("Add new"),
            "link" => APPURL."/e/".$idname."/new"
        ),
        array (
            "icon" => "mdi mdi-account",
            "title" => __("Assign Proxy"),
            "link" => APPURL."/e/".$idname."/users"
        ),
        array (
            "icon" => "mdi mdi-upload",
            "title" => __("Bulk Upload"),
            "link" => APPURL."/e/".$idname."/upload"
        )
    ];
    require_once(__DIR__ . '/topbar.fragment.php');
?>