<?php

namespace Bleicker\Translation;

use Bleicker\Translation\Exception\PropertyDoesNotExistsException;
use Bleicker\Translation\Exception\TranslationAlreadyExistsException;
use Doctrine\Common\Collections\Collection;

/**
 * Class TranslateTrait
 *
 * @package Bleicker\Translation
 */
trait TranslateTrait {

	/**
	 * @return Collection
	 */
	public function getTranslations() {
		return $this->translations;
	}

	/**
	 * @param TranslationInterface $translation
	 * @param string $propertyName
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 * @throws PropertyDoesNotExistsException
	 */
	public function addTranslation(TranslationInterface $translation, $propertyName) {
		$translation->setPropertyName($propertyName);
		if (!property_exists(static::class, $translation->getPropertyName())) {
			throw new PropertyDoesNotExistsException('The property (' . static::class . '::$' . $translation->getPropertyName() . ') you tried to translate does not exists', 1430390035);
		}
		if ($this->getTranslations()->contains($translation)) {
			return $this;
		}
		$hasLocaleFilter = function (TranslationInterface $existingTranslation) use ($translation) {
			return $translation->getLocaleString() === $existingTranslation->getLocaleString() && $translation->getPropertyName() === $existingTranslation->getPropertyName();
		};
		if ($this->getTranslations()->filter($hasLocaleFilter)->count() > 0) {
			throw new TranslationAlreadyExistsException('Translation already exists for ' . static::class . '::$' . $translation->getPropertyName(), 1430390036);
		}
		$this->getTranslations()->add($translation);
		return $this;
	}

	/**
	 * @param TranslationInterface $translation
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 */
	public function removeTranslation(TranslationInterface $translation) {
		if ($this->getTranslations()->contains($translation)) {
			$this->getTranslations()->removeElement($translation);
		}
		return $this;
	}

	/**
	 * @param string $propertyName
	 * @param string $language
	 * @param string $region
	 * @return Collection
	 */
	public function filterTranslationsFor($propertyName = NULL, $language = NULL, $region = NULL) {
		$translations = $this->getTranslations();
		$translations = $propertyName === NULL ? $translations : $this->filterCollection('propertyName', $propertyName, $translations);
		$translations = $language === NULL ? $translations : $this->filterCollection('language', $language, $translations);
		$translations = $region === NULL ? $translations : $this->filterCollection('region', $region, $translations);
		return $translations;
	}

	/**
	 * @param string $propertyName
	 * @param string $language
	 * @param string $region
	 * @return boolean
	 */
	public function hasTranslationsFor($propertyName = NULL, $language = NULL, $region = NULL) {
		return $this->filterTranslationsFor($propertyName, $language, $region)->count() > 0;
	}

	/**
	 * @param string $value
	 * @param string $propertyName
	 * @param Collection $collection
	 * @return Collection
	 */
	public function filterCollection($propertyName, $value, Collection $collection) {
		return $collection->filter(function (TranslationInterface $translation) use ($value, $propertyName) {
			$methodName = 'get' . ucfirst($propertyName);
			return $translation->$methodName() === $value;
		});
	}
}
