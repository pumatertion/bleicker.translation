<?php

namespace Tests\Bleicker\Translation\Unit;

use Bleicker\Translation\Locale;
use Bleicker\Translation\Locales;
use Tests\Bleicker\Translation\UnitTestCase;

/**
 * Class LocaleTest
 *
 * @package Tests\Bleicker\Translation\Unit
 */
class LocaleTest extends UnitTestCase {

	protected function setUp() {
		parent::setUp();
		Locales::prune();
	}

	protected function tearDown() {
		parent::tearDown();
		Locales::prune();
	}

	/**
	 * @test
	 */
	public function registerTest() {
		$locale = Locale::register('German', 'de', 'DE');
		$this->assertTrue(Locales::has('German'));
		$this->assertEquals('de_DE', (string)$locale);
	}

	/**
	 * @test
	 * @expectedException \Bleicker\Container\Exception\AliasAlreadyExistsException
	 */
	public function overwriteTest() {
		Locale::register('German', 'de', 'DE');
		Locale::register('German', 'en', 'US');
	}

	/**
	 * @test
	 */
	public function defaultTest() {
		Locale::register('German', 'de', 'DE');
		Locale::register('English', 'en', 'EN');
		$this->assertEquals('de_DE', (string)Locales::getDefault());
	}
}
