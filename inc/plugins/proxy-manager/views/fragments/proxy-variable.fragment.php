<script type="text/javascript">
    <?php
    $proxies = [];

    foreach ($Proxies->getDataAs("Proxy") as $p) {
        $proxies[$p->get("proxy")] = $p->get("proxy");
    }
    ?>
    var proxies = <?= json_encode($proxies); ?>
</script>