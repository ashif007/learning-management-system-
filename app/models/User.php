<?php

/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 04/03/17
 * Time: 09:23 ص
 */
namespace App\Models;

use App\Core\DB\ORM;

class User extends ORM 
{
    protected static $table="users";
    protected static $pk="id";

    public function requests()
    {
        return UserRequest::retrieveByField('uid',$this->id);
    }
}