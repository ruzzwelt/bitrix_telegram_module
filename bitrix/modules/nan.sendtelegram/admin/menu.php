<?php
use Bitrix\Main\Localization\Loc;
$accessLevel = (string)$APPLICATION->GetGroupRight('nan.sendtelegram');

	Loc::loadMessages(__FILE__);

	$yaMenu = [
		[
			'parent_menu' => 'global_menu_services',
			'section' => 'nan.sendtelegram',
			'sort' => 10,
			'text' => Loc::getMessage('NANTG_MENU_ROOT'),
			'title' => Loc::getMessage('NANTG_MENU_ROOT'),
			'menu_id' => 'nan',
            'url' => 'nan.sendtelegram_nansendtelegram_edit.php?lang=ru',
            'icon' => 'nanmail_edit_menu_icon',
            'items_id' => 'global_menu_nan',
			"items"       => array(array(
				"text" => GetMessage("NANTG_MENU_EDIT"),
				"url" => "nan.sendtelegram_nansendtelegram_edit.php?lang=ru",
				"title" => GetMessage("NANTG_MENU_EDIT"),
			)
			),
		]
	];
	return $yaMenu;
