<?php
namespace Roman\Search;
use Roman\Search;
use Bitrix\Main\Config\Option;

class Test extends Search\App
{
    public $apiName = 'info';

    public function indexAction()
    {
        $module_id = pathinfo(dirname(__DIR__))["basename"];
        $mix = array();
        $settings = array(
            "switch_on" 	=> Option::get($module_id, "switch_on", "Y"),
            "widthForm"     	=> Option::get($module_id, "widthForm", "350"),
            "radiusForm"     	=> Option::get($module_id, "radiusForm", "15"),
            "heightInput"    	=> Option::get($module_id, "heightInput", "38"),
            "colorButton"     	=> Option::get($module_id, "colorButton", "#bf3030"),
            "colorText"     	=> Option::get($module_id, "colorText", "#fff"),
            "side"     	    => Option::get($module_id, "side", "none"),
            "switch_img" 	=> Option::get($module_id, "switch_img", "Y"),
            "switch_text" 	=> Option::get($module_id, "switch_text", "Y"),
            "switch_link" 	=> Option::get($module_id, "switch_link", "Y")
        );
        $db = new Search\Main;
        $data = $db->get();
        $mix["settings"] = $settings;
        $mix["data"] = $data;
        return $this->response($mix, 200);
    }

    public function viewAction()
    {
        $id = array_shift($this->requestUri);
        $db = new Search\Main;
        if($info = $db->getItemOnID((int)$id)) {
            return $this->response($info, 200);
        }
        return $this->response("Error", 401);
    }

    public function createAction()
    {
        $postData = file_get_contents('php://input');
        $dataJson = json_decode($postData,true);
        $url = $dataJson["url"];
        $type = $dataJson["type"];
        $parse = new Search\Parser;
        if($data = $parse->enter($url, $type)) {
            $add = new Search\Main;
            $data["content"] = implode(",", $data["content"]);
            if($add->add(array("TITLE"=>$url, "CONTENT"=>$data["content"], "TYPE"=>$data["type"],
                "COUNT"=>$data["count"]))) {
                return $this->response($data, 200);
            }
        }

        return $this->response("Error", 401);
    }

}