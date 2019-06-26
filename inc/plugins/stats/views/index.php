<?php if (!defined('APP_VERSION')) die("Yo, what's up?");  ?>
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

        <!-- Include custom CSS file for this module -->
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/" . $idname. "/assets/css/core.css?v=".VERSION ?>">
        <link rel="stylesheet" type="text/css" href="<?= PLUGINS_URL."/" . $idname. "/assets/js/switchery/dist/switchery.min.css?v=".VERSION ?>">

        <title><?= __("Advanced Analytics") ?></title>
    </head>

    <body class="">
      <div id="stats-preloading"><?=__('Loading')?></div>
        <?php 
            $Nav = new stdClass;
            $Nav->activeMenu = $idname;
            require_once(APPPATH.'/views/fragments/navigation.fragment.php');
        ?>

        <?php 
            $TopBar = new stdClass;
            $TopBar->title = __("Advanced Analytics");
            $TopBar->btn = false;
            require_once(APPPATH.'/views/fragments/topbar.fragment.php'); 
        ?>

        <?php require_once(__DIR__.'/fragments/index.fragment.php'); ?>
        
        <script type="text/javascript" src="<?= APPURL."/assets/js/plugins.js?v=".VERSION ?>"></script>
        <?php require_once(APPPATH.'/inc/js-locale.inc.php'); ?>
        <script type="text/javascript" src="<?= APPURL."/assets/js/core.js?v=".VERSION ?>"></script>

        <!-- Include custom JS file for this module -->
        <script type="text/javascript" charset="utf-8">
          var pluginUrl = '<?= $baseUrl; ?>';
          var accountId = '<?= $activeAccountId; ?>';
          <?php
              $jsListPlugins = '';
              foreach($plugins as $k => $v)
              {
                if ($v['ok'] && !$v['isCore'])
                {
                  $jsListPlugins .= "'{$k}',";
                }
              }
              $jsListPlugins = !$hasData ? "" : substr($jsListPlugins, 0,-1);
            ?>
          var pluginsDashboard = [<?= $jsListPlugins; ?>];
        </script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/" . $idname. "/assets/js/switchery/dist/switchery.min.js?v=".VERSION ?>"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/" . $idname. "/assets/js/countUp.min.js?v=".VERSION."&aux=".time() ?>"></script>
        <script type="text/javascript" src="<?= PLUGINS_URL."/" . $idname. "/assets/js/core.js?v=".VERSION."&aux=".time() ?>"></script>
        <script type="text/javascript" charset="utf-8">
          var numAnim;
          <?php if(isset($countPlugins) && $countPlugins) : foreach($countPlugins as $k => $v) : ?>
          try {
            numAnim = new CountUp("countAnimation-<?=$k?>", 0, <?=$v?>);
            if (!numAnim.error) {numAnim.start();}
          } catch(e) {}
          <?php endforeach; endif; ?>
            $(function(){
                StatsModule.go();
            });
          window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)',
            white:'rgb(255,255,255)'
          };
          
<?php 
  if ($statsData) :
      // Growing Evolution
      $label = [];
      $data = [];
      $date = new \DateTime();

    foreach($statsData as $d)
    {
        $label[] = '"' . $date->modify($d['dt'])->format($dateFormat) . '"';
        $data[] = $d['followers'];
    }
?>
          var configGrowingEvolution = {
            type: "line",
            data: {
                labels: [<?= implode(',', $label);?>],
                datasets: [{
                    label: "<?= __('Total Followers');?>",
                    data: [<?= implode(',', $data);?>],
                    fill: false,
                    backgroundColor: window.chartColors.purple,
                    borderColor: window.chartColors.purple,
                }]
            },
            options: {
              scales: {"yAxes": [{"ticks": {"beginAtZero": false}}]},
              responsive: true,
              maintainAspectRatio: false,
              legend: {
						    position: "top",
					    }, 
              tooltips: {
                  callbacks: {
                      label: function(tooltipItem, chart){
                          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                          return datasetLabel + ': ' + StatsModule.formatNumber(tooltipItem.yLabel, 0, '', '.');
                      }
                  }
              }
            }
        };
<?php
    //New Followers vs Followings
      $label = [];
      $data1 = [];
      $data2 = [];
      $date = new \DateTime();
    foreach($statsData as $d)
    {
        $label[] = '"' . $date->modify($d['dt'])->format($dateFormat) . '"';
        $data1[] = $d['followers_diff'];
        $data2[] = $d['followings_diff'];
    }
?>
          
          var configNewFollowersFollowings = {
        type: "line",
        data: {
            labels: [<?= implode(',', $label);?>],
            datasets: [{
                    label: "<?= __('Followers');?>",
                    data: [<?= implode(',', $data1);?>],
                    fill: false,
                    backgroundColor: window.chartColors.orange,
                    borderColor: window.chartColors.orange
                }, {
                    label: "<?= __('Followings');?>",
                    data: [<?= implode(',', $data2);?>],
                    fill: false,
                    backgroundColor: window.chartColors.white,
                    borderColor: window.chartColors.white
                }]
        },
        options: {
          scales: {"yAxes": [{"ticks": {"beginAtZero": false}}]},
          responsive: true,
          maintainAspectRatio: false,
          tooltips: {
              callbacks: {
                  label: function(tooltipItem, chart){
                      var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                      return datasetLabel + ': ' + StatsModule.formatNumber(tooltipItem.yLabel, 0, '', '.');
                  }
              }
          }
        }
      };
<?php
    //Total Followers vs Total Followings
      $label = [];
      $data1 = [];
      $data2 = [];
      $date = new \DateTime();
    foreach($statsData as $d)
    {
        $label[] = '"' . $date->modify($d['dt'])->format($dateFormat) . '"';
        $data1[] = $d['followers'];
        $data2[] = $d['followings'];
    }
?>
          var configNrFollowersFollowings = {
        type: "line",
        data: {
            labels: [<?= implode(',', $label);?>],
            datasets: [{
                    label: "<?= __('Followers');?>",
                    data: [<?= implode(',', $data1);?>],
                    fill: false,
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue
                }, {
                    label: "<?= __('Followings');?>",
                    data: [<?= implode(',', $data2);?>],
                    fill: false,
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red
                }]
        },
        options: {
          scales: {"yAxes": [{"ticks": {"beginAtZero": false}}]},
          responsive: true,
          maintainAspectRatio: false,
          tooltips: {
              callbacks: {
                  label: function(tooltipItem, chart){
                      var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                      return datasetLabel + ': ' + StatsModule.formatNumber(tooltipItem.yLabel, 0, '', '.');
                  }
              }
          }
        }
      };
<?php endif; ?>

          window.onload = function() {
            StatsModule.removeLoading();
<?php if ($statsData) { ?>
            var ctx1 = document.getElementById("statsNrFollowersGraphic").getContext('2d');
            var ctx2 = document.getElementById("statsFollowersFollowingsGraphic").getContext('2d');
            var ctx3 = document.getElementById("statsNrFollowersFollowingsGraphic").getContext('2d');
            window.statsAccountsGraphic = new Chart(ctx1, configGrowingEvolution);
            window.statsAccountsGrowing = new Chart(ctx2, configNewFollowersFollowings);
            window.statsAccountsGrowing = new Chart(ctx3, configNrFollowersFollowings);
<?php } ?>
          };

        </script>

        <!-- GOOGLE ANALYTICS -->
        <?php require_once(APPPATH.'/views/fragments/google-analytics.fragment.php'); ?>
    </body>
</html>