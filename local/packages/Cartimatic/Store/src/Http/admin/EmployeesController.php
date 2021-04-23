<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 10-Aug-16 5:47 PM
 * File Name    : EmployeesController.php
 */

namespace Cartimatic\Store\Http\admin;

use App\Http\Controllers\Controller;
use Cartimatic\Store\Employee;
use Cartimatic\Store\StoreEmployeeRoles;
use Illuminate\Http\Request;
use Cartimatic\Store\Repository\EmployeesRepository;

/**
 * Class EmployeesController
 * @package Cartimatic\Store\Http\admin
 */
class EmployeesController extends Controller
{
    protected $user_id;
    protected $user;
    protected $is_api;
    /**
     * @var \Request
     */
    private $request;
    /**
     * @var \Cartimatic\Store\Repository\EmployeesRepository
     */
    private $employeesRepository;

    /**
     * EmployeesController constructor.
     *
     * @param \Request $request
     * @param \Cartimatic\Store\Repository\EmployeesRepository $employeesRepository
     */
    public function __construct(Request $request, EmployeesRepository $employeesRepository) {
        parent::__construct();
        $this->request             = $request;
        $this->employeesRepository = $employeesRepository;

        $this->user_id = $request[ 'middleware' ][ 'user_id' ];
        $this->user    = $request[ 'middleware' ][ 'user' ];
        $this->is_api  = $request[ 'middleware' ][ 'is_api' ];
    }

    public function index() {
        $data[ 'employees' ] = $this->employeesRepository->getEmployees($this->user_id);
        $data[ 'title' ]     = 'All Employees';
        return view('Store::employees.index', $data);
    }

    public function create() {
        $data['title'] = 'Add new employee';
        $data['roles'] = $this->employeesRepository->getRolesList($this->user_id);
        return view('Store::employees.create', $data);
    }

    public function store() {
        $this->validate($this->request, [
            'avatar' => 'required|mimes:jpeg,png,jpg',
            'employee_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'city' => 'required',
            'birthday' => 'required',
            'hire_date' => 'required',
            'employee_number' => 'required',
            'role' => 'required',
        ]);

        $this->employeesRepository->store($this->request, $this->user);
        return redirect('admin/store/employees')->with('success', 'Employee added successfully');
    }

    public function edit($id) {

        $data[ 'employee' ] = $this->employeesRepository->getEmployee($id);
        if(empty($data[ 'employee' ])) {
            return redirect('admin/store/employees')->with('error', 'Employee not found');
        }
        return view('Store::employees.edit', $data);
    }

    public function update($id) {
        if($this->request->hasFile('avatar') && !empty($this->request->file('avatar'))) {
            $this->validate($this->request, [
                'avatar' => 'mimes:jpeg,png,jpg'
            ]);
        }

        $this->employeesRepository->update($id, $this->request);
        return redirect('admin/store/employees')->with('success', 'Employee updated successfully');
    }

    public function destroy($id) {
        Employee::destroy($id);
        return redirect('admin/store/employees')->with('success', 'Employee deleted successfully');
    }

    public function createRole() {
        return view('Store::employees.create-role');
    }

    public function storeRole() {
       /* $this->validate($this->request, [
            'name' => "required|unique:store_employee_roles,name,$this->user_id,store_id|max:50"
        ]);*/
        $ifExist = $this->employeesRepository->isRoleExist($this->user_id,$this->request->name);
        if($ifExist > 0){
            return redirect()->back()->with('error', 'Role name already exist');
        }
        $this->employeesRepository->storeRole($this->request->all(), $this->user_id);

        return redirect('admin/store/employees/roles');
    }

    public function allRole() {
        $data[ 'title' ] = 'All Roles';
        $data[ 'roles' ] = $this->employeesRepository->allRoles($this->user_id);
        return view('Store::employees.all-roles', $data);
    }

    public function deleteRole($id) {
        $data = $this->employeesRepository->deleteRole($id, $this->user_id);
        if(empty($data)) {
            return redirect()->back()->with('success', 'Role is deleted successfully');
        } else {
            return redirect()->back()->with('error', $data);

        }
    }

    public function getRole($role) {
        $data['title'] = 'Edit Role';
        $data['role'] = StoreEmployeeRoles::find($role);
        if(!empty($data['role'])){
            if($data['role']->store_id == $this->user_id){
                return view('Store::employees.edit-role', $data);
            }
            return redirect()->back()->with('error', 'Permission denied');
        }else{
            return redirect()->back()->with('error', 'Role is not found');
        }
    }

    public function updateRole($id) {
        $this->validate($this->request, [
            'name' => 'required|unique:store_employee_roles|max:50'
        ]);
        $data = $this->employeesRepository->updateRole($this->request->all(), $this->user_id,$id);
        if($data){
            return redirect('admin/store/employees/roles');
        }else{
            return redirect()->back()->with('error', $data);
        }

    }

}
