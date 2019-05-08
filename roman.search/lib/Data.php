<?php
namespace Roman\Search;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;


/**
 * Class DataTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> LINK string mandatory
 * <li> PATH string mandatory
 * <li> SORT int optional default 500
 * <li> CREATED datetime mandatory default 'CURRENT_TIMESTAMP'
 * </ul>
 *
 * @package \Brainkit\Data
 **/

class DataTable extends Entity\DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_search_test';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('DATA_ENTITY_ID_FIELD'),
            ),
            'TITLE' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('DATA_ENTITY_TITLE_FIELD'),
            ),
            'CONTENT' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('DATA_ENTITY_CONTENT_FIELD'),
            ),
            'TYPE' => array(
                'data_type' => 'text',
                'required' => true,
                'title' => Loc::getMessage('DATA_ENTITY_TYPE_FIELD'),
            ),
            'COUNT' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('DATA_ENTITY_COUNT'),
            ),
        );
    }

}