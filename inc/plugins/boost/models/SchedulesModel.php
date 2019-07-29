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
class SchedulesModel extends \DataList
{	
	/**
	 * Initialize
	 */
	public function __construct($setQuery = true)
	{
		$this->setQuery(\DB::table(TABLE_PREFIX."boost_schedule"));
	}
  
  /**
   * Request data from database
   * @return self
   */
  public function fetchData()
  {
      $this->paginate();
      $this->getQuery()->select(TABLE_PREFIX."boost_schedule.*");
      $this->data = $this->getQuery()->get();
      return $this;
  }

}
