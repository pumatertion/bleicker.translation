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
	 * @return Collection
	 */
	public function getTranslations();

	/**
	 * @param TranslationInterface $translation
	 * @return $this
	 */
	public function removeTranslation(TranslationInterface $translation);

	/**
	 * @param TranslationInterface $translation
	 * @return $this
	 * @throws TranslationAlreadyExistsException
	 * @throws PropertyDoesNotExistsException
	 */
	public function addTranslation(TranslationInterface $translation);

	/**
	 * @param TranslationInterface $translation
	 * @return boolean
	 */
	public function hasTranslation(TranslationInterface $translation);

	/**
	 * @param TranslationInterface $translation
	 * @return TranslationInterface
	 */
	public function getTranslation(TranslationInterface $translation);
}