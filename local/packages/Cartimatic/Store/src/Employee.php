<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 11-Aug-16 11:04 AM
 * File Name    : Employee.php
 */

namespace Cartimatic\Store;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function role() {
        return $this->belongsTo('Cartimatic\Store\StoreEmployeeRoles', 'employee_type');
  }
}
