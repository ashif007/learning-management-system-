<?php

/**
 * Created by PhpStorm.
 * User: salamaashoush
 * Date: 04/03/17
 * Time: 09:23 ص
 */
namespace App\Models;

use App\Core\DB\ORM;

class Course extends ORM
{
    protected static $table="course";
    protected static $pk="id";
    
    public function students()
    {

    }
    
    public function teacher()
    {
        
    }

    public function materials()
    {
        
    }
}