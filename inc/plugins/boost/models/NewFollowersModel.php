<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * New Followers model
 *
 * @version 1.0
 * @author jonatanfroes@
 * 
 */
class NewFollowersModel extends \DataList
{	
	/**
	 * Initialize
	 */
	public function __construct()
	{
		$this->setQuery(\DB::table(TABLE_PREFIX."boost_new_followers"));
	}
  
  public function getBestSources($user_id, $account_id)
  {
    $tb = TABLE_PREFIX."boost_new_followers";
    $query = "
      SELECT {$tb}.target, {$tb}.target_value, COUNT(id) AS followers
      FROM {$tb}
      WHERE {$tb}.user_id={$user_id}
        AND {$tb}.account_id={$account_id}
      GROUP BY {$tb}.target, 
        {$tb}.target_value
      ORDER BY followers DESC";
    $res = \DB::query($query);
    return $res->get();
  }
}
