<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


/**
 * Описание параметров фреймворка для форм:
 *
 * _POST - экранированный пост, результат от функции escapeArray($_POST)
 *
 * POST_NAME - обязательный важный параметр, по нему формы отличаются друг от друга (напр. callback)
 * 		это имя формы и массива параметров в посте
 * 		разрешены символы [a-z0-9_] - это важно!!!
 *
 * REQ_FIELDS - напр., array("name", "mail") - обязательные поля(предусмотрена вложенность (задавать как структуру массива пост))
 * 		зашито значение mail - это значит, проверять поле как емейл
 *
 * ADD_ELEMENT
 * добавить элемент в и.б., если элемент добавлен, то в почтовом шаблоне доступна переменная
 * #ADDED_ID# ($arResult['ADDED_ID']), иначе переменная с ошибкой $arResult['error']['add']
 * 	=> array(
 * 	"FIELDS"	=>	array(					// поля и.б. (код поля => значение)
 * 			"IBLOCK_ID"		=>	17,			// идентификатор и.б.
 * 			"NAME"			=>	$escPOST['name'],
 * 			"ACTIVE_FROM"	=>	ConvertTimeStamp(getmicrotime()),
 *	),
 * 	"PROPS"		=>	array()),				// свойства и.б. (код свойства => значение),
 *
 * TEMPLATE - в письмо отправить html-из специального шаблона компонента
 * если параметр установлен, то в теле письма в админ. части будет доступна переменная
 * #HTML# с готовым заполненым шаблоном(который указан), иначе в в теле письма будут
 * доступны переменные из массива пост #переменная#
 *
 *
 * DEFAULT_SEND_MAIL = Y/N, по-умолчанию Y.
 * 		Использовать ли стандартную отсылку емейла методом CEvent::SEND().
 * 		Это нужно, например, когда мы хотим в дополнительном обработчике
 * 		послать каким-то своим способом письмо
 *
 * EVENT_TYPE - тип почтового шаблона
 * DUBLICATE_MAIL Y/N - дублировать ли исходящее письмо на емейл в настройках главного модуля
 *
 * EVENT_ID - ID-почтового шаблона
 *
 * REDIRECT Y/N - совершать ли редирект на REDIRECT_URL после отправки, по-умолчанию не совершать
 *
 * REDIRECT_URL - страница, на которую совершить перенаправление в случае успешной отправки,
 * по-умолчанию $APPLICATION->GetCurPage()
 *
 * USE_CAPTCHA - Y/N использовать ли капчу для защиты формы
 *
 * NO_TEMPLATE - Y/N подключать или нет шаблон компонента (для гибкости, на будущее)
 *
 * SET_MAIN_JS_CHECKERS = Y/N подрубить ли стандартные проверки форм, по-умолчанию да,
 * эти проверки для аякс форм вешаем стандартные js-обработчики по-умолчанию, если нужны
 * не стандатные, то отрубаем и пишем в шаблоне компонента
 * ПО-умолчанию компонент работает в аякс режиме, именно так!
 */

/*
 *
 *
Пример почтового события тип: CALLBACK_REQUEST
название: Заполнена форма обратной связи
описание:
#fio# - ФИО автора
#mail# - email автора
#phone# - телефон автора
#message# - сообщение автора

почтовый шаблон:
Тема: На сайте #SITE_NAME# заполнена форма обратной связи
Сообщение:

Добрый день!
На сайте #SITE_NAME# заполнена форма обратной связи.

ФИО пользователя: #fio#

Email пользователя: #mail#

Телефон пользователя: #phone#

Сообщение:
#message#

---------------------------------------
сообщение сгенерировано автоматически.
 *
 */



/*
Описать:
1. пример подключения аякс формы (публичная часть, ajax)
путь подключение в публ. части -- ajax_request.php -- перезапись куска в публичной части
2. способ создания шаблона для формы, lang поля тайтлов форм и ошибок, успешных сообщений
/lang/component.php - только для произвольных вещей компонента
3. пример подключение не аякс формы
4. пример произвольных валидаторов в шаблоне
5. пример создания дополнительных обработчиков, файл custom_handlers.php
6. пример создания доп. обработчиков, довыборок, файл custom_select.php

@see https://webexpert.bitrix24.ru/workgroups/group/91/wiki/wexpert%3Arequest/
*/

$arComponentDescription = array(
	"NAME"			=> "request.form.system",
	"DESCRIPTION"	=> "",
	"ICON"			=> "/images/ico.gif",
	"PATH" => array(
		"ID"		=> "hipot_root",
		"NAME"		=> "hipot"
	),
	"AREA_BUTTONS"	=> array(),
	"CACHE_PATH"	=> "Y",
	"COMPLEX"		=> "N"
);
?>