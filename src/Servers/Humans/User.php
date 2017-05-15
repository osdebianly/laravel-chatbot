<?php namespace Lyfing\ChatBot\Servers\Humans;

use Lyfing\ChatBot\Servers\Humans\Human;

class User extends Human
{
	public function __construct($chatbot, $unique)
	{
		parent::__construct($chatbot, $unique, "user");
	}

}