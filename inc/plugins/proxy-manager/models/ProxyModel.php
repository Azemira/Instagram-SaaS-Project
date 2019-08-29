<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION'))
    die("Yo, what's up?");

/**
 * Proxy Model
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class ProxyModel extends \DataEntry
{
    /**
     * Extend parents constructor and select entry
     * @param mixed $uniqid Value of the unique identifier
     */
    public function __construct($uniqid=0)
    {
        parent::__construct();
        $this->select($uniqid);
    }



    /**
     * Select entry with uniqid
     * @param  int|string $uniqid Value of the any unique field
     * @return self
     */
    public function select($uniqid)
    {
        if (is_int($uniqid) || ctype_digit($uniqid)) {
            $col = $uniqid > 0 ? "id" : null;
        } else {
            $col = "proxy";
        }

        if ($col) {
            $query = \DB::table(TABLE_PREFIX.TABLE_PROXIES)
                ->where($col, "=", $uniqid)
                ->limit(1)
                ->select("*");
            if ($query->count() == 1) {
                $resp = $query->get();
                $r = $resp[0];

                foreach ($r as $field => $value)
                    $this->set($field, $value);

                $this->is_available = true;
            } else {
                $this->data = array();
                $this->is_available = false;
            }
        }

        return $this;
    }


    /**
     * Extend default values
     * @return self
     */
    public function extendDefaults()
    {
        $defaults = array(
            "proxy" => 0,
            "country_code" => "",
            "use_count" => 0,
            "assign_count" => 0,
            "limit_usage" => 0,
            "package_id" => 0,
            "replace_proxy" => "",
        );


        foreach ($defaults as $field => $value) {
            if (is_null($this->get($field)))
                $this->set($field, $value);
        }
    }


    /**
     * Insert Data as new entry
     */
    public function insert()
    {
        if ($this->isAvailable())
            return false;

        $this->extendDefaults();

        $id = \DB::table(TABLE_PREFIX.TABLE_PROXIES)
            ->insert(array(
                "id" => null,
                "proxy" => $this->get("proxy"),
                "country_code" => $this->get("country_code"),
                "use_count" => $this->get("use_count"),
                "assign_count" => $this->get("assign_count"),
                "limit_usage" => $this->get("limit_usage"),
                "package_id" => $this->get("package_id"),
                "replace_proxy" => $this->get("replace_proxy")
            ));

        $this->set("id", $id);
        $this->markAsAvailable();
        return $this->get("id");
    }


    /**
     * Update selected entry with Data
     */
    public function update()
    {
        if (!$this->isAvailable())
            return false;

        $this->extendDefaults();

        $id = \DB::table(TABLE_PREFIX.TABLE_PROXIES)
            ->where("id", "=", $this->get("id"))
            ->update(array(
                "proxy" => $this->get("proxy"),
                "country_code" => $this->get("country_code"),
                "use_count" => $this->get("use_count"),
                "assign_count" => $this->get("assign_count"),
                "limit_usage" => $this->get("limit_usage"),
                "package_id" => $this->get("package_id"),
                "replace_proxy" => $this->get("replace_proxy")
            ));

        return $this;
    }


    /**
     * Remove selected entry from database
     */
    public function delete()
    {
        if(!$this->isAvailable())
            return false;

        \DB::table(TABLE_PREFIX.TABLE_PROXIES)->where("id", "=", $this->get("id"))->delete();
        $this->is_available = false;
        return true;
    }
}
?>