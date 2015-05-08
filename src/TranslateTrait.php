<?php

namespace Bleicker\Translation;

use Bleicker\Translation\Exception\TranslationAlreadyExistsException;
use Closure;
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
	 * @return $this
	 */
	public function removeTranslation(TranslationInterface $translation) {
		if ($this->hasTranslation($translation)) {
			$this->translations->removeElement($this->getTranslation($translation));
		}
		return $this;
	}

	/**
	 * @param TranslationInterface $translation
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 */
	public function addTranslation(TranslationInterface $translation) {
		if ($this->hasTranslation($translation)) {
			throw new TranslationAlreadyExistsException('Translation "' . (string)$translation . '" already exists', 1431005644);
		}
		$this->translations->add($translation);
		return $this;
	}

	/**
	 * @param TranslationInterface $translation
	 * @return boolean
	 */
	public function hasTranslation(TranslationInterface $translation) {
		return (boolean)$this->translations->filter($this->getTranslationMatchingFilter($translation))->count();
	}

	/**
	 * @param TranslationInterface $translation
	 * @return TranslationInterface
	 */
	public function getTranslation(TranslationInterface $translation) {
		return $this->translations->filter($this->getTranslationMatchingFilter($translation))->first();
	}

	/**
	 * @param TranslationInterface $translation
	 * @return Closure
	 */
	protected function getTranslationMatchingFilter(TranslationInterface $translation) {
		return function (TranslationInterface $existingTranslation) use ($translation) {
			return (string)$existingTranslation === (string)$translation;
		};
	}
}
