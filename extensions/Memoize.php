<?php

namespace li3_memoize\extensions;

use li3_memoize\extensions\adapter\storage\cache\MemoizerProxy;

/**
 * Main Memoize class helps add the filters to the specific libraries
 */
class Memoize extends \lithium\core\Adaptable {

	/**
	 * Holds the names of objects and methods we want to memoize
	 */
	protected static $objectNames = array();

	/**
	 * Will add the filter for the specific $methods.
	 * 
	 * The namespace key is optional and will be written as "app/extensions/helper" if not provided.
	 * 
	 * ```php
	 * use li3_memoize\extensions\Memoize;
	 * Memoize::add(array(
	 * 	array(
	 * 		'name' => 'app\extensions\helper\Prose',
	 * 		'method' => array('init')
	 * 	)
	 * ));
	 * ```
	 * 
	 * @param array $methods
	 */
	public static function add(array $methods) {
		foreach($methods as $method) {
			// Init array
			if(!isset(self::$objectNames[$method['name']])) {
				self::$objectNames[$method['name']] = array();
			}
			// append to array
			self::$objectNames[$method['name']] += (array)$method['method'];
		}
	}

	/**
	 * Will proxy the given object if in the static $objectNames variable.
	 * 
	 * @param string $type 
	 * @param object $object 
	 * @return object A new MemoizerProxy object or the original object
	 */
	public static function instance($type, $object) {
		$class = get_class($object);
		if(isset(self::$objectNames[$class])) {
			return new MemoizerProxy($object, self::$objectNames[$class]);
		}
		return $object;
	}
}