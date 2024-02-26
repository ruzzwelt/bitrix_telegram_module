<?php

namespace nan\sendtelegram;

use Bitrix\Main\Entity;

class sendtelegramTable extends Entity\DataManager{
	public static function getTableName()
	{
		return 'sendtelegram';
	}

	public static function getUfId()
	{
		return 'SENDTELEGRAM';
	}

	public static function getMap()
	{
		return array(
			new Entity\IntegerField('ID', array(
				'primary' => true,
				'autocomplete' => true,
			)),
			new Entity\StringField('NAME'),
			new Entity\StringField('MESSAGE'),
			new Entity\StringField('CONTACT'),
		);
	}

	public static function getConnectionName()
	{
		return 'default';
	}

}
