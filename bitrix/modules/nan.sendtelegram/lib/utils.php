<?php
namespace nan\sendtelegram;

class utils{
    public static function doany()
	{
		echo 'hey2';
		$arRows = [];
		\Bitrix\Main\Loader::includeModule('iblock');

		$rsItems = \Bitrix\Iblock\ElementTable::getList(array(
			'select' => array('ID','NAME'),
			'filter' => array('IBLOCK_ID'=>'17')
		));

		while( $row = $rsItems->fetch() ) {
			$arRows[] = $row;
		}

		$arEmailData = [
			'NAME' => 'Иван',
			'MESSAGE' => 'сообщение из формы обратной связи',
			'CONTACT' => 'aaaa@aa.ru'
		];

		$res = sendtelegramTable::add($arEmailData);

		//self::send_mail($arEmailData);
		//self::dump($arRows);
		//$result = $rsItems->fetch();
		//return $result;
    }

	private static function prepare_data($data): mixed
	{
		if( is_array($data) ){
			foreach ($data as $key=>$val) {
				$arDataConv[$key] = iconv('UTF-8', 'windows-1251', $val);
			}
			return $arDataConv;
		} else {
			return iconv('UTF-8', 'windows-1251', $data);
		}

	}

	private static function send_mail($data): void
	{
		$info = $data;
		$to = $info['mailto'];
		$title = 'Сообщение с сайта';

		$message = 	'<b>Имя:</b> '.$info['name']."<br/>".
			'<b>E-mail:</b> '.$info['mail']."<br/><br/>".
			'<b>Сообщение:</b><br/>'.$info['message'];


		$headers = 'From: ' . $info['mail'] . "\r\n" .
			'MIME-Version: 1.0' . "\r\n".
			'Content-type: text/html; charset=UTF-8' . "\r\n".
			'X-Mailer: PHP/' . phpversion();

		mail($to, $title, $message, $headers);
		unset($_POST);
	}

	public static function dump($input): void
	{
		echo "<pre>";
		print_r($input);
		echo "</pre>";
	}
}
