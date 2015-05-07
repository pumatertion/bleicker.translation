<?php

namespace Tests\Bleicker\Translation\Unit;

use Bleicker\Translation\Locale;
use Bleicker\Translation\Locales;
use Bleicker\Translation\Translation;
use Tests\Bleicker\Translation\Unit\Fixtures\TranslateAble;
use Tests\Bleicker\Translation\UnitTestCase;

/**
 * Class TranslateAbleTest
 *
 * @package Tests\Bleicker\Translation\Unit
 */
class TranslateAbleTest extends UnitTestCase {

	protected function setUp() {
		parent::setUp();
		Locales::prune();
		Locale::register('german', 'de', 'DE');
		Locale::register('french', 'fr', 'FR');
		Locale::register('english', 'en', 'GB');
	}

	protected function tearDown() {
		parent::tearDown();
		Locales::prune();
	}

	/**
	 * @test
	 */
	public function addTranslationTest() {
		$object = new TranslateAble();
		$translation = new Translation('foo', Locales::get('german'), 'Hallo Welt');
		$object->addTranslation($translation);
		$this->assertTrue($object->hasTranslation($translation));
	}

	/**
	 * @test
	 */
	public function getTranslationTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('foo', Locales::get('german'), 'Hallo Welt');
		$translation2 = new Translation('foo', Locales::get('english'), 'Hello world');
		$translation3 = new Translation('foo', Locales::get('french'), 'Bonjour Le Monde');
		$object->addTranslation($translation1)->addTranslation($translation2)->addTranslation($translation3);

		$translationToGet = new Translation('foo', Locales::get('german'));
		$this->assertTrue($object->hasTranslation($translationToGet));

		$translationToGet = new Translation('foo', Locales::get('english'));
		$this->assertTrue($object->hasTranslation($translationToGet));

		$translationToGet = new Translation('foo', Locales::get('english'));
		$this->assertTrue($object->hasTranslation($translationToGet));
	}

	/**
	 * @test
	 */
	public function hasTranslationTest() {
		$object = new TranslateAble();
		$locale1 = Locales::get('german');
		$locale2 = Locales::get('english');
		$translation1 = new Translation('foo', $locale1, 'Hallo Welt');
		$translation2 = new Translation('foo', $locale2, 'Hallo Welt');

		$locale1Copy = Locales::get('german');
		$locale2Copy = Locales::get('english');
		$translation1Copy = new Translation('foo', $locale1Copy);
		$translation2Copy = new Translation('foo', $locale2Copy);
		$translation3Copy = new Translation('foo1', $locale1Copy);
		$translation4Copy = new Translation('foo1', $locale2Copy);

		$object->addTranslation($translation1)->addTranslation($translation2);
		$this->assertTrue($object->hasTranslation($translation1Copy));
		$this->assertTrue($object->hasTranslation($translation2Copy));
		$this->assertFalse($object->hasTranslation($translation3Copy));
		$this->assertFalse($object->hasTranslation($translation4Copy));
	}
}
