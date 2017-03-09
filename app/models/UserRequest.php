<?php

namespace App\Models;

use App\Core\DB\ORM;

class UserRequest extends ORM {

	protected static $table = "requests";
	protected static $pk    = "userid";// we need to get the user id

	static function userid() {

	}

}