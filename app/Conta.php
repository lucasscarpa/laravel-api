<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'conta';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
