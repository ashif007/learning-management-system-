<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 05/03/17
 * Time: 10:54 م
 */

namespace App\Models;


use App\Core\DB\ORM;

class Request extends ORM
{
    protected static $table='request';
    protected static $pk='id';
}