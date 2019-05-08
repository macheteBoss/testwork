<?php
use Bitrix\Main\Localization\Loc;
use	Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);

$aTabs = array(
    array(
        "DIV" 	  => "edit",
        "TAB" 	  => Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_NAME"),
        "TITLE"   => Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_NAME"),
        "OPTIONS" => array(
            Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_COMMON"),
            array(
                "switch_on",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_SWITCH_ON"),
                "Y",
                array("checkbox")
            ),
            Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_APPEARANCE"),
            array(
                "widthForm",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_WIDTH"),
                "350",
                array("text", 5)
            ),
            array(
                "radiusForm",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_RADIUS"),
                "15",
                array("text", 5)
            ),
            array(
                "heightInput",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_INPUT_HEIGHT"),
                "38",
                array("text", 5)
            ),
            array(
                "colorButton",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_BUTTON_COLOR"),
                "#bf3030",
                array("text", 5)
            ),
            array(
                "colorText",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TEXT_COLOR"),
                "#fff",
                array("text", 5)
            ),
            Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_POSITION_ON_PAGE"),
            array(
                "side",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_SIDE"),
                "none",
                array("selectbox", array(
                    "left"  => Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_SIDE_LEFT"),
                    "none"  => Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_SIDE_CENTER"),
                    "right" => Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_SIDE_RIGHT")
                ))
            ),
            Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_ACTION"),
            array(
                "switch_img",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_FUNC_IMG"),
                "Y",
                array("checkbox")
            ),
            array(
                "switch_text",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_FUNC_TEXT"),
                "Y",
                array("checkbox")
            ),
            array(
                "switch_link",
                Loc::getMessage("ROMAN_SEARCH_OPTIONS_TAB_FUNC_LINK"),
                "Y",
                array("checkbox")
            ),
        )
    )
);
$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);

$tabControl->Begin();
?>
<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

	<?
	foreach($aTabs as $aTab){

		if($aTab["OPTIONS"]){

			$tabControl->BeginNextTab();

			__AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
		}
	}

	$tabControl->Buttons();
	?>

	<input type="submit" name="apply" value="<? echo(Loc::GetMessage("ROMAN_SEARCH_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />
	<input type="submit" name="default" value="<? echo(Loc::GetMessage("ROMAN_SEARCH_OPTIONS_INPUT_DEFAULT")); ?>" />

	<?
	echo(bitrix_sessid_post());
	?>

</form>

<?php
$tabControl->End();

if($request->isPost() && check_bitrix_sessid()){

    foreach($aTabs as $aTab){

        foreach($aTab["OPTIONS"] as $arOption){

            if(!is_array($arOption)){

                continue;
            }

            if($arOption["note"]){

                continue;
            }

            if($request["apply"]){

                $optionValue = $request->getPost($arOption[0]);

                if($arOption[0] == "switch_on"){

                    if($optionValue == ""){

                        $optionValue = "N";
                    }
                }

                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            }elseif($request["default"]){

                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}