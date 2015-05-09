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
	 * @var LocaleInterface
	 */
	public static $systemLocale;

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

	/**
	 * @return LocaleInterface
	 */
	public static function getSystemLocale() {
		return static::$systemLocale;
	}

	/**
	 * @param LocaleInterface $locale
	 * @return static
	 */
	public static function setSystemLocale(LocaleInterface $locale) {
		static::$systemLocale = $locale;
		return new static;
	}

	/**
	 * @return boolean
	 */
	public static function isLocalizationMode() {
		return (string)static::getSystemLocale() !== (string)static::getDefault();
	}
}
