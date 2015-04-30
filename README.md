### Usage ###

#### Create your class ####

	<?php

		use Bleicker\Translation\AbstractTranslate;

		class TranslateAble extends AbstractTranslate {

			/**
			 * @var string
			 */
			protected $foo;
		}

#### Start to translate ####

	<?php

		$object = new TranslateAble();

		$translation1 = new Translation('English', 'en', 'EN');
		$translation2 = new Translation('German', 'de', 'DE');
		$translation3 = new Translation('Austrian', 'de', 'AU');

		$object
			->addTranslation($translation1, 'foo')
			->addTranslation($translation2, 'foo')
			->addTranslation($translation3, 'foo');

#### Getting a translation ####

	<?php

		$object->filterTranslationsFor('foo', 'de', 'DE');
		$object->filterTranslationsFor('foo', 'de');
		$object->filterTranslationsFor('foo');