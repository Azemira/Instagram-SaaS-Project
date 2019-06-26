<?php
    if (!defined('APP_VERSION')) {
        die("Yo, what's up?");
    }

    function getActiveTab($source, $destination) {
        $return = null;
        $source = explode("\\", $source);
        $source = end($source);

        if($source === $destination) {
            $return = "class=\"active\"";
        }

        return $return;
    }
?>
<div class="arp-tab-heads clearfix">
    <a href="<?= APPURL."/e/".$idname."/".$Proxy->get("id") ?>" <?= getActiveTab($controllerName, "ProxyController") ?>><?= __("Proxy Settings") ?></a>
    <a href="<?= APPURL."/e/".$idname."/".$Proxy->get("id")."/log" ?>" <?= getActiveTab($controllerName, "LogController") ?>><?= __("Activity Log") ?></a>
</div>