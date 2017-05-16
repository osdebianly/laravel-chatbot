<?php namespace Lyfing\LaravelChatBot\Servers;


use Lyfing\LaravelChatBot\Models\ChatBotData;


/**
 * Create a multple storage for "temp" data
 *
 * @author Henrique
 */
class Storage
{

	private $_data;
	private $_unique;


	/**
	 * Data constructor.
	 *
	 * @param $unique User to which information will be associated
	 */
	function __construct($unique)
	{
		$this->_unique = $unique;
	}

	/**
	 * Return all data for unique key
	 *
	 * @return array - data
	 * @return array|mixed
	 */
	public function Load()
	{
		$data = ChatBotData::where('unique', $this->_unique)->first();

		if ($data) {
			$this->_data = $data['data'];
		} else {
			$this->_data = array();
		}

		return $this->_data;
	}

	/**
	 * save all data for unique key
	 *
	 * @param $data
	 */
	public function Save($data)
	{
		$serializeData = base64_encode(serialize($data));
		$where = ['unique' => $this->_unique];
		ChatBotData::updateOrCreate($where, ['data' => $data]);
//		Connection::Query("
//			INSERT INTO data (`unique`, `data`)
//			VALUES ('" . $this->_unique . "', '" . $serializeData . "')
//			ON DUPLICATE KEY UPDATE
//			`unique`= VALUES(`unique`),
//			`data`	= VALUES(`data`)
//		");
		$this->_data = $data;
	}

	/**
	 * Clear all data storage for unique key
	 */
	public function Clear()
	{
		ChatBotData::where('unique', $this->_unique)->delete();
		//Connection::Query("DELETE FROM data WHERE 'unique' = '" . $this->_unique . "'");
		$this->_data = array();
	}

}