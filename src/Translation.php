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
	 * @var Locale
	 */
	protected $locale;

	/**
	 * @var string
	 */
	protected $value;

	/**
	 * @param string $propertyName
	 * @param LocaleInterface $locale
	 * @param string $value
	 */
	public function __construct($propertyName, LocaleInterface $locale, $value = NULL) {
		$this->propertyName = $propertyName;
		$this->locale = $locale;
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getPropertyName() {
		return $this->propertyName;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return LocaleInterface
	 */
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getPropertyName() . LocaleInterface::LOCALE_SEPARATOR . (string)$this->getLocale();
	}
}
