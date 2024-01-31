<?php
IncludeModuleLangFile(__FILE__);

class sendtelegram extends CModule
{
    var $MODULE_ID = 'sendtelegram';


    function __construct()
    {
        $arModuleVersion = [];
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->MODULE_NAME = GetMessage("sendtelegram_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("sendtelegram_MODULE_DESC");

        $this->PARTNER_NAME = GetMessage("nan.mail_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("nan.mail_PARTNER_URI");
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
        RegisterModule($this->MODULE_ID);
    }

    function DoUninstall() :void
    {
        $this->UnInstallDB();
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
    }
}

?>
