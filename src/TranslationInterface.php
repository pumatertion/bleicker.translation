<?php

namespace Bleicker\Translation;

/**
 * Class TranslationInterface
 *
 * @package Bleicker\Translation
 */
interface TranslationInterface {

	/**
	 * @return string
	 */
	public function getPropertyName();

	/**
	 * @param string $propertyName
	 * @return $this
	 */
	public function setPropertyName($propertyName);

	/**
	 * @return string
	 */
	public function getLanguage();

	/**
	 * @param string $language
	 * @return $this
	 */
	public function setLanguage($language);

	/**
	 * @return string
	 */
	public function getRegion();

	/**
	 * @param string $region
	 * @return $this
	 */
	public function setRegion($region);

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setValue($value);

	/**
	 * @return string
	 */
	public function getValue();

	/**
	 * @return string
	 */
	public function getLocaleString();
}
