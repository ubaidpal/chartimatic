<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 16-Aug-16 12:43 PM
 * File Name    : AuthRepository.php
 */

namespace Cartimatic\POS\Repositories;

use Cartimatic\POS\Http\Models\POS;
use Cartimatic\Store\Employee;

class AuthRepository
{

    public function getManagerByEmail($email) {
        return Employee::whereEmail($email)->first();
    }

    public function getPOS($id) {
        return POS::whereManagerId($id)->first();
    }
}
