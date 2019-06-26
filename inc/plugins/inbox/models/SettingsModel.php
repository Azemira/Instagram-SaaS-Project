<?php 
namespace Plugins\Setup;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Settings Model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */

class SettingsModel extends \DataEntry
{	

	private $table;

	/**
	 * Extend parents constructor and select entry
	 * @param mixed $uniqid Value of the unique identifier
	 */
    public function __construct($uniqid=0)
    {
        parent::__construct();
        $this->table = TABLE_PREFIX."setup_settings";
        $this->select($uniqid=0);
    }



    /**
     * @return self       
     */
    public function select($uniqid=0)
    {      
      $query = \DB::table($this->table);
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
    	return $this;
    }


    /**
     * Extend default values
     * @return self
     */
    public function extendDefaults()
    {
    	$defaults = array(
          "data" => "{}",
          "info" => "{}"
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
	    	->insert([
          "data" => $this->get("data"),
          "info" => $this->get("info")
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
          "data" => $this->get("data"),
          "info" => $this->get("info")
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
