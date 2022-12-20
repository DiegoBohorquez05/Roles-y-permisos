<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function listRolesWithPermissions(){
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return response()->json([
            'roles' => $roles,
            'permisos' => $permissions
        ], 200);
    }

    public function createRole(Request $request){
        try {
            $request->validate([
                'name' => 'required|string'
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        Role::create([
            'name' => $request->name
        ]);

        return 'Rol creado con exito';
    }

    public function deleteRole(Int $id){
        $role = Role::findById($id);
        $role->delete();
        return 'Eliminado con exito ???????';
    }

    public function assignPermission(Request $request){
        try {
            $request->validate([
                'role' => 'required|string|exists:roles,name',
                'permission' => 'required|string|exists:permissions,name'
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        $role = Role::findByName($request->role);
        $role->givePermissionTo($request->permission);

        return 'Permisos asignados';
    }

    public function removePermission(Request $request){
        try {
            $request->validate([
                'role' => 'required|string|exists:roles,name',
                'permission' => 'required|string|exists:permissions,name'
            ]);
        }catch (\Throwable $th){
            return response()->json(['error' => $th->getMessage()], 400);
        }

        $role = Role::findByName($request->role);
        $role->revokePermissionTo($request->permission);

        return 'Permission removed';
    }
}
