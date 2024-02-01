<?php
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class sendtelegram extends CModule
{
    var $MODULE_ID = 'sendtelegram';


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

    function InstallDB(): bool
    {
        //RegisterModule('sendtelegram');
        return true;
    }

    function UnInstallDB(): bool
    {

        return true;
    }

    function InstallEvents(): bool
    {


        return true;
    }

    function UnInstallEvents(): bool
    {
        return true;
    }

    function InstallFiles($arParams = []):bool
    {


        return true;
    }

    function UnInstallFiles():bool
    {

        return true;
    }

    function DoInstall(): void
    {
        $this->InstallFiles();
        $this->InstallDB();
		ModuleManager::registerModule($this->MODULE_ID);
    }

    function DoUninstall() :void
    {
        $this->UnInstallDB();
        $this->UnInstallFiles();
		ModuleManager::unRegisterModule($this->MODULE_ID);
    }
}

?>
