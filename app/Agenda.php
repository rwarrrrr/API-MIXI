<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primary_key = 'id';
    public $incrementing = false;
}
