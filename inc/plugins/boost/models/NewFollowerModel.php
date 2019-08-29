<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Log Model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */

class NewFollowerModel extends \DataEntry
{	

	private $table;

	/**
	 * Extend parents constructor and select entry
	 * @param mixed $uniqid Value of the unique identifier
	 */
    public function __construct($uniqid=0)
    {
        parent::__construct();
        $this->table = TABLE_PREFIX."boost_new_followers";
        $this->select($uniqid);
    }



    /**
     * Select entry with uniqid
     * @param  int|string $uniqid Value of the any unique field
     * @return self       
     */
    public function select($uniqid)
    {
		$where = [];
    	if (is_array($uniqid)) {
    		$where = $uniqid;	
    	} if (is_int($uniqid) || ctype_digit($uniqid)) {
    		if ($uniqid > 0) {
    			$where["id"] = $uniqid;
    		}
    	}

    	if ($where) {
	    	$query = \DB::table($this->table);

	    	foreach ($where as $k => $v) {
	    	    $query->where($k, "=", $v);
	    	}
		    	      
		    $query->limit(1)->select("*");
	    	if ($query->count() > 0) {
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
    	$defaults = [
    		"user_id" => 0,
    		"account_id" => 0,
        "action" => "unknow",
    		"user_pk" => "",
    		"username" => "",
    		"target" => "",
    		"target_value" => "",
    		"date" => date("Y-m-d H:i:s")
    	];


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

    	$id = \DB::table($this->table)
	    	->insert([
	    		"id"        => null,
	    		"user_id"   => $this->get("user_id"),
	    		"account_id"=> $this->get("account_id"),
            "action"        => $this->get("action"),
            "user_pk"       => $this->get("user_pk"),
            "username"      => $this->get("username"),
            "target"        => $this->get("target"),
            "target_value"  => $this->get("target_value"),
	    		"date"      => $this->get("date")
	    	]);

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

    	$id = \DB::table($this->table)
    		->where("id", "=", $this->get("id"))
	    	->update([
          "user_id"   => $this->get("user_id"),
	    		"account_id"=> $this->get("account_id"),
            "action"        => $this->get("action"),
            "user_pk"       => $this->get("user_pk"),
            "username"      => $this->get("username"),
            "target"        => $this->get("target"),
            "target_value"  => $this->get("target_value"),
	    		"date"      => $this->get("date")
	    	]);

    	return $this;
    }


    /**
	 * Remove selected entry from database
	 */
    public function delete()
    {
    	if(!$this->isAvailable())
    		return false;

    	\DB::table($this->table)->where("id", "=", $this->get("id"))->delete();
    	$this->is_available = false;
    	return true;
    }
}
