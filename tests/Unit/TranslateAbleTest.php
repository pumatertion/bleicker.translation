<?php

namespace Tests\Bleicker\Translation\Unit;

use Bleicker\Translation\Translation;
use Bleicker\Translation\TranslationInterface;
use Tests\Bleicker\Translation\Unit\Fixtures\TranslateAble;
use Tests\Bleicker\Translation\UnitTestCase;

/**
 * Class TranslateAbleTest
 *
 * @package Tests\Bleicker\Translation\Unit
 */
class TranslateAbleTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function addTranslationTest() {
		$object = new TranslateAble();
		$translation = new Translation('propertyName', 'value', 'de', 'DE');
		$object->addTranslation($translation);
		$this->assertInstanceOf(TranslationInterface::class, $object->getTranslations()->first());
		$this->assertEquals(1, $object->getTranslations()->count());
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Translation\Exception\TranslationAlreadyExistsException
	 */
	public function addAlreadyExistingTranslationTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('propertyName', 'foo', 'de', 'DE');
		$translation2 = new Translation('propertyName', 'foo', 'de', 'DE');
		$object->addTranslation($translation1);
		$object->addTranslation($translation2);
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Translation\Exception\PropertyDoesNotExistsException
	 */
	public function addTranslationForNotExistingPropertyTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('baz', 'foo', 'de', 'DE');
		$object->addTranslation($translation1);
	}

	/**
	 * @test
	 */
	public function addMultipleTranslationTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('propertyName1', 'foo', 'en', 'EN');
		$translation2 = new Translation('propertyName2', 'foo', 'en', 'EN');
		$translation3 = new Translation('propertyName1', 'foo', 'en', 'US');
		$object->addTranslation($translation1)->addTranslation($translation1)->addTranslation($translation2)->addTranslation($translation3);
		$this->assertEquals(3, $object->getTranslations()->count());
	}

	/**
	 * @test
	 */
	public function removeTranslationTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('propertyName', 'value', 'en', 'EN');
		$translation2 = new Translation('propertyName', 'value', 'en', 'US');
		$object->addTranslation($translation1)->addTranslation($translation2)->removeTranslation($translation1);
		$this->assertEquals(1, $object->getTranslations()->count());
	}

	/**
	 * @test
	 */
	public function filterTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('foo', 'value1', 'en', 'EN');
		$translation2 = new Translation('foo', 'value1', 'en', 'US');
		$translation3 = new Translation('foo', 'value2', 'de', 'DE');
		$translation4 = new Translation('foo', 'value3', 'de', 'CH');
		$translation5 = new Translation('bar', 'value4', 'de', 'AU');

		$object->addTranslation($translation1)
			->addTranslation($translation2)
			->addTranslation($translation3)
			->addTranslation($translation4)
			->addTranslation($translation5);

		$filteredByProperty = $object->filterCollection('propertyName', 'foo', $object->getTranslations());
		$this->assertEquals(4, $filteredByProperty->count());

		$filteredByLanguage = $object->filterCollection('language', 'de', $object->getTranslations());
		$this->assertEquals(3, $filteredByLanguage->count());

		$filteredByRegion = $object->filterCollection('region', 'DE', $object->getTranslations());
		$this->assertEquals(1, $filteredByRegion->count());

		$filteredByValue = $object->filterCollection('value', 'value1', $object->getTranslations());
		$this->assertEquals(2, $filteredByValue->count());

		$filtered = $object->filterCollection('propertyName', 'foo', $object->getTranslations());
		$filtered = $object->filterCollection('language', 'en', $filtered);
		$filtered = $object->filterCollection('region', 'US', $filtered);

		$this->assertEquals(1, $filtered->count());

		/** @var TranslationInterface $translation */
		$translation = $filtered->first();

		$this->assertEquals('foo', $translation->getPropertyName());
		$this->assertEquals('value1', $translation->getValue());
		$this->assertEquals('en', $translation->getLanguage());
		$this->assertEquals('US', $translation->getRegion());
	}

	/**
	 * @test
	 */
	public function filterByTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('foo', 'value1', 'en', 'EN');
		$translation2 = new Translation('foo', 'value1', 'en', 'US');
		$translation3 = new Translation('foo', 'value2', 'de', 'DE');
		$translation4 = new Translation('foo', 'value3', 'de', 'CH');
		$translation5 = new Translation('bar', 'value4', 'de', 'AU');

		$object->addTranslation($translation1)
			->addTranslation($translation2)
			->addTranslation($translation3)
			->addTranslation($translation4)
			->addTranslation($translation5);

		$this->assertEquals(4, $object->filterTranslationsFor('foo')->count());
		$this->assertEquals(2, $object->filterTranslationsFor('foo', 'en')->count());
		$this->assertEquals(1, $object->filterTranslationsFor('foo', 'en', 'US')->count());
		$this->assertEquals(0, $object->filterTranslationsFor('foo', 'fr', 'FR')->count());
		$this->assertEquals(1, $object->filterTranslationsFor('bar')->count());
		$this->assertEquals(1, $object->filterTranslationsFor('bar', 'de')->count());
		$this->assertEquals(1, $object->filterTranslationsFor('bar', 'de', 'AU')->count());
		$this->assertEquals(0, $object->filterTranslationsFor('bar', 'de', 'DE')->count());
	}

	/**
	 * @test
	 */
	public function hasTranslationTest() {
		$object = new TranslateAble();
		$translation1 = new Translation('foo', 'value1', 'en', 'EN');
		$translation2 = new Translation('foo', 'value1', 'en', 'US');
		$translation3 = new Translation('foo', 'value2', 'de', 'DE');
		$translation4 = new Translation('foo', 'value3', 'de', 'CH');
		$translation5 = new Translation('bar', 'value4', 'de', 'AU');

		$object->addTranslation($translation1)
			->addTranslation($translation2)
			->addTranslation($translation3)
			->addTranslation($translation4)
			->addTranslation($translation5);

		$this->assertTrue($object->hasTranslationsFor('foo'));
		$this->assertTrue($object->hasTranslationsFor('foo', 'en'));
		$this->assertTrue($object->hasTranslationsFor('foo', 'en', 'US'));

		$this->assertFalse($object->hasTranslationsFor('baz'));
		$this->assertFalse($object->hasTranslationsFor('bar', 'en'));
		$this->assertFalse($object->hasTranslationsFor('foo', 'en', 'GB'));
	}

}
