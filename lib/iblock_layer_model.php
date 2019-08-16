<?php
/**
 * hipot studio source file
 * User: <hipot AT ya DOT ru>
 * Date: 16.08.2019 21:01
 * @version pre 1.0
 */

/*** Abstract Iblock Elements Layer ***/
use \Hipot\IbAbstractLayer\GenerateSxem\IblockGenerateSxemManager;

if (! defined('ABSTRACT_LAYER_SAULT')) {
	/**
	 * ���� � ������ ������������ �������, ��������� ������� [0-9a-zA-Z_]
	 * ��-���������, ��������������� � ������������������ ��� ������, ����.
	 * www.good-site.hipot.ru --> GOOD_SITE_HIPOT_RU
	 * @var string
	 */
	define('ABSTRACT_LAYER_SAULT', ToUpper(str_replace(['www.', '.', '-', ':80', ':8080'], ['_', '_', '_', ''], $_SERVER['HTTP_HOST'])));
}

/**
 * ���� � ��������������� ������ ��������� ����������
 * @var string
 * @global
 */
$fileToGenerateSxema = $GLOBAL['fileToGenerateSxema'] = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/cache/generated_iblock_sxem.php';
if (! file_exists($fileToGenerateSxema)) {
	IblockGenerateSxemManager::updateSxem();
}
// ������������� ��������� �������
IblockGenerateSxemManager::setUpdateHandlers();

/*** END Abstract Iblock Elements Layer ***/
