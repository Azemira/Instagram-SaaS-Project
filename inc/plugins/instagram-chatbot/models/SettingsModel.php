<?php 
namespace Plugins\InstagramChatbot;
	
	
	class SettingsModel extends \DataList
	{	
/**
	 * Initialize
	 */
	public function __construct()
	{
		$this->setQuery(\DB::table(TABLE_PREFIX.'chatbot_settings'));
	}

	}
?>