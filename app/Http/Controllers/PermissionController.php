<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionController extends Controller
{
    /**
     * Show the page to manage permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permission($id = null)
    {
        $permission_update_info = array();
        \Log::info('above Permissionin Update');
        if (!empty($id)) {
            \Log::info('Permissionin Update');
            $single_permission = Permission::where('id', $id)->first();
            $permission_update_info = $single_permission;
        }
        $title = __('messages.manage_permission');
        $active = 'permission';
        $permissions = DB::table('permissions')->get();
        return view('backend.pages.permission', compact('permission_update_info', 'permissions', 'title', 'active'));
    }
    /**
     * Insert and update permission
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function permissionInsert(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'permission' => 'required|max:50',
        ]);
        if ($validation->passes()) {
            $permission_update_id = $request->permission_update_id;
            $permission_name = $request->permission;
            $permission_description = $request->permission_descr;
            if ($permission_update_id == null) {
                $permissions = Permission::where('name', $permission_name)->get();
                $permissions = json_decode($permissions);
                if (empty($permissions)) {
                    Permission::create([
                        'name' => $permission_name, 
                        'permission_description' => $permission_description, 
                        'is_system' => 0]);
                    return redirect()->back()->with(['message' => __('messages.permission_setup_completed'), 'class_name' => 'alert-success']);
                } else {
                    return redirect()->back()->with(['message' => __('messages.permission_name_duplicate'), 'class_name' => 'alert-danger']);
                }
            } else {
                $permission_check = Permission::where('id', $permission_update_id)->first();
                if ($permission_check['name'] != $permission_name) {
                    if (Permission::where('name', '=', $permission_name)->exists()) {
                        return redirect()->back()->with(['message' => __('messages.permission_updated'), 'class_name' => 'alert-danger']);
                    }
                }
                Permission::where('id', $permission_update_id)->update([
                    'name' => $permission_name,
                    'permission_description' => $permission_description]);
                return redirect()->back()->with(['message' => __('messages.permission_updated'), 'class_name' => 'alert-success']);
            }
        } else {
            return redirect()->back()->with(['message' => __('messages.permission_name_blank'), 'class_name' => 'alert-danger']);
        }
    }
    /**
     * To delete a permission
     *
     * @param  int permission_id
     * @return a json array with success message to Jquery function.
     */
    public function permissionDelete($permission_id)
    {
        $permission_info=Permission::where([['id', '=', $permission_id], ['is_system', '=', 0]])->first();
        $permission_name=$permission_info['name'];
        $is_delete = Permission::where([['id', '=', $permission_id], ['is_system', '=', 0]])->delete();
        if ($is_delete) {
            return response()->json(['permission_name'=>$permission_name,'message' => __('messages.permission_deleted'), 'class_name' => 'alert-success']);
        } else {
            return response()->json(['permission_name'=>$permission_name,'message' =>__('messages.permission_not_deleted'), 'class_name' => 'alert-danger']);
        }   
    }

    public function permissionSearch(Request $request){
        // return $request->all();
        $user_id=$request->user_id;
        $user = User::findOrFail($user_id);
        $all_permissions= $user->getAllPermissions();
        $permission_count=count($all_permissions);
        $permission_name_array=array();
        foreach ($all_permissions as $key => $all_permission) {
            $permission_name_array[]='<a href="" id="single_permission_name">'.$all_permission->name.'</a>';
        }
        $permission_implosed=implode(' | ',$permission_name_array);
        return response()->json(['permission_implosed'=>$permission_implosed,'permission_count'=>$permission_count]);
    }
    public function getPermissionForUser(Request $request){
        $role_id=$request->role_id;
        $permission_array=array();
        $tmp_array=array();
        $permission_for_role=array();
        // return count($role_id);
        $permissions=Permission::select('id','name')->get();
        if($role_id==null){
            // return $Permissions;
            return response()->json(['permissions' => $permissions,'permission_for_role'=>$permission_for_role]);
        }
        $i=0;
        while($i<count($role_id)){
            if($role_id[$i]!=null){
                $permission_array[]=DB::table('role_has_permissions')->select('permission_id')->where('role_id',$role_id[$i])->get();
            }
            $i++;
        }
        
        for ($j=0; $j <count($permission_array) ; $j+=2) { 
            if($j >=count($permission_array)-1){
                $tmp_array=array_merge($tmp_array,json_decode($permission_array[$j]));
            }else{
                $tmp_array= array_merge(json_decode($permission_array[$j]),json_decode($permission_array[($j+1)]));
            }
            
        }
        for ($k=0; $k < count($tmp_array); $k++) { 
            $permission_for_role[]=$tmp_array[$k]->permission_id;
        }
        $permission_selected_array=array();
        $permission_unselected_array=array();
        foreach ($permissions as $key => $permission) {
            if(in_array($permission->id,$permission_for_role)){
                $permission_selected_array[]=$permission;
            }else{
                $permission_unselected_array[]=$permission;
            }
        }
        $total_permission=array_merge($permission_selected_array,$permission_unselected_array);
        return response()->json(['permissions' => $total_permission,'permission_for_role'=>$permission_for_role]);
        // return $tmp_array;
        // return $permissions;
    }
}
