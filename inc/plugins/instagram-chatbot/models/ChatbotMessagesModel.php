<?php 
namespace Plugins\InstagramChatbot;
	
	
	class ChatbotMessagesModel extends \DataList
	{	
/**
	 * Initialize
	 */
	public function __construct()
	{
		$this->setQuery(\DB::table('np_chatbot_messages'));
	}

	}
?>