<?php
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Entity\Base;

Loc::loadMessages(__FILE__);

class nan_sendtelegram extends CModule
{
    var $MODULE_ID = 'nan.sendtelegram';


    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__. "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = Loc::getMessage("sendtelegram_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("sendtelegram_MODULE_DESC");
        $this->PARTNER_NAME = Loc::getMessage("nan.mail_PARTNER_NAME");
        $this->PARTNER_URI = Loc::getMessage("nan.mail_PARTNER_URI");
    }

    function InstallDB()
    {
		Loader::includeModule($this->MODULE_ID);

		if( !Application::getConnection( \nan\sendtelegram\sendtelegramTable::getConnectionName())->isTableExists(
			Base::getInstance( '\nan\sendtelegram\sendtelegramTable' )->getDBTableName()
			)
		)
		{
			Base::getInstance( '\nan\sendtelegram\sendtelegramTable' )->createDBTable();

		}

    }

    function UnInstallDB(): void
    {
		Loader::includeModule($this->MODULE_ID);

		Application::getConnection( \nan\sendtelegram\sendtelegramTable::getConnectionName())->queryExecute('drop table if exists '. Base::getInstance('\nan\sendtelegram\sendtelegramTable')->getDBTableName());
    }

//    function InstallEvents(): bool
//    {
//        return true;
//    }
//
//    function UnInstallEvents(): bool
//    {
//        return true;
//    }

    function InstallFiles($arParams = []):bool
    {
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
			if ($dir = opendir($p)) {
				while (false !== $item = readdir($dir)) {
					if ($item == '..' || $item == '.' || $item == 'menu.php')
						continue;
					file_put_contents($file = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item,
						'<' . '? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/' . $this->MODULE_ID . '/admin/' . $item . '");?' . '>');
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components')) {
			if ($dir = opendir($p)) {
				while (false !== $item = readdir($dir)) {
					if ($item == '..' || $item == '.')
						continue;
					CopyDirFiles($p . '/' . $item, $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/' . $item, $ReWrite = True, $Recursive = True);
				}
				closedir($dir);
			}
		}
		CopyDirFiles('/bitrix/modules/' . $this->MODULE_ID . '/install/images', $_SERVER["DOCUMENT_ROOT"] . '/images', true, true);

        return true;
    }

    function UnInstallFiles():bool
    {
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/admin')) {
			if ($dir = opendir($p)) {
				while (false !== $item = readdir($dir)) {
					if ($item == '..' || $item == '.')
						continue;
					unlink($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/' . $this->MODULE_ID . '_' . $item);
				}
				closedir($dir);
			}
		}
		if (is_dir($p = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components')) {
			if ($dir = opendir($p)) {
				while (false !== $item = readdir($dir)) {
					if ($item == '..' || $item == '.' || !is_dir($p0 = $p . '/' . $item))
						continue;

					$dir0 = opendir($p0);
					while (false !== $item0 = readdir($dir0)) {
						if ($item0 == '..' || $item0 == '.')
							continue;
						DeleteDirFilesEx('/bitrix/components/' . $item . '/' . $item0);
					}
					closedir($dir0);
				}
				closedir($dir);
			}
		}
		return true;
    }

    function DoInstall(): void
    {
        $this->InstallFiles();
		ModuleManager::registerModule($this->MODULE_ID);
		$this->InstallDB();
	}

    function DoUninstall() :void
    {
		$this->UnInstallDB();
        $this->UnInstallFiles();
		ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}


