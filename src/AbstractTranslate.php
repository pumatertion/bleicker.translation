<?php

namespace Bleicker\Translation;

use Bleicker\Translation\Exception\PropertyDoesNotExistsException;
use Bleicker\Translation\Exception\TranslationAlreadyExistsException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * Class AbstractTranslate
 *
 * @package Bleicker\Translation
 */
abstract class AbstractTranslate implements TranslateInterface {

	//use TranslateTrait;

	/**
	 * @var Collection
	 */
	protected $translations;

	public function __construct() {
		$this->translations = new ArrayCollection();
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
	 * @throws PropertyDoesNotExistsException
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
		$expr = Criteria::expr();
		$criteria = Criteria::create();
		$criteria->andWhere(
			$expr->andX(
				$expr->eq('propertyName', $translation->getPropertyName()),
				$expr->eq('locale', $translation->getLocale())
			)
		);
		$matchingTranslations = $this->translations->matching($criteria);
		return (boolean)$matchingTranslations->count();
	}

	/**
	 * @param TranslationInterface $translation
	 * @return TranslationInterface
	 */
	public function getTranslation(TranslationInterface $translation) {
		$expr = Criteria::expr();
		$criteria = Criteria::create();
		$criteria->andWhere(
			$expr->andX(
				$expr->eq('propertyName', $translation->getPropertyName()),
				$expr->eq('locale', $translation->getLocale())
			)
		);
		$matchingTranslations = $this->translations->matching($criteria);
		return $matchingTranslations->first();
	}
}
