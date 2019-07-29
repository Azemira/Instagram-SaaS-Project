<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Target Model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */

class TargetModel extends \DataEntry
{	

	private $table;

	/**
	 * Extend parents constructor and select entry
	 * @param mixed $uniqid Value of the unique identifier
	 */
    public function __construct($uniqid=0)
    {
        parent::__construct();
        $this->table = TABLE_PREFIX."boost_targets";
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
    	$defaults = array(
    		"user_id"     => 0,
    		"account_id"  => 0,
    		"type"        => "",
    		"value"       => "",
    		"target_id"   => "",
    		"items"       => "[]",
        "data"        => "{}"
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

    	$id = \DB::table($this->table)
	    	->insert(array(
	    		"id"          => null,
          "user_id"     => $this->get("user_id"),
          "account_id"  => $this->get("account_id"),
          "type"        => $this->get("type"),
          "value"       => $this->get("value"),
          "target_id"   => $this->get("target_id"),
          "items"       => $this->get("items"),
          "data"        => $this->get("data"),
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

    	$id = \DB::table($this->table)
    		->where("id", "=", $this->get("id"))
	    	->update(array(
	    		"user_id"     => $this->get("user_id"),
          "account_id"  => $this->get("account_id"),
          "type"        => $this->get("type"),
          "value"       => $this->get("value"),
          "target_id"   => $this->get("target_id"),
          "items"       => $this->get("items"),
          "data"        => $this->get("data"),
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

    	\DB::table($this->table)->where("id", "=", $this->get("id"))->delete();
    	$this->is_available = false;
    	return true;
    }
}
