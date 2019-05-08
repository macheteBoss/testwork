<?php
namespace Roman\Search;
use Roman\Search;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

class Main{

    public static function get() {
        $result = Search\DataTable::getList(
            array(
                'select' => array('*'),
                'order' => array('ID'=>'DESC')
            ));
        $i = 0;
        while($row = $result->fetch()) {
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

    public static function getItemOnID($id) {
        $result = Search\DataTable::getList(
            array(
                'select' => array('*'),
                'filter' => array('ID'=>$id)
            ));
        $row = $result->fetch();
        if(!$row) return false;
        return $row;
    }

    public static function add($values) {
        if(!is_array($values)) return false;
        if(Search\DataTable::add(
            $values
        )) {
            return true;
        }
        return false;
    }

}