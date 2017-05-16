<?php namespace Lyfing\LaravelChatBot\Servers\Humans;

use Lyfing\LaravelChatBot\Servers\Humans\Human;

class User extends Human
{
	public function __construct($chatbot, $unique)
	{
		parent::__construct($chatbot, $unique, "user");
	}

}