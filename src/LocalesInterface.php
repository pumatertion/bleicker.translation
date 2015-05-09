<?php
namespace Bleicker\Translation;

/**
 * Class Locales
 *
 * @package Bleicker\Translation
 */
interface LocalesInterface {

	/**
	 * @param string $alias
	 * @param LocaleInterface $data
	 * @return static
	 */
	public static function add($alias, $data);

	/**
	 * @param string $alias
	 * @return LocaleInterface
	 */
	public static function get($alias);

	/**
	 * @return LocaleInterface
	 */
	public static function getDefault();

	/**
	 * @param string $alias
	 * @return boolean
	 */
	public static function has($alias);

	/**
	 * @return static
	 */
	public static function prune();

	/**
	 * @param string $alias
	 * @return static
	 */
	public static function remove($alias);

	/**
	 * @return array
	 */
	public static function storage();

	/**
	 * @return LocaleInterface
	 */
	public static function getSystemLocale();

	/**
	 * @param LocaleInterface $locale
	 * @return static
	 */
	public static function setSystemLocale(LocaleInterface $locale);

	/**
	 * @return boolean
	 */
	public static function isLocalizationMode();
}