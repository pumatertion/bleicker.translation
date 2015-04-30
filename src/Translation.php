<?php

namespace Bleicker\Translation;

/**
 * Class Translation
 *
 * @package Bleicker\Translation
 */
class Translation implements TranslationInterface {

	/**
	 * @var string
	 */
	protected $propertyName;

	/**
	 * @var string
	 */
	protected $language;

	/**
	 * @var string
	 */
	protected $region;

	/**
	 * @var string
	 */
	protected $value;

	/**
	 * @param $value
	 * @param $language
	 * @param $region
	 */
	public function __construct($value, $language, $region) {
		$this->setValue($value);
		$this->setLanguage($language);
		$this->setRegion($region);
	}

	/**
	 * @param string $language
	 * @return $this
	 */
	public function setLanguage($language) {
		$this->language = strtolower($language);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @param string $propertyName
	 * @return $this
	 */
	public function setPropertyName($propertyName) {
		$this->propertyName = $propertyName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPropertyName() {
		return $this->propertyName;
	}

	/**
	 * @param string $region
	 * @return $this
	 */
	public function setRegion($region) {
		$this->region = strtoupper($region);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * @param string $value
	 * @return $this
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getLocaleString() {
		return $this->getLanguage() . '-' . $this->getRegion();
	}
}
