<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?

use Bitrix\Main\Loader,
	Bitrix\Main\Localization\Loc,
	Bitrix\Main\ModuleManager;

Loader::includeModule("iblock");

global $arTheme, $NextSectionID, $arRegion, $bHideLeftBlock;

$arPageParams = $arSection = $section = array();

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());
$page_url = $uri->getUri();
$path = $uri->getPath();

$datain = $_GET['datain'] ?? $_SESSION["CHECKIN_DATE"] ?? '';
$dataout = $_GET['dataout'] ?? $_SESSION["CHECKOUT_DATE"] ?? '';
$adults = $_GET['adults'] ?? $_SESSION["adults"] ?? 2;
$child = $_GET['child'] ?? $_SESSION["child"] ?? 0;
$pets = $_GET['pets'] ?? $_SESSION["pets"] ?? 0;

$petsget = 0;
if(!empty($pets)){
    $petsget = $pets;
}

if (!$arParams["SECTION_DISPLAY_PROPERTY"]) {
	$arParams["SECTION_DISPLAY_PROPERTY"] = "UF_VIEWTYPE";
}
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');
$_SESSION['SMART_FILTER_VAR'] = $arParams['FILTER_NAME'];?>

<?$bShowLeftBlock = ($arTheme["LEFT_BLOCK_CATALOG_SECTIONS"]["VALUE"] == "Y" && !defined("ERROR_404") && !$bHideLeftBlock);?>

<?$APPLICATION->SetPageProperty("MENU", 'N');?>
<?$APPLICATION->AddViewContent('right_block_class', 'catalog_page ');?>

<?/*if(CAllcorp3Resort::checkAjaxRequest2()):?>
	<div>
<?endif;*/?>



    <div data-v-7c2b7dcd="" class="search-widget">
        <div data-v-7c2b7dcd="" class="search-widget-field tmp-font--average">
            <div data-v-2b019af9="" data-v-7c2b7dcd="" class="suggest-wrapper search-widget-field--suggestions">
                <div data-v-2b019af9="" class="input-wrapper">
                    <!----> <input data-togglefocus="suggestions-list" data-v-2b019af9="" id="suggest" class="suggest-input" placeholder="Куда едем" autocomplete="off" type="text" name="suggest">&nbsp;
                </div>



                <div data-v-2b019af9="" class="list-wrapper">
                    <div data-v-a9d9a24a="" data-v-2b019af9="" class="suggestions-list--wrapper tmp-font--average suggest-list" data-toggleblock="suggestions-list">
                        <div data-v-a9d9a24a="" class="suggestions-list__scroll">
                            <div data-v-a9d9a24a="" class="suggestions-list">
                                <div data-v-d20d0df2="" data-v-a9d9a24a="" data-variant-id="1" class="suggestions-list-elem">
                                    <div data-v-d20d0df2="" class="suggestions-list-elem--main">
                                        <div data-v-d20d0df2="" class="suggestions-list-elem--bottom">
                                            <!----> <span data-v-d20d0df2="" class="suggestions-list-elem--guests">4 гостя</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-v-a9d9a24a="" class="suggestions-list popular">
                            </div>
                        </div>
                    </div>
                </div>
                <!--v-if-->
            </div>
            <div data-v-7c2b7dcd="" class="search-widget-field__right">
                <div data-v-a96f417a="" data-v-7c2b7dcd="" class="select-apartment-guest search-widget-field--guest">
                    <button data-v-a96f417a="" class="select-guests--btn">
                        <div data-v-a96f417a="" class="title">Тип жилья</div>


                        <select name="" id="search_location" placeholder="Курорт или город" required>
                            <option value="/catalog/rent/" <?if($arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'] == '/catalog/rent'):?>selected<?endif;?>>Смотреть все  </option>
                            <option value="/catalog/rent/apartamenty/" <?if($arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'] == '/catalog/rent/apartamenty'):?>selected<?endif;?>>Апартаменты</option>
                            <option value="/catalog/rent/kottedzhi/" <?if($arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'] == '/catalog/rent/kottedzhi'):?>selected<?endif;?>>Коттеджи </option>
                            <option value="/catalog/rent/doma/" <?if($arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'] == '/catalog/rent/doma'):?>selected<?endif;?>>Дома </option>
                            <option value="/catalog/rent/taunkhausy/" <?if($arResult['FOLDER'].$arResult['VARIABLES']['SECTION_CODE_PATH'] == '/catalog/rent/taunkhausy'):?>selected<?endif;?>>Таунхаусы  </option>

                        </select>
                </div>

                </button>
                <!---->
            </div>
            <div>
                <?if (!function_exists('customFormatDate')) {
                function customFormatDate($date)
                {
                $dateObj = DateTime::createFromFormat('d-m-Y', $date);
                return $dateObj ? $dateObj->format('D M d Y H:i:s') . ' GMT+0300 (Москва, стандартное время)' : 'Неверный формат даты';
                }
                }

                $checkin_date = $_GET['datain'] ?? ($_SESSION["CHECKIN_DATE"] ?? '');
                $checkout_date = $_GET['dataout'] ?? ($_SESSION["CHECKOUT_DATE"] ?? '');

                $datein_form = !empty($checkin_date) ? customFormatDate($checkin_date) : '';
                $dateout_form = !empty($checkout_date) ? customFormatDate($checkout_date) : '';
                ?>

                <input type="hidden" id="datein" value="<?= htmlspecialchars($datein_form, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" id="dateout" value="<?= htmlspecialchars($dateout_form, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="disdates" value="">

                <div id="app">
                </div>
            </div>
            <!--  <div data-v-7c2b7dcd="" class="search-widget-field--occupied" style="z-index: 1;">
           <div data-v-7c2b7dcd="" data-cy="checkIn" class="search-widget-field--occupied__in">
             <div data-v-7c2b7dcd="" class="title">Заезд</div>
             <div data-v-7c2b7dcd="" class="date">Когда</div>
           </div>
           <div data-v-7c2b7dcd="" data-cy="checkOut" class="search-widget-field--occupied__out">
             <div data-v-7c2b7dcd="" class="title">Отъезд</div>
             <div data-v-7c2b7dcd="" class="date">Когда</div>
           </div>
           <div data-v-7c2b7dcd="" class="calendar-in"></div>
         </div> -->
            <div data-v-7c2b7dcd="" class="search-widget-field__right">
                <div data-v-a96f417a="" data-v-7c2b7dcd="" class="select-guests search-widget-field--guest">
                    <button data-v-a96f417a="" class="select-guests--btn" data-toggleclick="select-guests__main">
                        <div data-v-a96f417a="" class="title">Гости</div>
                        <? if (isset($adults)): ?>
                        <? if ($adults > 1): ?>
                        <div data-v-a96f417a=""><?= $adults; ?> взрослых, <? if ($child == 0): ?><span data-v-a96f417a=""> без
											детей</span><? elseif ($child == 1): ?>1 ребенок<? else: ?><?= $child ?>
                                детей<? endif; ?><? if (strpos($path, 'pit-is-da') !== false or $petsget == 1): ?>, c питомцами<? endif; ?>
                            <? else: ?>
                            <div data-v-a96f417a=""><?= $adults; ?> взрослый, <span data-v-a96f417a=""> без
											детей<? if (strpos($path, 'pit-is-da') !== false or $petsget == 1): ?>, c питомцами<? endif; ?></span>
                                <? endif; ?>


                                <? else: ?>
                                <div data-v-a96f417a="">2 взрослых, <span data-v-a96f417a=""> без
											детей<? if (strpos($path, 'pit-is-da') !== false or $petsget == 1): ?>, c питомцами<? endif; ?></span>
                                    <? endif; ?>
                                </div>
                    </button>
                    <!---->
                </div>

                <div data-v-a96f417a="" class="select-guests__main tmp-font--medium" id="sel"
                     data-toggleblock="select-guests__main">
                    <div data-v-a96f417a="" class="select-guests__main-wrapper">
                        <div data-v-7f537561="" data-v-9af400c4="" class="guests-counter adults" data-quantity="adults">
                            <div data-v-7f537561="" class="guests-counter__text"><strong data-v-7f537561="">Взрослые</strong><span
                                        data-v-7f537561="">от 18 лет</span></div>
                            <div data-v-7f537561="" class="guests-counter__editing">
                                <button data-v-4e32f22f="" data-v-7f537561="" class="ui-button pale-blue guests-counter__button"
                                        data-quantitybtn="minus"><span data-v-7f537561="" class="icon-app-minus"></span></button>

                                <? if (isset($adults) and $adults > 0): ?>
                                    <span data-v-7f537561="" class="guests-counter__value" data-quantitytext="adults"><?= $adults; ?></span>
                                    <input type="hidden" value='<?= $adults; ?>' id="adults" data-quantityvalue="adults">
                                <? else: ?>
                                    <span data-v-7f537561="" class="guests-counter__value" data-quantitytext="adults">2</span>
                                    <input type="hidden" value='2' id="adults" data-quantityvalue="adults">
                                <? endif; ?>
                                <button data-v-4e32f22f="" data-v-7f537561="" class="ui-button pale-blue guests-counter__button"
                                        data-quantitybtn="plus"><span data-v-7f537561="" class="icon-app-plus"></span></button>
                            </div>
                            <!---->
                        </div>
                        <hr data-v-9af400c4="" />
                        <div data-v-d1e9d8f0="" class="select-guests__add-child add-child" data-quantity="child">
                            <div data-v-d1e9d8f0="" class="add-child__text"><strong data-v-d1e9d8f0="">Дети</strong><span
                                        data-v-d1e9d8f0="" class="" data-hint="">от 0
									до 17 лет</span></div>
                            <div data-v-d1e9d8f0="" class="add-child__editing">
                                <button data-v-4e32f22f="" data-v-d1e9d8f0="" class="ui-button pale-blue add-child__button"
                                        data-quantitybtn="minus"><span data-v-d1e9d8f0="" class="icon-app-minus"></span></button>

                                <? if (isset($child) and $child > 0): ?>
                                    <span data-v-d1e9d8f0="" class="add-child__value quantity-field" step="1"
                                          data-quantitytext="child"><?= $child; ?></span>

                                    <input type="hidden" id="child" value='<?= $child; ?>' data-quantityvalue="child">
                                <? else: ?>
                                    <span data-v-d1e9d8f0="" class="add-child__value quantity-field" step="1"
                                          data-quantitytext="child">0</span>

                                    <input type="hidden" id="child" value='0' data-quantityvalue="child">
                                <? endif; ?>
                                <button data-v-4e32f22f="" data-v-d1e9d8f0="" class="ui-button pale-blue add-child__button"
                                        data-quantitybtn="plus"><span data-v-d1e9d8f0="" class="icon-app-plus"></span></button>
                            </div>
                        </div>
                        <hr data-v-9af400c4="" />
                        <div data-v-9af400c4="" class="select-guests__pets pets">
                            <span data-v-9af400c4="" class="pets-text">С питомцами</span>
                            <label for="04df336f9f8a"></label>
                            <!--  <div data-v-1ef93adc="" data-v-9af400c4="" class="ui-switcher">
                                <input data-v-1ef93adc="" type="checkbox">
                                <div data-v-1ef93adc="" class="ui-switcher__dot"></div>
                            </div> -->

                            <div data-v-39d6843f="" class="sc-switcher">
                                <div class="sc-switcher-body">
                                    <div data-v-39d6843f="" class="best-sting">
                                        <div data-v-39d6843f="" class="icon-wrap"></div>
                                    </div>
                                </div>
                                <input id="23304df336f9f8a" type="checkbox" value="0" <? if (strpos($path, 'pit-is-da') !== false or $petsget==1): ?>checked<? endif; ?> /><label for="23304df336f9f8a"></label>
                            </div>
                        </div>
                    </div>
                    <div data-v-a96f417a="" class="button-wrapper"><button data-v-4e32f22f="" data-v-a96f417a=""
                                                                           class="ui-button dark" data-toggleclick="select-guests__main">Готово</button></div>
                </div>

                <button data-v-4e32f22f="" data-v-7c2b7dcd="" class="ui-button red btn-search-main" data-cy="search">
                    <span data-v-7c2b7dcd="" class="onlymobile">Найти</span>
                    <div data-v-7c2b7dcd="" class="search-icon onlydesktop"><img data-v-7c2b7dcd=""
                                                                                 src="/img/icon_navigation_search.1591151f.svg" /></div>
                </button>
            </div>
        </div>
        <div data-v-7c2b7dcd="" class="search-widget-select-city">
            <span data-v-7c2b7dcd="" class="title">Например</span><span data-v-7c2b7dcd="" class="val">Санкт-Петербург</span><span data-v-7c2b7dcd="" class="val">Москва</span><span data-v-7c2b7dcd="" class="val">Сочи</span> <span data-v-7c2b7dcd="" class="val">Байкал</span><span data-v-7c2b7dcd="" class="val">Минск</span><span data-v-7c2b7dcd="" class="val">Дагестан</span><span data-v-7c2b7dcd="" class="val">Абхазия</span> <span data-v-7c2b7dcd="" class="val">Карелия</span>
        </div>
    </div>
    <div id="preloader" style="display: none;">
        <img src="/product/iconhome1.gif" id="preloader_img">
    </div>
    <style>
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 0 0 auto;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .loading-text {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }

        .progress-bar {
            width: 80%;
            height: 20px;
            background-color: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
            position: relative;
        }

        .progress {
            height: 100%;
            width: 0;
            background-color: #3498db;
            border-radius: 10px;
            transition: width 0.5s;
        }
        button.ui-button.red.btn-search-main {
            background-color: var(--theme-base-color);
        }

        button.ui-button.red.btn-search-main.disabled {
            cursor: pointer;
            background-color: #bbb;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


    </style>
    <script>
        $(document).ready(function () {

            const $search_location = document.getElementById('search_location');
            const $listContainer = document.getElementById('search_location_list');



            initCalendar();



            const $btnsearch = $('.btn-search-main')
            const $datein = $('#datein')
            const $dateout = $('#dateout')

            function isDatesSelected() {
                return $('#datein').val().length && $('#dateout').val().length
            }

            function checkDatesSelected() {
                if (isDatesSelected()) {
                    $btnsearch.removeClass('disabled')
                } else {
                    $btnsearch.addClass('disabled')
                }
            };

            checkDatesSelected();

            $(document).on('click', '.mx-datepicker-main', function() {
                console.log('check')
                checkDatesSelected()
            })



            $('.btn-search-main').on( "click", function() {
                var dateinString =  $('#datein').val();
                var dateoutString =  $('#dateout').val();

                var adults = $('#adults').val();
                var child = $('#child').val();

                var search_location = $('#search_location').val();

                if (!search_location.length) {
                    $('#search_location').css('border-color', 'red')
                    return
                } else {
                    $('#search_location').css('border-color', 'transparent')
                }
                if (!isDatesSelected()) {
                    $('[data-cy="checkIn"]').trigger('click')
                    return
                }

                if (!isDatesSelected()) {
                    alert("Для поиска апартаментов необходимо выбрать даты заезда и отъезда!")
                    return
                }


// Создаем объект Date из строки
                var datein = new Date(dateinString);
                var dateout = new Date(dateoutString);

// Получаем день, месяц и год
                var day_in = datein.getDate();
                var month_in = datein.getMonth() + 1; // Добавляем 1, так как нумерация месяцев начинается с 0
                var year_in = datein.getFullYear();

// Формируем строку в нужном формате
                var formattedDate_in = (day_in < 10 ? '0' : '') + day_in + '-' + (month_in < 10 ? '0' : '') + month_in + '-' + year_in;

                // Получаем день, месяц и год
                var day_out = dateout.getDate();
                var month_out = dateout.getMonth() + 1; // Добавляем 1, так как нумерация месяцев начинается с 0
                var year_out = dateout.getFullYear();

// Формируем строку в нужном формате
                var formattedDate_out = (day_out < 10 ? '0' : '') + day_out + '-' + (month_out < 10 ? '0' : '') + month_out + '-' + year_out;



                if (document.getElementById('23304df336f9f8a').checked) {
                    var pets = 'pit-is-da/';
                    var petsurl = 1;
                } else {
                    var pets = '';
                    var petsurl = 0;
                }

                console.log(formattedDate_in);
                console.log(formattedDate_out);
                console.log(adults);
                console.log(child);
                console.log(pets);
                console.log(search_location);





                if(adults == 2) {
                    var resaduls = 'is-2-or-3';
                } else if(adults == 3) {
                    var resaduls = 'is-2-or-3';
                } else if(adults == 4) {
                    var resaduls = 'is-2-or-3-or-4';
                } else if(adults == 5) {
                    var resaduls = 'is-2-or-3-or-4-or-5';
                } else if(adults == 6) {
                    var resaduls = 'is-2-or-3-or-4-or-5-or-6';
                }

                $('#preloader').show();

                // Имитируем прогресс загрузки
                /*var progress = 0;
                var interval = setInterval(function() {
                    progress += 0.1;
                    $('.progress').css('width', progress + '%');
                    if (progress >= 100) {
                        clearInterval(interval);
                    }
                }, 100);*/

                let element = document.querySelector('input[type="hidden"]#idelem');

                //const pathname = window.location.pathname;
                const pathname = '<?=$GLOBALS['_SERVER']['REDIRECT_SCRIPT_URL'];?>';

                const url = window.location.pathname;

                const containsApartments = url.includes("apartments");
                const rents = url.includes("rent");
                const kottedzhi = url.includes("kottedzhi");

                let raz;
                raz = 'rent';

                if (containsApartments) {
                    raz = 'apartments';
                } else if(kottedzhi) {
                    raz = 'kottedzhi';
                } else if(rents) {
                    raz = 'rent';
                }



                if (element) {
                    // Если элемент существует, извлекаем URL без домена и параметров



                    window.location.href = window.location.pathname + '?datain=' + formattedDate_in + '&dataout=' + formattedDate_out + '&adults=' + adults + '&child=' + child + '&clear_cache=Y'

                } else {
                    setTimeout(function () {

                        window.location.href = search_location + '?datain=' + formattedDate_in + '&dataout=' + formattedDate_out + '&adults=' + adults + '&child=' + child + '&pets=' + petsurl +'&clear_cache=Y'
                    }, 2000);
                }
            });
        });
    </script>



<div class="top-content-block">
	<?$APPLICATION->ShowViewContent('top_content');?>
	<?$APPLICATION->ShowViewContent('top_content2');?>
</div>

<?/*if(CAllcorp3Resort::checkAjaxRequest2()):?>
	</div>
<?endif;*/?>

<?
$arParams['SHOW_ONE_CLINK_BUY'] = $arTheme["SHOW_ONE_CLICK_BUY"]["VALUE"];
$arParams['MAX_GALLERY_ITEMS'] = $arTheme["SHOW_CATALOG_GALLERY_IN_LIST"]["DEPENDENT_PARAMS"]["MAX_GALLERY_ITEMS"]["VALUE"];
$arParams['SHOW_GALLERY'] = $arTheme["SHOW_CATALOG_GALLERY_IN_LIST"]["VALUE"];
?>

<?
//set params for props from module
TSolution\Functions::replacePropsParams($arParams);
?>

<?// get current section ID
$arSectionFilter = [];
if ($arResult["VARIABLES"]["SECTION_ID"] > 0) {
	$arSectionFilter = array('GLOBAL_ACTIVE' => 'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]);
} elseif (strlen(trim($arResult["VARIABLES"]["SECTION_CODE"])) > 0) {
	$arSectionFilter = array('GLOBAL_ACTIVE' => 'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]);
}
if ($arSectionFilter) {
	$section = CAllcorp3ResortCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), CAllcorp3Resort::makeSectionFilterInRegion($arSectionFilter), false, array("ID", "IBLOCK_ID", "NAME", "DESCRIPTION", "UF_TOP_SEO", 'UF_FILTER_VIEW', "UF_TABLE_PROPS", "UF_INCLUDE_SUBSECTION", "UF_PICTURE_RATIO", "UF_PRICE_COMPACT", $arParams["SECTION_DISPLAY_PROPERTY"], "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN"));
}


$typeSKU = '';
$bSetElementsLineRow = false;

if ($section) {
	$arSection["ID"] = $section["ID"];
	$arSection["NAME"] = $section["NAME"];
	$arSection["IBLOCK_SECTION_ID"] = $section["IBLOCK_SECTION_ID"];
	$arSection["DEPTH_LEVEL"] = $section["DEPTH_LEVEL"];
	if ($section[$arParams["SECTION_DISPLAY_PROPERTY"]]) {
		$arDisplayRes = CUserFieldEnum::GetList(array(), array("ID" => $section[$arParams["SECTION_DISPLAY_PROPERTY"]]));
		if ($arDisplay = $arDisplayRes->GetNext()) {
			$arSection["DISPLAY"] = $arDisplay["XML_ID"];
		}
	}

	if (strlen($section["DESCRIPTION"])) {
		$arSection["DESCRIPTION"] = $section["DESCRIPTION"];
	}
	if (strlen($section["UF_TOP_SEO"])) {
		$arSection["UF_TOP_SEO"] = $section["UF_TOP_SEO"];
	}
	$posSectionDescr = COption::GetOptionString("aspro.allcorp3resort", "SHOW_SECTION_DESCRIPTION", "BOTTOM", SITE_ID);

	global $arSubSectionFilter;
	$arSubSectionFilter = array(
		"SECTION_ID" => $arSection["ID"],
		"IBLOCK_ID" => $arParams['IBLOCK_ID'],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	$iSectionsCount = count(CAllcorp3ResortCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), CAllcorp3Resort::makeSectionFilterInRegion($arSubSectionFilter)));

	if ($arParams['SHOW_MORE_SUBSECTIONS'] === 'N') {
		$iSectionsCount = 0;
	}

	// set smartfilter view
	$viewTmpFilter = 0;
	if ($section['UF_FILTER_VIEW']) {
		$viewTmpFilter = $section['UF_FILTER_VIEW'];
	}
	
	$viewTableProps = 0;
	if ($section['UF_TABLE_PROPS']) {
		$viewTableProps = $section['UF_TABLE_PROPS'];
	}

	$viewPictureRatio = 0;
	if ($section['UF_PICTURE_RATIO']) {
		$viewPictureRatio = $section['UF_PICTURE_RATIO'];
	}
	
	$includeSubsection = '';
	if ($section['UF_INCLUDE_SUBSECTION']) {
		$includeSubsection = $section['UF_INCLUDE_SUBSECTION'];
	}

	if (!$viewTmpFilter || !$arSection["DISPLAY"] || !$viewTableProps || !$includeSubsection) {
		if ($section['DEPTH_LEVEL'] > 1) {
			$sectionParent = CAllcorp3ResortCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $section["IBLOCK_SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", 'UF_FILTER_VIEW', "UF_TABLE_PROPS", "UF_PICTURE_RATIO", "UF_INCLUDE_SUBSECTION", "UF_PRICE_COMPACT", $arParams["SECTION_DISPLAY_PROPERTY"]));
			if ($sectionParent['UF_FILTER_VIEW'] && !$viewTmpFilter) {
				$viewTmpFilter = $sectionParent['UF_FILTER_VIEW'];
			}
			if ($sectionParent['UF_TABLE_PROPS'] && !$viewTableProps) {
				$viewTableProps = $sectionParent['UF_TABLE_PROPS'];
			}
			if ($sectionParent['UF_INCLUDE_SUBSECTION'] && !$includeSubsection) {
				$includeSubsection = $sectionParent['UF_INCLUDE_SUBSECTION'];
			}
			if ($sectionParent[$arParams["SECTION_DISPLAY_PROPERTY"]] && !$arSection["DISPLAY"]) {
				$arDisplayRes = CUserFieldEnum::GetList(array(), array("ID" => $sectionParent[$arParams["SECTION_DISPLAY_PROPERTY"]]));
				if ($arDisplay = $arDisplayRes->GetNext()) {
					$arSection["DISPLAY"] = $arDisplay["XML_ID"];
				}
			}

			if ($section['DEPTH_LEVEL'] > 2) {
				if (!$viewTmpFilter || !$arSection["DISPLAY"] || !$viewTableProps || !$includeSubsection) {
					$sectionRoot = CAllcorp3ResortCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1, "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", 'UF_FILTER_VIEW', "UF_PICTURE_RATIO", "UF_TABLE_PROPS", "UF_INCLUDE_SUBSECTION", "UF_PRICE_COMPACT", $arParams["SECTION_DISPLAY_PROPERTY"]));
					if ($sectionRoot['UF_FILTER_VIEW'] && !$viewTmpFilter) {
						$viewTmpFilter = $sectionRoot['UF_FILTER_VIEW'];
					}
					if ($sectionRoot['UF_TABLE_PROPS'] && !$viewTableProps) {
						$viewTableProps = $sectionRoot['UF_TABLE_PROPS'];
					}
					if ($sectionRoot['UF_INCLUDE_SUBSECTION'] && !$includeSubsection) {
						$includeSubsection = $sectionRoot['UF_INCLUDE_SUBSECTION'];
					}
					if ($sectionRoot[$arParams["SECTION_DISPLAY_PROPERTY"]] && !$arSection["DISPLAY"]) {
						$arDisplayRes = CUserFieldEnum::GetList(array(), array("ID" => $sectionRoot[$arParams["SECTION_DISPLAY_PROPERTY"]]));
						if ($arDisplay = $arDisplayRes->GetNext()) {
							$arSection["DISPLAY"] = $arDisplay["XML_ID"];
						}
					}
				}
			}
		}
	}
	if ($viewTmpFilter) {
		$rsViews = CUserFieldEnum::GetList(array(), array('ID' => $viewTmpFilter));
		if ($arView = $rsViews->Fetch()) {
			$viewFilter = $arView['XML_ID'];
			$arTheme['FILTER_VIEW']['VALUE'] = strtoupper($viewFilter);
		}
	}
	if ($viewTableProps) {
		$rsViews = CUserFieldEnum::GetList(array(), array('ID' => $viewTableProps));
		if ($arView = $rsViews->Fetch()) {
			$typeTableProps = strtolower($arView['XML_ID']);
		}
	}
	if ($includeSubsection) {
		$rsViews = CUserFieldEnum::GetList(array(), array('ID' => $includeSubsection));
		if ($arView = $rsViews->Fetch()) {
			$arParams["INCLUDE_SUBSECTIONS"] = $arView['XML_ID'];
		}
	}

	if ($viewPictureRatio) {
		$rsViews = CUserFieldEnum::GetList(array(), array('ID' => $viewPictureRatio));
		if ($arView = $rsViews->Fetch()) {
			$arParams["PICTURE_RATIO"] = $arView['XML_ID'];
		}
	}

	$arParams['PICTURE_RATIO'] ?? strtolower(CAllcorp3Resort::GetFrontParametrValue('ELEMENTS_IMG_TYPE'));

	$arElementFilter = array("SECTION_ID" => $arSection["ID"], "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]);
	if ($arParams["INCLUDE_SUBSECTIONS"] == "A") {
		$arElementFilter["INCLUDE_SUBSECTIONS"] = "Y";
		$arElementFilter["SECTION_GLOBAL_ACTIVE"] = "Y";
		$arElementFilter["SECTION_ACTIVE "] = "Y";
	}

	$itemsCnt = CAllcorp3ResortCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), CAllcorp3Resort::makeElementFilterInRegion($arElementFilter), array());
}

$linerow = $arParams["LINE_ELEMENT_COUNT"];

$bHideSideSectionBlock = ($arParams["SHOW_SIDE_BLOCK_LAST_LEVEL"] == "Y" && $iSectionsCount && $arParams["INCLUDE_SUBSECTIONS"] == "N");
if ($bHideSideSectionBlock) {
	$APPLICATION->SetPageProperty("MENU", "N");
}

$arParams['FILTER_VIEW'] = 'VERTICAL';
if($arTheme['SHOW_SMARTFILTER']['VALUE'] !== 'N' && $itemsCnt){
	if (
		$arTheme['SHOW_SMARTFILTER']['DEPENDENT_PARAMS']['FILTER_VIEW']['VALUE'] == 'COMPACT' || !$bShowLeftBlock
	) {
		$arParams['FILTER_VIEW'] = 'COMPACT';
	}
}

$bMobileSectionsCompact = $arTheme['MOBILE_LIST_SECTIONS_COMPACT_IN_SECTIONS']['VALUE'] === 'Y';
$bMobileItemsCompact = $arTheme['MOBILE_LIST_ELEMENTS_COMPACT_IN_SECTIONS']['VALUE'] === 'Y';
?>

<div class="main-wrapper flexbox flexbox--direction-row">
	<div class="section-content-wrapper <?=($bShowLeftBlock ? 'with-leftblock' : '');?> flex-1">
		<?if (!$section):?>
			<?\Bitrix\Iblock\Component\Tools::process404(
				""
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SET_STATUS_404"] === "Y")
				,($arParams["SHOW_404"] === "Y")
				,$arParams["FILE_404"]
			);?>
		<?endif;?>

		<?if ($section):?>




			<?
			//seo
			$catalogInfoIblockId = $arParams["LANDING_IBLOCK_ID"];
			if ($catalogInfoIblockId && !$bSimpleSectionTemplate) {
				$arSeoItems = CAllcorp3ResortCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'CACHE' => array("MULTI" => "Y", "TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($catalogInfoIblockId))), array("IBLOCK_ID" => $catalogInfoIblockId, "ACTIVE" => "Y"), false, false, array("ID", "IBLOCK_ID", "PROPERTY_FILTER_URL", "PROPERTY_LINK_REGION"));
				$arSeoItem = $arTmpRegionsLanding = array();
				if ($arSeoItems) {
					$iLandingItemID = 0;
					$current_url =  $APPLICATION->GetCurDir();
					$url = urldecode(str_replace(' ', '+', $current_url)); 
					foreach ($arSeoItems as $arItem) {
						if (!is_array($arItem['PROPERTY_LINK_REGION_VALUE'])) {
							$arItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arItem['PROPERTY_LINK_REGION_VALUE'];
						}

						if (!$arSeoItem) {
							$urldecoded = urldecode($arItem["PROPERTY_FILTER_URL_VALUE"]);
							$urldecodedCP = iconv("utf-8", "windows-1251//IGNORE", $urldecoded);
							if ($urldecoded == $url || $urldecoded == $current_url || $urldecodedCP == $current_url) {
								if ($arItem['PROPERTY_LINK_REGION_VALUE']) {
									if ($arRegion && in_array($arRegion['ID'], $arItem['PROPERTY_LINK_REGION_VALUE'])) {
										$arSeoItem = $arItem;
									}
								} else {
									$arSeoItem = $arItem;
								}

								if ($arSeoItem) {
									$iLandingItemID = $arSeoItem['ID'];
									$arSeoItem = CAllcorp3ResortCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'CACHE' => array("MULTI" => "N", "TAG" => CAllcorp3ResortCache::GetIBlockCacheTag($catalogInfoIblockId))), array("IBLOCK_ID" => $catalogInfoIblockId, "ID" => $iLandingItemID), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_LINK_REGION", "PROPERTY_FORM_QUESTION", "PROPERTY_SECTION_SERVICES", "PROPERTY_TIZERS", "PROPERTY_SECTION", "DETAIL_TEXT", "PROPERTY_I_ELEMENT_PAGE_TITLE", "PROPERTY_I_ELEMENT_PREVIEW_PICTURE_FILE_ALT", "PROPERTY_I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE", "PROPERTY_I_SKU_PAGE_TITLE", "PROPERTY_I_SKU_PREVIEW_PICTURE_FILE_ALT", "PROPERTY_I_SKU_PREVIEW_PICTURE_FILE_TITLE", "ElementValues"));

									$arIBInheritTemplates = array(
										"ELEMENT_PAGE_TITLE" => $arSeoItem["PROPERTY_I_ELEMENT_PAGE_TITLE_VALUE"],
										"ELEMENT_PREVIEW_PICTURE_FILE_ALT" => $arSeoItem["PROPERTY_I_ELEMENT_PREVIEW_PICTURE_FILE_ALT_VALUE"],
										"ELEMENT_PREVIEW_PICTURE_FILE_TITLE" => $arSeoItem["PROPERTY_I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE_VALUE"],
										"SKU_PAGE_TITLE" => $arSeoItem["PROPERTY_I_SKU_PAGE_TITLE_VALUE"],
										"SKU_PREVIEW_PICTURE_FILE_ALT" => $arSeoItem["PROPERTY_I_SKU_PREVIEW_PICTURE_FILE_ALT_VALUE"],
										"SKU_PREVIEW_PICTURE_FILE_TITLE" => $arSeoItem["PROPERTY_I_SKU_PREVIEW_PICTURE_FILE_TITLE_VALUE"],
									);
								}
							}
						}

						if ($arItem['PROPERTY_LINK_REGION_VALUE']) {
							if (!$arRegion || !in_array($arRegion['ID'], $arItem['PROPERTY_LINK_REGION_VALUE'])) {
								$arTmpRegionsLanding[] = $arItem['ID'];
							}
						}
					}
				}

				if ($arSeoItems && $bHideSideSectionBlock) {
					$arSeoItems = [];
				}
			}

			if ($arRegion) {
				$arParams["USE_REGION"] = "Y";

				$GLOBALS[$arParams['FILTER_NAME']]['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
				CAllcorp3Resort::makeElementFilterInRegion($GLOBALS[$arParams['FILTER_NAME']]);
			}

			/* hide compare link from module options */
			if (CAllcorp3Resort::GetFrontParametrValue('CATALOG_COMPARE') == 'N') {
				$arParams["USE_COMPARE"] = 'N';
			}
			
			$bContolAjax = (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest" && isset($_GET["control_ajax"]) && $_GET["control_ajax"] == "Y" );
			$sViewElementTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["ELEMENTS_CATALOG_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);
			?>
			<?// section elements?>
			<div class="js_wrapper_items<?=($arTheme["LAZYLOAD_BLOCK_CATALOG"]["VALUE"] == "Y" ? ' with-load-block' : '')?>" >
				<div class="js-load-wrapper">
					<?if($bContolAjax):?>
						<?$APPLICATION->RestartBuffer();?>
					<?endif;?>
					
					<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
					<?\Aspro\Allcorp3Resort\Functions\Extensions::init('images_detail');?>

					<?if($bContolAjax):?>
						<?die();?>
					<?endif;?>
				</div>
			</div>

			<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.history.js');?>
		<?else:?>
			<div class="alert alert-danger">
				<?=($arParams['MESSAGE_404'] ?:Loc::getMessage("NOT_FOUNDED_SECTION"));?>
			</div>
		<?endif;?>
	</div>
	<?if($bShowLeftBlock):?>
		<?CAllcorp3Resort::ShowPageType('left_block');?>
	<?endif;?>
</div>

<?
CAllcorp3Resort::setCatalogSectionDescription(
	array(
		'FILTER_NAME' => $arParams['FILTER_NAME'],
		'CACHE_TYPE' => $arParams['CACHE_TYPE'],
		'CACHE_TIME' => $arParams['CACHE_TIME'],
		'SECTION_ID' => $arSection['ID'],
		'SHOW_SECTION_DESC' => $arParams['SHOW_SECTION_DESC'],
		'SEO_ITEM' => $arSeoItem,
	)
);
?>