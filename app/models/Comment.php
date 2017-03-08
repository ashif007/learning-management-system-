<?php
/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 08/03/17
 * Time: 06:59 ص
 */

namespace App\Models;


class Comment
{
    protected static $table='comments';
    protected static $pk='id';

    public function user()
    {
        return User::retrieveByPK($this->uid);
    }
}