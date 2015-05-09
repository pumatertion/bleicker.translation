<?php

namespace Bleicker\Translation;

use Bleicker\ObjectManager\ObjectManager;
use ReflectionClass;

/**
 * Class Locale
 *
 * @package Bleicker\Translation
 */
class Locale implements LocaleInterface {

	/**
	 * @var string
	 */
	protected $language;

	/**
	 * @var string
	 */
	protected $region;

	/**
	 * @param string $language
	 * @param string $region
	 */
	public function __construct($language, $region) {
		$this->language = $language;
		$this->region = $region;
	}

	/**
	 * @return string
	 */
	public function getLanguage() {
		return $this->language;
	}

	/**
	 * @return string
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getLanguage() . static::LOCALE_SEPARATOR . $this->getRegion();
	}

	/**
	 * @param string $alias
	 * @param string $language
	 * @param string $region
	 * @return LocaleInterface
	 */
	public static function register($alias, $region, $region) {
		$reflection = new ReflectionClass(static::class);
		$instance = $reflection->newInstanceArgs(array_slice(func_get_args(), 1));
		/** @var LocalesInterface $locales */
		$locales = ObjectManager::get(LocalesInterface::class, Locales::class);
		$locales->add($alias, $instance);
		return $instance;
	}
}
