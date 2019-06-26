<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION'))
    die("Yo, what's up?");

/**
 * Logs Model
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class LogsModel extends \DataList
{
    /**
     * Initialize
     */
    public function __construct()
    {
        $this->setQuery(\DB::table(TABLE_PREFIX."proxy_manager_log"));
    }
}