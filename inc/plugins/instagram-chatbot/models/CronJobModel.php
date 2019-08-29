<?php 
namespace Plugins\InstagramChatbot;
	/**
	 * CronJobModel Model
	 *
	 * @version 1.0
	 * @author Onelab <hello@onelab.co> 
	 * 
	 */
	
	class CronJobModel extends \DataEntry
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
	    		$col = null;
	    	}

	    	if ($col) {
		    	$query = \DB::table(TABLE_PREFIX.'chatbot_cron_jobs')
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
	    		"title" => "title",
	    		"caption" => "",
	    		"date" => date("Y-m-d H:i:s")
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

	    	$id = \DB::table(TABLE_PREFIX.'chatbot_cron_jobs')
		    	->insert(array(
		    		"id" => null,
					"user_id" => $this->get("user_id"),
                    "account_id" => $this->get("account_id"),
                    "recipient_id" => $this->get("recipient_id"),
                    "thread_id" => $this->get("thread_id"),
                    "fast_speed" => $this->get("fast_speed"),
                    "messages" => $this->get("messages"),
                    "inbox_count" => $this->get("inbox_count"),
                    "sent_date" => $this->get("received_date"),
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

	    	$id = \DB::table(TABLE_PREFIX.'chatbot_cron_jobs')
	    		->where("id", "=", $this->get("id"))
		    	->update(array(
                    "sent_count" => $this->get("sent_count"),
                    "last_sent_id" => $this->get("last_sent_id"),
					"last_sent_index" => $this->get("last_sent_index"),
					"sent_date" => $this->get("sent_date"),
					"fast_speed" => $this->get("fast_speed"),
					"slow_speed" => $this->get("slow_speed"),
					"is_terminated" => $this->get("is_terminated"),
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

	    	DB::table(TABLE_PREFIX.TABLE_CAPTIONS)->where("id", "=", $this->get("id"))->delete();
	    	$this->is_available = false;
	    	return true;
	    }
	}
?>