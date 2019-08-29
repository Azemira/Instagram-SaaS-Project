<?php 
namespace Plugins\InstagramChatbot;
	/**
	 * AutoDimesChatBot Model
	 *
	 * @version 1.0
	 * @author Onelab <hello@onelab.co> 
	 * 
	 */
	
	class AutoDimesChatBotModel extends DataList
	{	
/**
	 * Initialize
	 */
	public function __construct()
	{
		$this->setQuery(\DB::table('np_chatbot_message_group'));
	}

	}
?>