### Usage ###

#### Create your class ####

	<?php
		
		use Bleicker\Translation\AbstractTranslate;
		
		class TranslateAble extends AbstractTranslate {
		
			/**
			 * @var string
			 */
			protected $foo;
		
			/**
			 * @var string
			 */
			protected $bar;
		
			/**
			 * @var string
			 */
			protected $propertyName;
		
			/**
			 * @var string
			 */
			protected $propertyName1;
		
			/**
			 * @var string
			 */
			protected $propertyName2;
		}
		
#### Start to translate ####

	<?php
	
		$object = new TranslateAble();
	
		$translation1 = new Translation('foo', 'English', 'en', 'EN');
		$translation2 = new Translation('foo', 'German', 'de', 'DE');
		$translation3 = new Translation('foo', 'Austrian', 'de', 'AU');

		$object
			->addTranslation($translation1)
			->addTranslation($translation2)
			->addTranslation($translation3);
		
#### Getting a translation ####

	<?php
	
		$object->filterTranslationsFor('foo', 'de', 'DE');
		$object->filterTranslationsFor('foo', 'de');
		$object->filterTranslationsFor('foo');