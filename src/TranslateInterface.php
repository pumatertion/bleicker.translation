<?php
namespace Bleicker\Translation;

use Bleicker\Translation\Exception\PropertyDoesNotExistsException;
use Bleicker\Translation\Exception\TranslationAlreadyExistsException;
use Doctrine\Common\Collections\Collection;

/**
 * Class AbstractTranslate
 *
 * @package Bleicker\Translation
 */
interface TranslateInterface {

	/**
	 * @param TranslationInterface $translation
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 */
	public function removeTranslation(TranslationInterface $translation);

	/**
	 * @param string $propertyName
	 * @param string $language
	 * @param string $region
	 * @return boolean
	 */
	public function hasTranslationsFor($propertyName = NULL, $language = NULL, $region = NULL);

	/**
	 * @param TranslationInterface $translation
	 * @param string $propertyName
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 * @throws PropertyDoesNotExistsException
	 */
	public function addTranslation(TranslationInterface $translation, $propertyName);

	/**
	 * @param string $value
	 * @param string $propertyName
	 * @param Collection $collection
	 * @return Collection
	 */
	public function filterCollection($propertyName, $value, Collection $collection);

	/**
	 * @return Collection
	 */
	public function getTranslations();

	/**
	 * @param string $propertyName
	 * @param string $language
	 * @param string $region
	 * @return Collection
	 */
	public function filterTranslationsFor($propertyName = NULL, $language = NULL, $region = NULL);
}