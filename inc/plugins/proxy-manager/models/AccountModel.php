<?php
namespace Plugins\ProxyManager;

// Disable direct access
if (!defined('APP_VERSION'))
    die("Yo, what's up?");

/**
 * PM Proxies Model
 *
 * @author Nextpass <mail@nextpass.io>
 * @website https://nextpass.io
 *
 */
class AccountModel extends \DataEntry
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
            $col = "username";
        }

        if ($col) {
            $query = \DB::table(TABLE_PREFIX.TABLE_ACCOUNTS)
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
            "user_id" => 0,
            "instagram_id" => "",
            "username" => "instagram_".uniqid(),
            "password" => uniqid(),
            "proxy" => "",
            "login_required" => 0,
            "last_login" => date("Y-m-d H:i:s"),
            "date" => date("Y-m-d H:i:s"),
            "proxy_added_by_user" => 0
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

        $id = \DB::table(TABLE_PREFIX.TABLE_ACCOUNTS)
            ->insert(array(
                "id" => null,
                "user_id" => $this->get("user_id"),
                "instagram_id" => $this->get("instagram_id"),
                "username" => $this->get("username"),
                "password" => $this->get("password"),
                "proxy" => $this->get("proxy"),
                "login_required" => $this->get("login_required"),
                "last_login" => $this->get("last_login"),
                "date" => $this->get("date"),
                "proxy_added_by_user" => $this->get("proxy_added_by_user")
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

        $id = \DB::table(TABLE_PREFIX.TABLE_ACCOUNTS)
            ->where("id", "=", $this->get("id"))
            ->update(array(
                "user_id" => $this->get("user_id"),
                "instagram_id" => $this->get("instagram_id"),
                "username" => $this->get("username"),
                "password" => $this->get("password"),
                "proxy" => $this->get("proxy"),
                "login_required" => $this->get("login_required"),
                "last_login" => $this->get("last_login"),
                "date" => $this->get("date"),
                "proxy_added_by_user" => $this->get("proxy_added_by_user")
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

        \DB::table(TABLE_PREFIX.TABLE_ACCOUNTS)->where("id", "=", $this->get("id"))->delete();
        $this->is_available = false;
        return true;
    }
}
?>