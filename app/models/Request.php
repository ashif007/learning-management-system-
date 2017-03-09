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
    protected static $table='requests';
    protected static $pk='id';


    public function user()
    {
        return User::retrieveByPK($this->uid);
    }


    public function comments(){
        $mid="Request:".$this->id;
        return Comment::retrieveByMid($mid);
    }
}