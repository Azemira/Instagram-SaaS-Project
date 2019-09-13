<?php 
/**
 * Accounts model
 *
 * @version 1.0
 * @author Onelab <hello@onelab.co> 
 * 
 */
class UsersChecksModel extends DataList
{	
	/**
	 * Initialize
	 */
	public function __construct()
	{
		$this->setQuery(DB::table("np_user_checks"));
	}
}
