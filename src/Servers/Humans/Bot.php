<?php namespace Lyfing\LaravelChatBot\Servers\Humans;

use Lyfing\LaravelChatBot\Servers\Humans\Human;

class Bot extends Human
{
	public function __construct($chatbot, $unique)
	{
		parent::__construct($chatbot, $unique, "bot");
	}
}
