<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_before.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin_after.php");
if (!CModule::IncludeModule("nan.sendtelegram"))
	die;
//$mailID = intval($_POST['MAIL_ID']);
//
//if ($strErrorMessage <> '' and !empty($strErrorMessage))
//	ShowError($strErrorMessage);
//
//if ($_GET['ACTION'] == 'DELETE') {
//	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/nan.mail/lib/mail_delete.php");
//}
//if ($_POST['ACTION'] == 'SAVE' or $_GET['ACTION'] == 'SAVE') {
//	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/nan.mail/lib/mail_save.php");
//
//} elseif ($_GET['ACTION'] == 'MAIL_EDIT' or $_GET['ACTION'] == 'NEW') {
//	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/nan.mail/lib/mail_edit.php");
//}
//if ($_GET['ACTION'] != 'MAIL_EDIT' and $_GET['ACTION'] != 'NEW') {
	?>

	<table class="adm-list-table" id="tbl_sale_order">
		<thead>
		<tr class="adm-list-table-header">
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">Удалить</div>
			</td>
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">ID</div>
			</td>
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">Имя</div>
			</td>
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">Сообщение</div>
			</td>
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">Контакт</div>
			</td>
			<td class="adm-list-table-cell">
				<div class="adm-list-table-cell-inner">Редач</div>
			</td>
		</tr>
		</thead>
		<tbody>

		<?
		global $DB;
		\Bitrix\Main\UI\Extension::load("ui.buttons");
		$strSql = "SELECT * FROM `sendtelegram`;";
		$res = $DB->Query($strSql, false, $err_mess . __LINE__);
		while ($row = $res->Fetch()):
			?>
			<tr class="adm-list-table-row">
				<td class="adm-list-table-cell" width='50'><a
						href="?lang=ru&ACT_FILE=nansendtelegram&ACTION=DELETE&MAIL_ID=<?= $row['ID'] ?>">&#10006;</a></td>
				<td class="adm-list-table-cell" width='50'><?= $row['ID'] ?></td>
				<td class="adm-list-table-cell"><?= $row['NAME'] ?></td>
				<td class="adm-list-table-cell"><?= $row['MESSAGE'] ?></td>
				<td class="adm-list-table-cell"><?= $row['CONTACT'] ?></td>
				<td class="adm-list-table-cell"><a
						href="?edit&ID=<?= $row['id_template'] ?>&ACTION=MAIL_EDIT&MAIL_ID=<?= $row['id'] ?>">Едит</a>
				</td>
			</tr>
		<?
		endwhile; ?>
	</table>
	<?
//}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>
