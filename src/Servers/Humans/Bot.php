<?php namespace Lyfing\ChatBot\Servers\Humans;

use Lyfing\ChatBot\Servers\Humans\Human;

class Bot extends Human
{
	public function __construct($chatbot, $unique)
	{
		parent::__construct($chatbot, $unique, "bot");
	}
}
