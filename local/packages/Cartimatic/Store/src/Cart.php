<?php
namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'store_orders';
    protected $primaryKey = 'id';

}

