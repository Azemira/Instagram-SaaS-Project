<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Schedule Model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */

class ScheduleModel extends \DataEntry
{	

	private $table;
  
  public $data2 = [];

	/**
	 * Extend parents constructor and select entry
	 * @param mixed $uniqid Value of the unique identifier
	 */
    public function __construct($uniqid=0, $select = true)
    {
        parent::__construct();
        $this->table = TABLE_PREFIX."boost_schedule";
        if($select) {
          $this->select($uniqid);
        }
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
	    		$this->data = [];
	    		$this->is_available = false;
	    	}
    	}
      $this->data2 = [];
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
    		"account_id" => 0,
    		"action_follow" => 0,
    		"action_unfollow" => 0,
    		"action_like" => 0,
    		"action_comment" => 0,
    		"action_welcomedm" => 0,
    		"action_repost" => 0,
    		"action_viewstory" => 0,
        "comments" => "[]",
        "dms" => "[]",
    		"follow_cicle" => 0,
        "target" => "[]",
        "gender" => "everyone",
        "ignore_private" => 0,
        "has_picture" => 1,
        "business" => "both",
        "items" => "[]",
        "blacklist" => "[]",
        "bad_words" => "",
        "whitelist" => "[]",
    		"unfollow_all" => false,
    		"keep_followers" => false,
    		"timeline_feed" => "",
    		"cicle_action" => "follow",
    		"cicle_follow" => "follow",
    		"cicle_count" => 0,
    		"follow_count" => 0,
    		"speed" => "auto",
            "daily_pause" => 0,
            "daily_pause_from" => "00:00:00",
            "daily_pause_to" => "00:00:00",
    		"is_active" => "0",
    		"schedule_date" => date("Y-m-d H:i:s"),
    		    "all_schedules" => "[]",
            "end_date" => date("Y-m-d H:i:s"),
    		"last_action_date" => date("Y-m-d H:i:s"),
        "running" => 0,
            "data" => "{}"
    	);


    	foreach ($defaults as $field => $value) {
    		if (is_null($this->get($field)))
    			$this->set($field, $value);
    	}
      $this->data2 = [];
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
	    		"id" => null,
          "user_id" => $this->get("user_id"),
          "account_id" => $this->get("account_id"),
          "action_follow" => $this->get("action_follow"),
          "action_unfollow" => $this->get("action_unfollow"),
          "action_like" => $this->get("action_like"),
          "action_comment" => $this->get("action_comment"),
          "action_welcomedm" => $this->get("action_welcomedm"),
          "action_repost" => $this->get("action_repost"),
          "action_viewstory" => $this->get("action_viewstory"),
          "comments" => $this->get("comments"),
          "dms" => $this->get("dms"),
          "follow_cicle" => $this->get("follow_cicle"),
          "target" => $this->get("target"),
          "gender" => $this->get("gender"),
          "ignore_private" => $this->get("ignore_private"),
          "has_picture" => $this->get("has_picture"),
          "business" => $this->get("business"),
          "items" => $this->get("items"),
          "blacklist" => $this->get("blacklist"),
          "bad_words" => $this->get("bad_words"),
          "whitelist" => $this->get("whitelist"),
          "unfollow_all" => $this->get("unfollow_all"),
          "keep_followers" => $this->get("keep_followers"),
          "timeline_feed" => $this->get("timeline_feed"),
          "cicle_action" => $this->get("cicle_action"),
      		"cicle_follow" => $this->get("cicle_follow"),
      		"cicle_count" => $this->get("cicle_count"),
      		"follow_count" => $this->get("follow_count"),
          "speed" => $this->get("speed"),
              "daily_pause" => $this->get("daily_pause"),
              "daily_pause_from" => $this->get("daily_pause_from"),
              "daily_pause_to" => $this->get("daily_pause_to"),
          "is_active" => $this->get("is_active"),
          "schedule_date" => $this->get("schedule_date"),
              "all_schedules" => $this->get("all_schedules"),
              "end_date" => $this->get("end_date"),
          "last_action_date" => $this->get("last_action_date"),
          "running" => $this->get("running"),
              "data" => $this->get("data"),
	    	));

    	$this->set("id", $id);
    	$this->markAsAvailable();
    	return $this->get("id");
    }


    /**
     * Update selected entry with Data
     */
    public function update($full = false)
    {
      
    	if (!$this->isAvailable())
    		return false;
      
      if($full) {
        $this->extendDefaults();
        $data = [
          "user_id"           => $this->get("user_id"),
          "account_id"        => $this->get("account_id"),
          "action_follow"     => $this->get("action_follow"),
          "action_unfollow"   => $this->get("action_unfollow"),
          "action_like"       => $this->get("action_like"),
          "action_comment"    => $this->get("action_comment"),
          "action_welcomedm"  => $this->get("action_welcomedm"),
          "action_repost"     => $this->get("action_repost"),
          "action_viewstory"  => $this->get("action_viewstory"),
          "comments"          => $this->get("comments"),
          "dms"               => $this->get("dms"),
          "follow_cicle"      => $this->get("follow_cicle"),
          "target"            => $this->get("target"),
          "gender"            => $this->get("gender"),
          "ignore_private"    => $this->get("ignore_private"),
          "has_picture"       => $this->get("has_picture"),
          "business"          => $this->get("business"),
          "items"             => $this->get("items"),
          "blacklist"         => $this->get("blacklist"),
          "bad_words"         => $this->get("bad_words"),
          "whitelist"         => $this->get("whitelist"),
          "unfollow_all"      => $this->get("unfollow_all"),
          "keep_followers"    => $this->get("keep_followers"),
          "timeline_feed"     => $this->get("timeline_feed"),
          "cicle_action"      => $this->get("cicle_action"),
      		"cicle_follow"      => $this->get("cicle_follow"),
      		"cicle_count"       => $this->get("cicle_count"),
      		"follow_count"      => $this->get("follow_count"),
          "speed"             => $this->get("speed"),
          "daily_pause"       => $this->get("daily_pause"),
          "daily_pause_from"  => $this->get("daily_pause_from"),
          "daily_pause_to"    => $this->get("daily_pause_to"),
          "is_active"         => $this->get("is_active"),
          "schedule_date"     => $this->get("schedule_date"),
          "all_schedules"     => $this->get("all_schedules"),
          "end_date"          => $this->get("end_date"),
          "last_action_date"  => $this->get("last_action_date"),
          "running"           => $this->get("running"),
          "data"              => $this->get("data")
        ];
        
        $id = \DB::table($this->table)
          ->where("id", "=", $this->get("id"))
          ->update($data);
        
      } else {
        $data = [];
        foreach($this->data2 as $k => $v) {
          $data[$k] = $v;
        }
        if($data) {
          $id = \DB::table($this->table)
          ->where("id", "=", $this->get("id"))
          ->update($data);
          
          $this->data2 = [];
        }
      }

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
  
  
		/**
		 * Set value for data field
		 * @param string $field Name of the data field
		 * @param mixed  $value Value of the given data field
		 * @param bool   $parse If true then treat $field as json field
		 */
		public function set($field, $value, $parse=true)
		{	
			if (is_string($field) && $field) {
				if($parse) {
					$fields = explode(".", $field);
				}

				if (!empty($fields) && count($fields) > 1) {
					$column = $fields[0];
					

					array_shift($fields);
					$total = count($fields);
					
					$newval = $value;
					for ($i = $total-1; $i >= 0 ; $i--) {
						$newval = array($fields[$i] => $newval);
					}

					$currentval = json_decode($this->get($column), true);
					if (!$currentval) {
						$currentval = array();
					}

					$this->data[$column] = json_encode(array_replace_recursive($currentval, $newval));
          $this->data2[$column] = $this->data[$column];
          
				} else {
					$this->data[$field] = $value;
          $this->data2[$field] = $value;
          
				}
			}

			return $this;
		}
  
		/**
		 * Update or insert
		 * @return mixed
		 */
		public function save($full = false)
		{
			return $this->isAvailable() ? $this->update($full) : $this->insert();
		}
  
  
  public function getTable()
  {
    return $this->table;
  }
  
}
