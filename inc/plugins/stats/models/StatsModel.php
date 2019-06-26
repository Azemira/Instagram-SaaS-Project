<?php 
namespace Plugins\Stats;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");


class StatsModel extends \DataEntry
{	

	private $table;


    public function __construct($uniqid=0)
    {
        parent::__construct();
        $this->table = TABLE_PREFIX."stats";
    }
	
	public function accountStats($accountId = 0)
	{
		$sql = "SELECT {$this->table}.*,
							(
                (SELECT followers FROM `{$this->table}` WHERE account_id={$accountId} ORDER by id DESC LIMIT 1) - 
                (SELECT followers FROM `{$this->table}` WHERE account_id={$accountId} ORDER by id ASC LIMIT 1)
              ) AS diff_followers
                FROM `{$this->table}`
                WHERE account_id={$accountId} ORDER by id ASC LIMIT 1";

		$pdo = \DB::pdo();
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    
    
    $total = isset($res[0]['total_followers']) ? $res[0]['total_followers'] : 0;
    $min = isset($res[0]['min_followers']) ? $res[0]['min_followers'] : 0;

    return isset($res[0]) ? $res[0] : null;

	}
  
    
}
