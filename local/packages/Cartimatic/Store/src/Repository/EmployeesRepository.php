<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 10-Aug-16 5:48 PM
 * File Name    : EmployeesRepository.php
 */

namespace Cartimatic\Store\Repository;

use App\Services\StorageManager;
use Carbon\Carbon;
use Cartimatic\Store\Employee;
use Cartimatic\Store\StoreEmployeeRoles;
use Guzzle\Plugin\Backoff\TruncatedBackoffStrategy;
use Illuminate\Support\Str;

class EmployeesRepository
{

    public function store($request, $user) {

        $profilePhoto                = $this->storeFile($request->file('avatar'));

        $employees                   = new Employee();
        $employees->city             = $request->city;
        $employees->address          = $request->address;
        $employees->name             = $request->employee_name;
        $employees->email            = $request->email;
        $employees->phone_number     = $request->phone_number;
        $employees->birthday         = Carbon::parse($request->birthday)->format('Y-m-d');
        $employees->hire_date        = Carbon::parse($request->hire_date)->format('Y-m-d');
        $employees->employee_number  = $request->employee_number;
        $employees->employee_picture = $profilePhoto;
        $employees->employer_id      = $user->id;
        $employees->employee_type    = $request->role;
        $employees->save();

    }

    private function storeFile($file) {
        //echo '<tt><pre>'; print_r($file); die;

        $extension      = $file->getClientOriginalExtension();
        $storageManager = new StorageManager();
        $path           = 'employees/';
        $fileName       = $storageManager->getFilename($extension);
        $storageManager->saveFile($path . $fileName, $file);
        $storageManager->generateThumbs($fileName, 100, 100, 'employees', '100x100');
        return $path . $fileName;
    }

    public function getEmployees($user_id) {
        return Employee::whereEmployerId($user_id)->with('role')->orderBy('name', 'ASC')->get();
    }

    public function getEmployee($id) {
        return Employee::find($id);
    }

    public function update($id, $request) {
        $employees = Employee::find($id);
        if($request->hasFile('avatar') && !empty($request->file('avatar'))) {
            $profilePhoto                = $this->storeFile($request->file('avatar'));
            $employees->employee_picture = $profilePhoto;
        }

        $employees->city            = $request->city;
        $employees->address         = $request->address;
        $employees->name            = $request->name;
        $employees->email           = $request->email;
        $employees->phone_number    = $request->phone_number;
        $employees->birthday        = Carbon::parse($request->birthday)->format('Y-m-d');
        $employees->hire_date       = Carbon::parse($request->hire_date)->format('Y-m-d');
        $employees->employee_number = $request->employee_number;
        $employees->employee_type   = $request->employee_type;
        $employees->save();

    }

    public function storeRole($data, $store_id) {
        $storeEmployeeRole = new StoreEmployeeRoles();

        $storeEmployeeRole->name     = $data[ 'name' ];
        $storeEmployeeRole->slug     = Str::slug($data[ 'name' ]);
        $storeEmployeeRole->store_id = $store_id;
        $storeEmployeeRole->save();

    }

    public function allRoles($user_id) {
        return StoreEmployeeRoles::whereStoreId($user_id)->orderBy('name', 'ASC')->get();
    }

    public function deleteRole($id, $store_id) {
        $role = StoreEmployeeRoles::find($id);
        if(!empty($role)) {
            if($store_id == $role->store_id) {
                $checkIfassigned = $this->checkIfAssigned($id);
                if($checkIfassigned == 0) {
                    $role->delete();
                } else {
                    return "This role is assigned to one or more employees that's why you cannot delete this role";
                }
            } else {
                return 'Permission denied.';
            }
        }
    }

    private function checkIfAssigned($id) {
        return Employee::whereEmployeeType($id)->count();
    }

    public function updateRole($data, $user_id, $id) {
        $role = StoreEmployeeRoles::find($id);
        if(!empty($role)) {
            if($role->store_id == $user_id) {
                $role->name = $data[ 'name' ];
                $role->save();
                return TRUE;
            }
            return redirect()->back()->with('error', 'Permission denied');
        } else {
            return redirect()->back()->with('error', 'Role is not found');
        }
    }

    public function getRolesList($user_id) {
        return StoreEmployeeRoles::whereStoreId($user_id)->orderBy('name', 'asc')->lists('name', 'id');
    }

    public function isRoleExist($user_id, $name) {
        return StoreEmployeeRoles::whereStoreId($user_id)->whereName($name)->count();
    }

}
