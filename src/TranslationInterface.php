<?php
namespace Bleicker\Translation;

/**
 * Class Translation
 *
 * @package Bleicker\Translation
 */
interface TranslationInterface {

	/**
	 * @return string
	 */
	public function getValue();

	/**
	 * @return LocaleInterface
	 */
	public function getLocale();

	/**
	 * @return string
	 */
	public function getPropertyName();

	/**
	 * @return string
	 */
	public function __toString();
}