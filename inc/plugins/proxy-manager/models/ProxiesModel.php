<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION'))
    die("Yo, what's up?");

/**
 * Proxies Model
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class ProxiesModel extends \DataList
{
    /**
     * ALL PACKAGE ID
     */
    const ALL_PACKAGE = -1;

    /**
     * Initialize
     */
    public function __construct()
    {
        $this->setQuery(\DB::table(TABLE_PREFIX.TABLE_PROXIES));
    }

    /**
     * Search proxy based on keywords
     *
     * @param $search_query
     * @return $this
     */
    public function search($search_query)
    {
        parent::search($search_query);
        $search_query = $this->getSearchQuery();

        if (!$search_query) {
            return $this;
        }

        $query = $this->getQuery();
        $search_strings = array_unique((explode(" ", $search_query)));
        foreach ($search_strings as $sq) {
            $sq = trim($sq);

            if (!$sq) {
                continue;
            }

            $query->where(function($q) use($sq) {
                $q->where(TABLE_PREFIX.TABLE_PROXIES.".proxy", "LIKE", $sq."%");
            });
        }

        return $this;
    }


    /**
     * Get best proxy according to country code
     * @param  array        $countries Array f ISO Aplha-2 Codes countries
     *                                 First value is main country
     * @param int           $package_id the package id
     * @return string|null             Proxy or null (if not found)
     */
    public static function getBestProxy($countries = [], $package_id = 0)
    {
        $proxy = null;

        $query = \DB::table(TABLE_PREFIX.TABLE_PROXIES);
        if ($countries) {
            $query->where("country_code", "=", $countries[0]);
        }

        $query->where("package_id", "=", $package_id);
        $query->where("assign_count", "<=", "limit_usage");
        $query->orderBy("assign_count","ASC")
            ->limit(1)
            ->select("*");
        $query = $query->getQuery()->getRawSql();
        $query = str_replace("'limit_usage'", "`limit_usage`", $query);
        $query = \DB::query($query);

        $resp = $query->get();

        if (count($resp) != 1 && count($countries) > 1) {
            // Not found country proxy
            // Select in neighbour countries
            $query = \DB::table(TABLE_PREFIX.TABLE_PROXIES);
            $query->where("package_id", "=", $package_id);
            $query->where("assign_count", "<=", "limit_usage");
            $query->whereIn("country_code", $countries);
            $query->orderBy("assign_count","ASC")
                ->limit(1)
                ->select("*");
            $query = $query->getQuery()->getRawSql();
            $query = str_replace("'limit_usage'", "`limit_usage`", $query);
            $query = \DB::query($query);

            $resp = $query->get();
        }

        if (count($resp) != 1) {
            // Still not found the proxy
            // Select randomly proxy by using package
            $query = \DB::table(TABLE_PREFIX.TABLE_PROXIES);
            $query->where("package_id", "=", $package_id);
            $query->where("assign_count", "<=", "limit_usage");
            $query->orderBy("assign_count","ASC")
                ->limit(1)
                ->select("*");
            $query = $query->getQuery()->getRawSql();
            $query = str_replace("'limit_usage'", "`limit_usage`", $query);
            $query = \DB::query($query);

            $resp = $query->get();
        }

        if (count($resp) != 1) {
            // Still not find the proxy by package
            // Select randomly proxy by using all package
            $query = \DB::table(TABLE_PREFIX.TABLE_PROXIES);
            $query->where("package_id", "=", self::ALL_PACKAGE);
            $query->where("assign_count", "<=", "limit_usage");
            $query->orderBy("assign_count","ASC")
                ->limit(1)
                ->select("*");
            $query = $query->getQuery()->getRawSql();
            $query = str_replace("'limit_usage'", "`limit_usage`", $query);
            $query = \DB::query($query);

            $resp = $query->get();
        }

        if (count($resp) == 1) {
            $r = $resp[0];


            if (isValidProxy($r->proxy)) {
                $proxy = $r->proxy;
            }
        }

        return $proxy;
    }
}
