<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die;

/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class HelloWorldModelHelloWorld extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'HelloWorld', $prefix = 'HelloWorldTable', $config = array())
	{
		return JTable::getInstance($type,$prefix,$config);
	}

	/**
	 * Get the message
	 *
	 * @param   integer  $id  Greeting Id
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getMsg($id = 1)
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}

		if (!isset($this->messages[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			// Get a TableHelloWorld instance
			$table = $this->getTable();

			// Load the message
			$table->load($id);

			// Assign the message
			$this->messages[$id] = $table->greeting;
			$this->messages['contents'] = ".....................";
		}
		return $this->messages;

	}

	/**
	 * @return mixed
     */
	public function select(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('COUNT(*) AS '.$db->quoteName('NUM'))->from($db->quoteName('#__users','a'))->where($db->quoteName('a.username')."=".$db->quote('admin'));
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	/**
	 *@return mixed
     */
	public function update(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->update($db->quoteName('#__users','a'))->set($db->quoteName('a.username')."=".$db->quote('laratrvel'))->where($db->quoteName('a.username')."=".$db->quote('admin'));
		$db->setQuery($query);
		return $db->execute();
	}

	/**
	 *
     */
	public function insert(){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$columns = array('id','name','username','email','password','block','sendEmail','registerDate');
		$values = array(001,'Super User','admin','laratrvel',md5(131833),0,1,date("Y-m-d H:i:s"));
		for($i=1;$i<count($values);$i++){
			$values[$i] = $db->quote($values[$i]);
		}
		$query->insert($db->quoteName('#__users'),'a')->columns($db->quoteName($columns))->values(implode(',',$values));
		return $db->setQuery($query)->execute();
	}

	public function delete($username = ''){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__users'))->where($db->quoteName('#__users.username')."=".$db->quote($username));
		return  $db->setQuery($query)->execute();
	}
}
