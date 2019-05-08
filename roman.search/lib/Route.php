<?php
namespace Roman\Search;
use Roman\Search;

class Route {

    public function marsh($apiname) {
        switch ($apiname) {
            case "info":
                $api = new Search\Test;
                break;
            default: $api = "error";
        }
        return $api;
    }

}

?>