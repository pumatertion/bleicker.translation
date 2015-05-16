<?php
namespace Bleicker\Translation;

/**
 * Class Locale
 *
 * @package Bleicker\Translation
 */
interface LocaleInterface {

	const LOCALE_SEPARATOR = '_';

	/**
	 * @return string
	 */
	public function getRegion();

	/**
	 * @return string
	 */
	public function getLanguage();

	/**
	 * @return string
	 */
	public function getLocaleString();

	/**
	 * @return string
	 */
	public function __toString();

	/**
	 * @param string $alias
	 * @param string $language
	 * @param string $region
	 * @return LocaleInterface
	 */
	public static function register($alias, $language, $region);
}