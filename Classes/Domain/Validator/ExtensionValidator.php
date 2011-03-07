<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Rens Admiraal
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Schema for a whole extension
 *
 * @package ExtbaseKickstarter
 * @version $ID:$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_ExtbaseKickstarter_Domain_Validator_ExtensionValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

	/**
	 * Error Codes:
	 * 0 - 99: Errors concerning the Extension configuration
	 * 100 - 199: Errors concerning the Domain Objects directly
	 * 200 - 299: Errors concerning the Properties
	 */
	const	ERROR_EXTKEY_LENGTH			= 0,
		ERROR_EXTKEY_ILLEGAL_CHARACTERS	= 1,
		ERROR_EXTKEY_ILLEGAL_PREFIX		= 2,
		ERROR_EXTKEY_ILLEGAL_FIRST_CHARACTER	= 3,
		ERROR_DOMAINOBJECT_ILLEGAL_CHARACTER = 100,
		ERROR_DOMAINOBJECT_NO_NAME = 101,
		ERROR_DOMAINOBJECT_LOWER_FIRST_CHARACTER = 102,
		ERROR_DOMAINOBJECT_DUPLICATE = 103,
		ERROR_PROPERTY_NO_NAME = 200,
		ERROR_PROPERTY_DUPLICATE = 201,
		ERROR_PROPERTY_ILLEGAL_CHARACTER = 202,
		ERROR_PROPERTY_UPPER_FIRST_CHARACTER = 203,
		ERROR_PROPERTY_RESERVED_WORD = 204,
		ERROR_PLUGIN_DUPLICATE_KEY = 300,
		ERROR_PLUGIN_INVALID_KEY = 301,
		ERROR_BACKENDMODULE_DUPLICATE_KEY = 400,
		ERROR_BACKENDMODULE_INVALID_KEY = 401,
		EXTENSION_EXISTS_PIBASE = 500,
		EXTENSION_EXISTS_EXTBASE = 501;

			/**
	 * Reserved words by MySQL
	 * @var array
	 */
	static protected $reservedMYSQLWords = array(
		'ACCESSIBLE',
		'ADD',
		'ALL',
		'ALTER',
		'ANALYZE',
		'AND',
		'AS',
		'ASC',
		'ASENSITIVE',
		'BEFORE',
		'BETWEEN',
		'BIGINT',
		'BINARY',
		'BLOB',
		'BOTH',
		'BY',
		'CALL',
		'CASCADE',
		'CASE',
		'CHANGE',
		'CHAR',
		'CHARACTER',
		'CHECK',
		'COLLATE',
		'COLUMN',
		'CONDITION',
		'CONSTRAINT',
		'CONTINUE',
		'CONVERT',
		'CREATE',
		'CROSS',
		'CURRENT_DATE',
		'CURRENT_TIME',
		'CURRENT_TIMESTAMP',
		'CURRENT_USER',
		'CURSOR',
		'DATABASE',
		'DATABASES',
		'DAY_HOUR',
		'DAY_MICROSECOND',
		'DAY_MINUTE',
		'DAY_SECOND',
		'DEC',
		'DECIMAL',
		'DECLARE',
		'DEFAULT',
		'DELAYED',
		'DELETE',
		'DESC',
		'DESCRIBE',
		'DETERMINISTIC',
		'DISTINCT',
		'DISTINCTROW',
		'DIV',
		'DOUBLE',
		'DROP',
		'DUAL',
		'EACH',
		'ELSE',
		'ELSEIF',
		'ENCLOSED',
		'ESCAPED',
		'EXISTS',
		'EXIT',
		'EXPLAIN',
		'FALSE',
		'FETCH',
		'FLOAT',
		'FLOAT4',
		'FLOAT8',
		'FOR',
		'FORCE',
		'FOREIGN',
		'FROM',
		'FULLTEXT',
		'GENERAL',
		'GOTO',
		'GRANT',
		'GROUP',
		'HAVING',
		'HIGH_PRIORITY',
		'HOUR_MICROSECOND',
		'HOUR_MINUTE',
		'HOUR_SECOND',
		'IF',
		'IGNORE',
		'IGNORE_SERVER_IDS',
		'IN',
		'INDEX',
		'INFILE',
		'INNER',
		'INOUT',
		'INSENSITIVE',
		'INSERT',
		'INT',
		'INT1',
		'INT2',
		'INT3',
		'INT4',
		'INT8',
		'INTEGER',
		'INTERVAL',
		'INTO',
		'IS',
		'ITERATE',
		'JOIN',
		'KEY',
		'KEYS',
		'KILL',
		'LABEL',
		'LEADING',
		'LEAVE',
		'LEFT',
		'LIKE',
		'LIMIT',
		'LINEAR',
		'LINES',
		'LOAD',
		'LOCALTIME',
		'LOCALTIMESTAMP',
		'LOCK',
		'LONG',
		'LONGBLOB',
		'LONGTEXT',
		'LOOP',
		'LOW_PRIORITY',
		'MASTER_HEARTBEAT_PERIOD',
		'MASTER_SSL_VERIFY_SERVER_CERT',
		'MATCH',
		'MAXVALUE',
		'MEDIUMBLOB',
		'MEDIUMINT',
		'MEDIUMTEXT',
		'MIDDLEINT',
		'MINUTE_MICROSECOND',
		'MINUTE_SECOND',
		'MOD',
		'MODIFIES',
		'NATURAL',
		'NOT',
		'NO_WRITE_TO_BINLOG',
		'NULL',
		'NUMERIC',
		'ON',
		'OPTIMIZE',
		'OPTION',
		'OPTIONALLY',
		'OR',
		'ORDER',
		'OUT',
		'OUTER',
		'OUTFILE',
		'PRECISION',
		'PRIMARY',
		'PROCEDURE',
		'PURGE',
		'RANGE',
		'READ',
		'READS',
		'READ_WRITE',
		'READ_ONLY',
		'REAL',
		'REFERENCES',
		'REGEXP',
		'RELEASE',
		'RENAME',
		'REPEAT',
		'REPLACE',
		'REQUIRE',
		'RESIGNAL',
		'RESTRICT',
		'RETURN',
		'REVOKE',
		'RIGHT',
		'RLIKE',
		'SCHEMA',
		'SCHEMAS',
		'SECOND_MICROSECOND',
		'SELECT',
		'SENSITIVE',
		'SEPARATOR',
		'SET',
		'SHOW',
		'SIGNAL',
		'SLOW',
		'SMALLINT',
		'SPATIAL',
		'SPECIFIC',
		'SQL',
		'SQLEXCEPTION',
		'SQLSTATE',
		'SQLWARNING',
		'SQL_BIG_RESULT',
		'SQL_CALC_FOUND_ROWS',
		'SQL_SMALL_RESULT',
		'SSL',
		'STARTING',
		'STRAIGHT_JOIN',
		'TABLE',
		'TERMINATED',
		'THEN',
		'TINYBLOB',
		'TINYINT',
		'TINYTEXT',
		'TO',
		'TRAILING',
		'TRIGGER',
		'TRUE',
		'UNDO',
		'UNION',
		'UNIQUE',
		'UNLOCK',
		'UNSIGNED',
		'UPDATE',
		'USAGE',
		'USE',
		'USING',
		'UTC_DATE',
		'UTC_TIME',
		'UTC_TIMESTAMP',
		'VALUES',
		'VARBINARY',
		'VARCHAR',
		'VARCHARACTER',
		'VARYING',
		'WHEN',
		'WHERE',
		'WHILE',
		'WITH',
		'WRITE',
		'XOR',
		'YEAR_MONTH',
		'ZEROFILL'
	);

	/**
	 * 
	 * column names used by TYPO3
	 * @var array
	 */
	static protected $reservedTYPO3ColumnNames = array(
		'uid',
		'pid',
		'endtime',
		'starttime',
		'sorting',
		'fe_group',
		'hidden',
		'deleted',
		'cruser_id',
		'crdate',
		'tstamp',
		'sys_language',
		't3ver_oid',
		't3ver_id',
		't3ver_wsid',
		't3ver_label',
		't3ver_state',
		't3ver_stage',
		't3ver_count',
		't3ver_tstamp',
		't3_origuid',
		'sys_language_uid',
		'l18n_parent',
		'l18n_diffsource'
	);

	/**
	 * Validate the given extension
	 *
	 * @param Tx_ExtbaseKickstarter_Domain_Model_Extension $extension
	 * @author Rens Admiraal
	 * @return boolean
	 */
	public function isValid($extension) {

		try {
			self::validateExtensionKey($extension->getExtensionKey());
		} catch (Tx_Extbase_Exception $e) {
			throw($e);
		}


		try {
			$this->checkExistingExtensions($extension);
		} catch (Tx_Extbase_Exception $e) {
			throw($e);
		}

		$pluginKeys = array();
		foreach($extension->getPlugins() as $plugin){
			if(self::validatePluginKey($plugin->getKey()) === 0){
				throw new Exception('Invalid plugin key in plugin '.$plugin->getName().': "'.$plugin->getKey().'". Only alphanumeric character without spaces are allowed' ,self::ERROR_PLUGIN_INVALID_KEY);
			}
			if(in_array($plugin->getKey(),$pluginKeys)){
				throw new Exception('Duplicate plugin key: "'. $plugin->getKey() . '". Plugin keys must be unique.',self::ERROR_PLUGIN_DUPLICATE_KEY);
			}
			$pluginKeys[] = $plugin->getKey();
		}

		$backendModuleKeys = array();
		foreach($extension->getBackendModules() as $backendModule){
			if(self::validateModuleKey($backendModule->getKey()) === 0){
				throw new Exception('Invalid key in backend module '.$backendModule->getName().'. Only alphanumeric character without spaces are allowed' ,self::ERROR_BACKENDMODULE_INVALID_KEY);
			}
			if(in_array($backendModule->getKey(),$backendModuleKeys)){
				throw new Exception('Duplicate backend module key: "'. $backendModule->getKey() . '". Backend module keys must be unique.',self::ERROR_BACKENDMODULE_DUPLICATE_KEY);
			}
			$backendModuleKeys[] = $backendModule->getKey();
		}

		try {
			self::validateDomainObjects($extension);
		} catch (Tx_Extbase_Exception $e) {
			throw($e);
		}

		return true;
	}

	protected function checkExistingExtensions($extension){
		if(!is_dir(PATH_typo3conf.'ext/'.$extension->getExtensionKey())){
			// no existing extension dir 
			return;
		}
		else {
			/**
			 * Not yet shure, what to do here...
			if($this->detectExtbaseExtension($extension->getExtensionKey())){
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException(
					'There is an existing extension with this extension key. ' 
					.'Are you shure you want to overwrite/merge it?',
					self::EXTENSION_EXISTS_EXTBASE);
			}
			*/
			if($this->detectPiBasedExtension($extension->getExtensionKey())){
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException(
					'There is an existing piBased extension with this extension key. ' 
					.'Please choose another extension key or rename the existing extension directory',
					self::EXTENSION_EXISTS_PIBASE);
			}
		}
	}


	protected function detectPiBasedExtension($extensionKey){
		$extDir = PATH_typo3conf.'ext/'.$extensionKey.'/';
		if(is_dir($extDir.'pi1')){
			return true;
		}
		if(!is_dir($extDir.'Classes') && !is_dir($extDir.'Configuration')){
			return true;
		}
	}

	protected function detectExtbaseExtension($extensionKey){
		$extDir = PATH_typo3conf.'ext/'.$extensionKey.'/';

		if(file_exists($extDir.'ext_emconf.php')){
			$EM_CONF = array();
			$_EXTKEY = $extensionKey;
			require_once($extDir.'ext_emconf.php');
			if(strpos($EM_CONF[$_EXTKEY]['dependencies'],'extbase') > -1){
				return true;
			}
		}
	}

	/**
	 * @author Sebastian Michaelsen <sebastian.gebhard@gmail.com>
	 * @param	Tx_ExtbaseKickstarter_Domain_Model_Extension
	 * @return 	bool
	 * @throws Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException
	 */
	private static function validateDomainObjects($extension) {
		foreach($extension->getDomainObjects() as $domainObject) {
			
				// Check if domainObject name is given
			if(!$domainObject->getName()) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('A Domain Object has no name', self::ERROR_DOMAINOBJECT_NO_NAME);
			}

			/**
		 	 * Character test
			 * Allowed characters are: a-z (lowercase), A-Z (uppercase) and 0-9
			 */
			if (!preg_match("/^[a-zA-Z0-9]*$/", $domainObject->getName())) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Illegal domain object name "' . $domainObject->getName() . '". Please use UpperCamelCase, no spaces or underscores.', self::ERROR_DOMAINOBJECT_ILLEGAL_CHARACTER);
			}

			$objectName = $domainObject->getName();
			$firstChar = $objectName{0};
			if(strtolower($firstChar) == $firstChar) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Illegal first character of domain object name "' . $domainObject->getName() . '". Please use UpperCamelCase.', self::ERROR_DOMAINOBJECT_LOWER_FIRST_CHARACTER);
			}

			try {
				self::validateProperties($domainObject);
			} catch (Tx_Extbase_Exception $e) {
				throw($e);
			}
		}
	}

	/**
	 * @author Sebastian Michaelsen <sebastian.gebhard@gmail.com>
	 * @param	Tx_ExtbaseKickstarter_Domain_Model_DomainObject
	 * @return 	bool
	 * @throws Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException
	 */
	private static function validateProperties($domainObject) {
		$propertyNames = array();
		foreach($domainObject->getProperties() as $property) {
				// Check if property name is given
			if(!$property->getName()) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('A property of ' . $domainObject->getName() . ' has no name', self::ERROR_PROPERTY_NO_NAME);
			}
			$propertyName = $property->getName();
			/**
		 	 * Character test
			 * Allowed characters are: a-z (lowercase), A-Z (uppercase) and 0-9
			 */
			if (!preg_match("/^[a-zA-Z0-9]*$/", $propertyName)) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException(
					'Illegal property name "' . $propertyName . '" of ' . $domainObject->getName() . '. Please use lowerCamelCase, no spaces or underscores.',
					self::ERROR_PROPERTY_ILLEGAL_CHARACTER
				);
			}
			
			
			$firstChar = $propertyName{0};
			if(strtoupper($firstChar) == $firstChar) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException(
					'Illegal first character of property name "' . $property->getName() . '" of domain object "' . $domainObject->getName() . '". Please use lowerCamelCase.',
					self::ERROR_PROPERTY_UPPER_FIRST_CHARACTER
				);
			}
			
			if(self::isReservedTYPO3Word($propertyName)){
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException(
					'Using a reserved word as property name is not allowed. Please rename property "' . $propertyName . '" in Model "' . $domainObject->getName() . '".',
					self::ERROR_PROPERTY_RESERVED_WORD
				);
			}
				// Check for duplicate property names
			if(in_array($propertyName, $propertyNames)) {
				throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Property "' . $property->getName() . '" of ' . $domainObject->getName() . ' exists twice.', self::ERROR_PROPERTY_DUPLICATE);
			}
			$propertyNames[] = $propertyName;
		}
	}
	
	/**
	 * validates a plugin key
	 * @param string $key
	 * @return boolean true if valid
	 */
	private static function validatePluginKey($key){
		return preg_match('/^[a-zA-Z0-9_-]*$/',$key);
	}
	
	/**
	 * validates a backend module key
	 * @param string $key
	 * @return boolean true if valid
	 */
	private static function validateModuleKey($key){
		return preg_match('/^[a-zA-Z0-9_-]*$/',$key);
	}
	
	/**
	 * @author Rens Admiraal
	 * @param string $key
	 * @return boolean
	 * @throws Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException
	 */
	private static function validateExtensionKey($key) {
		/**
		 * Character test
		 * Allowed characters are: a-z (lowercase), 0-9 and '_' (underscore)
		 */
		if (!preg_match("/^[a-z0-9_]*$/", $key)) {
			throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Illegal characters in extension key', self::ERROR_EXTKEY_ILLEGAL_CHARACTERS);
		}

		/**
		 * Start character
		 * Extension keys cannot start or end with 0-9 and '_' (underscore)
		 */
		if (preg_match("/^[0-9_]/", $key)) {
			throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Illegal first character of extension key', self::ERROR_EXTKEY_ILLEGAL_FIRST_CHARACTER);
		}

		/**
		 * Extension key length
		 * An extension key must have minimum 3, maximum 30 characters (not counting underscores)
		 */
		$keyLengthTest = str_replace('_', '', $key);
		if (strlen($keyLengthTest) < 3 || strlen($keyLengthTest) > 30) {
			throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Invalid extension key length', self::ERROR_EXTKEY_LENGTH);
		}

		/**
		 * Reserved prefixes
		 * The key must not being with one of the following prefixes: tx,u,user_,pages,tt_,sys_,ts_language_,csh_
		 */
		if (preg_match("/^(tx_|u_|user_|pages_|tt_|sys_|ts_language_|csh_)/", $key)) {
			throw new Tx_ExtbaseKickstarter_Domain_Exception_ExtensionException('Illegal extension key prefix', self::ERROR_EXTKEY_ILLEGAL_PREFIX);
		}

		return true;
	}

	/**
	 *
	 * @param string $word
	 *
	 * @return boolean
	 */
	static public function isReservedTYPO3Word($word){
		if(in_array(Tx_Extbase_Utility_Extension::convertCamelCaseToLowerCaseUnderscored($word),self::$reservedTYPO3ColumnNames)){
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 *
	 * @param string $word
	 *
	 * @return boolean
	 */
	static public function isReservedMYSQLWord($word){
		if(in_array(strtoupper($word),self::$reservedMYSQLWords)){
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 *
	 * @param string $word
	 *
	 * @return boolean
	 */
	static public function isReservedWord($word){
		if(self::isReservedMYSQLWord($word) || self::isReservedTYPO3Word($word)){
			return true;
		}
		else {
			return false;
		}
	}
}

?>