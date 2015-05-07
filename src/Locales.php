<?php

namespace Bleicker\Translation;

use Bleicker\ObjectManager\Container;

/**
 * Class Locales
 *
 * @package Bleicker\Translation
 */
class Locales extends Container implements LocalesInterface {

	/**
	 * @var array
	 */
	public static $storage = [];

	/**
	 * @param string $alias
	 * @return LocaleInterface
	 */
	public static function get($alias) {
		return parent::get($alias);
	}

	/**
	 * @param string $alias
	 * @param LocaleInterface $data
	 * @return static
	 */
	public static function add($alias, $data) {
		return parent::add($alias, $data);
	}

	/**
	 * @return LocaleInterface
	 */
	public static function getDefault() {
		$storage = static::storage();
		return array_shift($storage);
	}
}
