<?php

namespace Bleicker\Translation;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class AbstractTranslate
 *
 * @package Bleicker\Translation
 */
abstract class AbstractTranslate implements TranslateInterface {

	use TranslateTrait;

	/**
	 * @var Collection
	 */
	protected $translations;

	public function __construct() {
		$this->translations = new ArrayCollection();
	}
}
