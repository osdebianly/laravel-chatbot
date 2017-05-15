<?php namespace Lyfing\ChatBot\Servers\Humans;


//require_once dirname(__FILE__) . "/../Database/Connection.php";

use Lyfing\ChatBot\Models\ChatBotProperty;

class Human
{
	protected $_chatbot;
	protected $_unique;
	protected $_type;

	private $_props = array();

	/**
	 * Human constructor.
	 *
	 * @param $chatbot
	 * @param $unique
	 * @param $type
	 */
	function __construct($chatbot, $unique, $type)
	{

		$this->_chatbot = $chatbot;
		$this->_unique = $unique;
		$this->_type = $type;

		// Load all properties
		$this->loadAllProps();

		//LOG && print "\n" . $type . " ";
		logger($this->_props);
		//LOG && print "\n";


	}

	/**
	 * Get unique key
	 */
	public function getUnique()
	{
		return $this->_unique;
	}

	/**
	 * Return property by name
	 *
	 * @param $name
	 *
	 * @return mixed|string
	 */
	public function getProp($name)
	{


		if (array_key_exists($name, $this->_props)) {
			return $this->_props[$name];
		} else {
			if ($this->_type == "bot") {
				$info = $this->_chatbot->getConfig()->botInfo;
			} else {
				$info = $this->_chatbot->getConfig()->userInfo;
			}
			if (array_key_exists($name, $info)) {
				return $info[$name];
			} else {
				return "";
			}
		}
	}

	/**
	 * Create property, if exist, override
	 *
	 * @param string $name
	 * @param string $value
	 */
	public function setProp($name, $value)
	{
		// save prop in db
		$this->_props[$name] = $value;
	}

	/**
	 * Delete property
	 */
	public function delProp($name)
	{
		unset($this->_props[$name]);
	}


	/**
	 * Load properties in DB
	 */
	public function loadAllProps()
	{
		// clear
		$this->_props = array();
		// load data

		$arrData = ChatBotProperty::where([
				'unique' => $this->_unique,
				'type'   => $this->_type]
		)->get()->toArray();

		//$arrData = Connection::Fetch("SELECT * FROM `property` WHERE `unique` = '{$this->_unique}' AND `type` = '{$this->_type}'");
		foreach ($arrData as $data) {
			$this->_props[$data['name']] = $data['value'];
		}
	}

	/**
	 * Update prop in DB
	 */
	public function saveAllProps()
	{
		// clear all prop
		$this->clearAllProps();

		// save all prop in DB
		foreach ($this->_props as $name => $value) {
			ChatBotProperty::create([
				'unique' => $this->_unique,
				'type'   => $this->_type,
				'name'   => $name,
				'value'  => $value
			]);
			//Connection::Query("INSERT INTO `property` VALUES ('{$this->_unique}', '{$this->_type}', '{$name}', '{$value}')");
		}
		//
	}

	/**
	 * Delete all properties
	 */
	public function clearAllProps()
	{
		// delete all prop in DB
		ChatBotProperty::where([
			'unique' => $this->_unique,
			'type'   => $this->_type
		])->delete();
		//Connection::Query("DELETE from `property` WHERE `unique` = '{$this->_unique}' AND `type` = '{$this->_type}'");
	}

	public function __toString()
	{
		return $this->getUnique();
	}

}