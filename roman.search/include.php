<?php
Bitrix\Main\Loader::registerAutoloadClasses(
	"roman.search",
	array(
        "Roman\\Search\\App" => "lib/App.php",
        "Roman\\Search\\DataTable" => "lib/Data.php",
		"Roman\\Search\\Main" => "lib/Main.php",
		"Roman\\Search\\Test" => "lib/Test.php",
		"Roman\\Search\\Route" => "lib/Route.php",
		"Roman\\Search\\Parser" => "lib/Parser.php"
	)
);
