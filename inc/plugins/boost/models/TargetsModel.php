<?php 
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Schedules model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */
class TargetsModel extends \DataList
{	
	/**
	 * Initialize
	 */
	public function __construct($setQuery = true)
	{
		$this->setQuery(\DB::table(TABLE_PREFIX."boost_targets"));
	}

}
