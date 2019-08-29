<?php
namespace Plugins\StatsModule;

const IDNAME = "stats";
const STATS_CRON_INTERVAL = 5;
const STATS_SQL_LIMIT = 10;

if (!defined('APP_VERSION'))
    die("Yo, what's up?");

/**
 * Install plugin
 * @param  $Plugin
 */
function install($Plugin = false)
{
    $prefix = TABLE_PREFIX;
    $tbAccounts = TABLE_PREFIX.TABLE_ACCOUNTS;
    $sql = "
          CREATE TABLE IF NOT EXISTS `{$prefix}stats` (
            `id` int(11) NOT NULL,
            `account_id` int(11) NOT NULL,
            `followers` int(11) DEFAULT NULL,
            `followings` int(11) DEFAULT NULL,
            `posts` int(11) DEFAULT NULL,
            `followers_diff` int(11) DEFAULT NULL,
            `followings_diff` int(11) DEFAULT NULL,
            `posts_diff` int(11) DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            `ig_data` text,
            `ok` int(1) DEFAULT '0'
          )
          ENGINE = InnoDB;


          CREATE TABLE IF NOT EXISTS `{$prefix}stats_settings` (
              `id` int(11) NOT NULL,
              `running` int(1) DEFAULT NULL,
              `last` int(11) DEFAULT NULL,
              `next` int(11) DEFAULT NULL,
              `offset` int(11) DEFAULT NULL,
              `hasmore` int(11) DEFAULT NULL
          )
          ENGINE=InnoDB;
          ALTER TABLE `{$prefix}stats_settings` ADD PRIMARY KEY (`id`);
          ALTER TABLE `{$prefix}stats_settings` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

          ALTER TABLE `{$prefix}stats`
            ADD PRIMARY KEY (`id`),
            ADD KEY `account_id` (`account_id`);
          ALTER TABLE `{$prefix}stats` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
          ALTER TABLE `{$prefix}stats` ADD CONSTRAINT `stats_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `{$tbAccounts}` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
          ";

    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

\Event::bind("plugin.install", __NAMESPACE__ . '\install');

/**
 * Uninstall plugin
 * @param  string $Plugin
 * @return void
 */
function uninstall($Plugin)
{
    if ($Plugin != IDNAME) {
        return;
    }
    $prefix = TABLE_PREFIX;
    $sql = "
        DROP TABLE IF EXISTS `{$prefix}stats`;
        DROP TABLE IF EXISTS `{$prefix}stats_settings`;
      ";
    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return true;
}
\Event::bind("plugin.remove", __NAMESPACE__ . '\uninstall');

/**
 * Add module option
 * @param  array $package_modules
 * @return void|string
 */
function add_module_option($package_modules)
{
    ?>
    <div class="mt-15">
        <label>
            <input type="checkbox"
                   class="checkbox"
                   name="modules[]" <?php // input name must be modules[] ?>
                   value="stats"
                <?= in_array("stats", $package_modules) ? "checked" : "" ?>>
                  <span>
                      <span class="icon unchecked">
                          <span class="mdi mdi-check"></span>
                      </span>
                      <?= __('Advanced Analytics') ?>
                  </span>
        </label>
    </div>
    <?php
}
\Event::bind("package.add_module_option", __NAMESPACE__ . '\add_module_option');



/**
 * Set route
 * @param  string $global_variable_name
 * @return void
 */
function route_maps($global_variable_name)
{
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);
    $GLOBALS[$global_variable_name]->map("GET|POST", "/e/".IDNAME."/[i:id]/?", [
        PLUGINS_PATH . "/". IDNAME ."/controllers/IndexController.php",
        __NAMESPACE__ . "\IndexController"
    ]);
}
\Event::bind("router.map", __NAMESPACE__ . '\route_maps');


/**
 * Add link in menu
 * @param  $Nav
 * @param  $AuthUser
 * @return void
 */
function navigation($Nav, $AuthUser)
{
    $idname = IDNAME;
    include __DIR__."/views/fragments/navigation.fragment.php";
}
\Event::bind("navigation.add_menu", __NAMESPACE__ . '\navigation');



/**
 * get Stats
 * @param  int $AccountId
 * @return void
 */
function cronStats($accountId = null)
{
    $log            = [];
    $tbAccounts     = TABLE_PREFIX.TABLE_ACCOUNTS;
    $tbUsers        = TABLE_PREFIX.TABLE_USERS;
    $tbStats        = TABLE_PREFIX."stats";
    $tbStatSettings = TABLE_PREFIX."stats_settings";
    $hourInteval    = STATS_CRON_INTERVAL;
    $limit          = STATS_SQL_LIMIT;
    $timestampInterval = (60 * 60) * $hourInteval;
    $now            = time();
    $firstRun       = false;
    $expriredDate   = date('Y-m-d', strtotime('-20 days')) . ' 00:00:00';
    $today          = date('Y-m-d') . ' 00:00:00';
    $whereAccountId = $accountId ? " AND A.id={$accountId} " : '';

    if ( ! $accountId)
    {
        //check schedule
        $schedule = \DB::table($tbStatSettings)->limit(1)->get();
        $schedule = isset($schedule[0])  && $schedule[0] ? $schedule[0] : false;

        if ( ! $schedule)
        {
            //first run
            $dataSchedule = [
                'running' => 1,
                'next'    => $now + $timestampInterval,
                'last'    => $now,
                'offset'  => 0,
                'hasmore' => 1,
            ];

            $resSchedule      = \DB::table($tbStatSettings)->insert($dataSchedule);
            $schedule         = \DB::table($tbStatSettings)->limit(1)->get();
            $schedule         = isset($schedule[0])  && $schedule[0] ? $schedule[0] : false;
            $firstRun         = true;
        }

        if ( ! $schedule)
        {
            return;
        }

        if (! $firstRun && ($now < $schedule->next && ! $schedule->hasmore))
        {
            //echo 'statistics not now! ';
            return;
        }

        if (! $firstRun && $schedule->running && ! $schedule->hasmore)
        {
            //check if is time for the next run, but for some reason schedule is marked as running yet.
            if ($schedule->last && ($schedule->last + $timestampInterval) <= $now)
            {
                //echo 'statistics is running! ' . ($schedule->last + $timestampInterval);
                return;
            }
        }

        if ( ! $firstRun)
        {
            $dataSchedule = [
                'running' => 1,
                'next'    => $now + $timestampInterval,
                'last'    => $now,
                'offset'  => $schedule->offset + $limit,
                'hasmore' => 1,
            ];
            $resSchedule = \DB::table($tbStatSettings)->where('id', '=', $schedule->id)->update($dataSchedule);
        }
    }

    //get active accounts
    $offset = isset($schedule->offset) ? $schedule->offset : 0;

    $queryAccounts= "
          SELECT A.*, U.settings
          FROM  {$tbAccounts} A 
          INNER JOIN {$tbUsers} U ON U.id=A.user_id 
          WHERE A.login_required=0 AND U.is_active=1
            AND U.expire_date >='{$expriredDate}'
            {$whereAccountId}
          GROUP BY A.id 
          ORDER BY A.id ASC
          LIMIT {$offset}, {$limit}";

    $pdo = \DB::pdo();
    $stmt = $pdo->prepare($queryAccounts);
    $stmt->execute();
    $Accounts = $stmt->fetchAll();

    if (! $Accounts && isset($schedule)) {
        $dataSchedule = [
            'running' => 0,
            'offset'  => 0,
            'hasmore' => 0,
        ];
        $resSchedule = \DB::table($tbStatSettings)->where('id', '=', $schedule->id)->update($dataSchedule);
        return;
    }


    foreach ($Accounts as $a)
    {
        //check if module is available in this account
        $settings = json_decode($a['settings']);
        if (!isset($settings->modules) || ! is_array($settings->modules) || !in_array(IDNAME, $settings->modules)) {
            continue;
        }

        $Account = \Controller::model("Account", $a['id']);
        if (! $Account || ! $Account->isAvailable() || $Account->get("login_required")) {
            continue;
        }

        // get last stats
        $id = $a['id'];
        $queryStats = "SELECT * FROM {$tbStats} WHERE account_id={$id} ORDER BY id DESC LIMIT 1";
        $pdo = \DB::pdo();
        $stmt = $pdo->prepare($queryStats);
        $stmt->execute();

        $Old = $stmt->fetchAll();
        $Old = isset($Old[0]) ? $Old[0] : null;

        $updateId = $Old ? $Old['id'] : null;
        $action   = $Old && (substr($Old['date'],0,10) == date('Y-m-d')) ? 'update' : 'insert';

        if ($Old && $action == 'update')
        {
            $dateLimit = date('Y-m-d') . ' 00:00:00';
            $queryStats = "SELECT * FROM {$tbStats} WHERE account_id={$id} AND date < '{$dateLimit}' ORDER BY id DESC LIMIT 1";
            $pdo = \DB::pdo();
            $stmt = $pdo->prepare($queryStats);
            $stmt->execute();
            $compareWith = $stmt->fetchAll();
            $compareWith = isset($compareWith[0]) ? $compareWith[0] : null;
        }
        else
        {
            $compareWith = $Old ? $Old : null;
        }

        //start..
        $igData = [
            'ok'                => false,
            'msg'               => '',
            'is_verified'       => '',
            'is_private'        => '',
            'profile_pic_url'   => '',
            'full_name'         =>  '',
            'follower_count'    => '',
            'media_count'       => '',
            'usertags_count'    => '',
            'following_count'   => '',
            'external_url'      => '',
            'external_lynx_url' => '',
            'biography'         => '',
            'feed'              => []
        ];

        try {
            $Instagram = \InstagramController::login($Account);
        } catch (\Exception $e) {
            continue;
        }

        try {
            $resIG = $Instagram->people->getSelfInfo();
        } catch (\Exception $e) {
            continue;
        }

        $igData = [
            'ok'                => true,
            'msg'               => '',
            'is_verified'       => $resIG->getUser()->getIsVerified(),
            'is_private'        => $resIG->getUser()->getIsPrivate(),
            'profile_pic_url'   => $resIG->getUser()->getProfilePicUrl(),
            'full_name'         => $resIG->getUser()->getFullName(),
            'follower_count'    => $resIG->getUser()->getFollowerCount(),
            'media_count'       => $resIG->getUser()->getMediaCount(),
            'usertags_count'    => $resIG->getUser()->getUsertagsCount(),
            'following_count'   => $resIG->getUser()->getFollowingCount(),
            'external_url'      => $resIG->getUser()->getExternalUrl(),
            'external_lynx_url' => $resIG->getUser()->getExternalLynxUrl(),
            'biography'         => $resIG->getUser()->getBiography(),
            'feed'              => []
        ];

        $medias = [];
        $resIG = null;
        try {
            $resIG = $Instagram->timeline->getSelfUserFeed();
        } catch (\Exception $e) {
            $igData['msg'] = $e->getMessage();
        }
        if ($resIG)
        {
            $items = $resIG->getItems();
            foreach($items as $k => $item)
            {
                $engagement = (int) $item->getLikeCount() + ( (int) $item->getViewCount() ) + ((int) $item->getCommentCount());
                if (! $engagement || ! $igData['follower_count'])
                {
                    $rate = 0;
                }
                else
                {
                    $rate = ($engagement / $igData['follower_count']) * 100;
                }
                $medias[] = [
                    'engagement' => $rate,
                    'media_id' => $item->getCode()
                ];
                if ($k >= 10)
                {
                    break;
                }
            }

            usort($medias, function($a, $b) {
                return $b['engagement'] - $a['engagement'];
            });
            $igData['feed'] = $medias;
        }

        $engagement = array_sum(array_column($igData['feed'], 'engagement'));

        if ($engagement && $igData['feed'])
        {
            $engagement = $engagement / sizeof($igData['feed']);
        }

        $igData['feed'] = array_slice($igData['feed'], 0, 3);

        $date = date('Y-m-d H:i:s');
        $info = [
            'pic'       => $igData['profile_pic_url'],
            'bio'       => $igData['biography'],
            'name'      => $igData['full_name'],
            'verified'  => $igData['is_verified'],
            'private'   => $igData['is_private'],
            'feed'      => $igData['feed'],
            'engagement'=> $engagement,
        ];

        if ($compareWith)
        {
            $data = [
                'account_id'      => $a['id'],
                'followers'       => $igData['follower_count'],
                'followings'      => $igData['following_count'],
                'posts'           => $igData['media_count'],
                'followers_diff'  => $igData['follower_count'] - $compareWith['followers'],
                'followings_diff' => $igData['following_count'] - $compareWith['followings'],
                'posts_diff'      => $igData['media_count'] - $compareWith['posts'],
                'date'            => $date,
                'ig_data'         => json_encode($info)
            ];

        }
        else
        {
            $data = [
                'account_id'      => $a['id'],
                'followers'       => $igData['follower_count'],
                'followings'      => $igData['following_count'],
                'posts'           => $igData['media_count'],
                'followers_diff'  => 0,
                'followings_diff' => 0,
                'posts_diff'      => 0,
                'date'            => $date,
                'ig_data'         => json_encode($info)
            ];
        }

        if ($action == 'update')
        {
            $res = \DB::table($tbStats)->where('id', '=', $updateId)->update($data);
        }
        else
        {
            $res = \DB::table($tbStats)->insert($data);
        }
    }

    if (!$accountId)
    {
        $dataSchedule = [
            'running' => 1,
            'offset'  => $schedule->offset + $limit,
            'hasmore' => 1,
        ];

        $resSchedule = \DB::table($tbStatSettings)->where('id', '=', $schedule->id)->update($dataSchedule);
    }

}
\Event::bind("stats.cron", __NAMESPACE__ . '\cronStats');
\Event::bind("cron.add", __NAMESPACE__ . '\cronStats');


/**
 * Get media thumb url from the Instagram feed item
 * @param  stdObject $item Instagram feed item
 * @return string|null
 */
function _get_media_thumb_ig_item($item)
{
    $media_thumb = null;

    $media_type = empty($item->getMediaType()) ? null : $item->getMediaType();

    if ($media_type == 1 || $media_type == 2) {
        // Photo (1) OR Video (2)
        $media_thumb = $item->getImageVersions2()->getCandidates()[0]->getUrl();
    } else if ($media_type == 8) {
        // ALbum
        $media_thumb = $item->getCarouselMedia()[0]->getImageVersions2()->getCandidates()[0]->getUrl();
    }

    return $media_thumb;
}
