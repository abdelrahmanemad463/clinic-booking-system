<?php

namespace App\Http\Controllers;

use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function list(){
            $PermissionRole = PermissionRoleModel::getPermission('Role' , Auth::user()->role_id);
            
            if (empty($PermissionRole)) {
                abort(404);
            }

            $data['PermissionAdd'] = PermissionRoleModel::getPermission('Add Role' , Auth::user()->role_id);
            $data['PermissionEdit'] = PermissionRoleModel::getPermission('Edit Role' , Auth::user()->role_id);
            $data['PermissionDelete'] = PermissionRoleModel::getPermission('Delete Role' , Auth::user()->role_id);
            
            $data['header_title'] = 'list roles';
            $data['getRecord'] = RoleModel::getRecord();
            return view('admin.role.list' , $data);
    }

    public function add(){

        $PermissionRole = PermissionRoleModel::getPermission('Add Role' , Auth::user()->role_id);
        
        if (empty($PermissionRole)) {
            abort(404);
        }
        
        $data['header_title'] = 'add role';
        $getPermission = PermissionModel::getRecord();
        // dd($getPermission);
        $data['getPermission'] = $getPermission;

        return view('admin.role.add' , $data);
    }

    public function insert(Request $request) {
        // dd($request->all());
        $PermissionRole = PermissionRoleModel::getPermission('Add Role' , Auth::user()->role_id);
        
        if (empty($PermissionRole)) {
            abort(404);
        }

        $save = new RoleModel;
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InsertUpdateRecord($request->permission_id , $save->id);

        return redirect('admin/role')->with('success' , 'Role successfully created');
    }

    public function edit($id , Request $request) {
        $PermissionRole = PermissionRoleModel::getPermission('Edit Role' , Auth::user()->role_id);
        
        if (empty($PermissionRole)) {
            abort(404);
        }
        
        $data['header_title'] = 'edit role';
        $data['getRecord'] = RoleModel::getSingle($id);
        $data['getPermission'] = PermissionModel::getRecord();
        $data['getRolePermission'] = PermissionRoleModel::getRolePermission($id);

        return view('admin.role.edit' , $data);
    }

    public function update($id , Request $request) {
//       dd($request->all());

        $PermissionRole = PermissionRoleModel::getPermission('Edit Role' , Auth::user()->role_id);
        
        if (empty($PermissionRole)) {
            abort(404);
        }

        $save = RoleModel::getSingle($id);
        $save->name = $request->name;
        $save->save();

        PermissionRoleModel::InsertUpdateRecord($request->permission_id , $save->id);

        return redirect('admin/role')->with('success' , 'Role successfully updated');
    }

    public function delete($id) {

        $PermissionRole = PermissionRoleModel::getPermission('Delete Role' , Auth::user()->role_id);
        
        if (empty($PermissionRole)) {
            abort(404);
        }

        $save = RoleModel::getSingle($id);
        $save->delete();

        return redirect('admin/role')->with('success' , 'Role successfully deleted');
    }


}
