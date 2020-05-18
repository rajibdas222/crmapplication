<?php

namespace App\Http\Controllers;

use App\User;
use App\users_details;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Session;
use Spatie\Permission\Models\Role;

class UserManagement extends Controller
{
    /**
     * Show the page to manage User.
     *
     * @param  Request $request
     * @return A success message as Json format
     */
    public function userCreate(Request $request)
    {
        if (!($validation_name = Validator::make($request->all(), ['name' => 'required|max:50'])->passes())) {
            return $result = response()->json(['message' => 'name_required']);
        }
        if (!($validation_email = Validator::make($request->all(), ['email' => 'required|min:6|email'])->passes())) {
            return $result = response()->json(['message' => 'email_required']);
        }
        if (!($validation_pass = Validator::make($request->all(), ['password' => 'required|min:6'])->passes())) {
            return $result = response()->json(['message' => 'pass_required']);
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $hash_password = Hash::make($password);
        $user_exist = User::where('email', $email)->first();
        if ($user_exist) {
            return $result = response()->json(['message' => 'invalid']);
        } else {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = $hash_password;
            $user->save();
            $last_user_id = $user->id;
            $user_details = new users_details;
            $user_details->users_id = $last_user_id;
            $user_details->save();
            $users = User::findOrFail($last_user_id);

            $roles = $request->roles;
            $role = Role::find($roles);
            $user_role = User::findOrFail($last_user_id);
            $user_role->syncRoles();
            $user_role->assignRole($roles);
            //$users->assignRole('User');
            $permission_id = $request->permissions;
            // $permission = Permission::all();
            // $users->revokePermissionTo($permission);
            $users->syncPermissions($permission_id);
            return $result = response()->json(['message' => 'success']);
        }

    }

    public function userDelete($user_id)
    {
        $user_info = User::where('id', $user_id)->first();
        if (!$user_info) {

            return response()->json(['user_name' => '', 'message' => __('messages.user_deleted'), 'class_name' => 'alert-success']);
        }
        $user_name = $user_info['name'];
        $detail_exist = users_details::where('users_id', $user_id)->first();
        User::where('id', $user_id)->delete();
        if ($detail_exist) {
            $image_exists = $detail_exist['image'];
            $filename = public_path() . '/backend/images/users/' . $image_exists;
            if (file_exists($filename)) {
                @unlink($filename);
            }
            users_details::where('users_id', $user_id)->delete();

        }
        return response()->json(['user_name' => $user_name, 'message' => __('messages.user_deleted'), 'class_name' => 'alert-success']);

    }

    /**
     * All user list.
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        $title = __('messages.manage_users');
        $active = 'user_list';
        $users = User::get();
        return view('backend.user.user_list', compact('users', 'active', 'title'));
    }
    /**
     * A single user details.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function userDetails(Request $request)
    {
        $user_id = $request->user_id;

        if ($user_id == "553456382u6hsdgh") {
            $user_false_id = $user_id;
            $user_id = Auth::user()->id;
        } else {
            $user_false_id = $user_id;
        }

        $users = DB::select("select * from users as u left join users_details as ud on u.id=ud.users_id where u.id='$user_id'");
        return view('backend.user.user_update', compact('users', 'user_false_id'));
    }
    /**
     * A single user update.
     *
     * @param  Request $request
     * @return A success or fail message return as json formated
     */

    public function userUpdate(Request $request)
    {
        if (!($validation_fname = Validator::make($request->all(), ['f_name' => 'max:20'])->passes())) {
            return $result = response()->json(['message' => __('messages.fname_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_lname = Validator::make($request->all(), ['l_name' => 'max:20'])->passes())) {
            return $result = response()->json(['message' => __('messages.lname_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_full_name = Validator::make($request->all(), ['full_name' => 'max:50'])->passes())) {
            return $result = response()->json(['message' => __('messages.full_name_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_email = Validator::make($request->all(), ['email' => 'required|min:6|email'])->passes())) {
            return $result = response()->json(['message' => __('messages.email_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_phone = Validator::make($request->all(), ['phone' => 'max:50'])->passes())) {
            return $result = response()->json(['message' => __('messages.phone_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_dob = Validator::make($request->all(), ['dob' => 'date'])->passes())) {
            return $result = response()->json(['message' => __('messages.dob_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if (!($validation_image = Validator::make($request->all(), ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'])->passes())) {
            return $result = response()->json(['message' => __('messages.select_image'), 'status_code' => 0]);
        }
        if (!($validation_postal = Validator::make($request->all(), ['postal_code' => 'max:20'])->passes())) {
            return $result = response()->json(['message' => __('messages.postal_required'), 'class_name' => 'alert-danger', 'status_code' => 0]);
        }
        if ($request->id == "553456382u6hsdgh") {
            $user_id = Auth::user()->id;
        } else {

            if (Auth::user()->can('update_users')) {
                $user_id = $request->id;
                \Log::info('Admin Update');
            } else {
                \Log::info('No permission');
                return $result = response()->json(['message' => __('messages.no_permission_change_email'), 'class_name' => 'alert-danger', 'status_code' => 0]);
            }

        }

        $email = $request->email;

        $user = User::find($user_id);
        $user_all_data = User::where('id', '=', $user_id)->first();
        $user_details_data = users_details::where('users_id', '=', $user_id)->first();

        $user_email_exist = $user_all_data->email;
        if ($user_email_exist != $email) {
            if (User::where('email', '=', $email)->exists()) {
                return $result = response()->json(['message' => __('messages.email_exist'), 'class_name' => 'alert-danger', 'status_code' => 0]);
            }
        }
        \Log::info('User Email=' . $user_email_exist);
        \Log::info('User checked');
        $name = $request->full_name;
        $user->id = $user_id;
        $user->name = $name;
        $user->email = $email;

        $user->save();
        \Log::info('User Saved');
        // $image_full_path = "";
        $file_name = '';

        $file_name_db = $user_details_data['image'];

        \Log::info('file_name_db=' . $file_name_db);
        if ($request->hasFile('image')) {
            if ($file_name_db != '') {
                $image_exists = $file_name_db;
                $filename = storage_path() . '/app/' . config('const.USER_UPLOAD_IMAGES_PATH') . $image_exists;
                \Log::info('file_name_new=' . $filename);
                if (file_exists($filename)) {
                    @unlink($filename);
                }
                \Log::info('User Image path' . $filename);

            }
            // save image file to storage
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->storeAs(config('const.USER_UPLOAD_IMAGES_PATH'), $file_name);
            \Log::info('New Image Name' . $file_name);

        } else {
            $file_name = $file_name_db;
        }
        \Log::info('New Image Name=' . $file_name);
        $update_array = array(
            'first_name' => $request->f_name,
            'last_name' => $request->l_name,
            'phone' => $request->phone,
            'date_of_birth' => $request->dob,
            'gender' => $request->gender,
            'postal_code' => $request->postal_code,
            'image' => $file_name,
        );

        \Log::info('Updated');

        $update = users_details::where('users_id', $user_id)
            ->update($update_array);
        \Log::info('AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA User Updated ');
        Session::flash('message', __('messages.user_update'));
        Session::flash('class_name', 'alert-success');
        return $result = response()->json(['message' => __('messages.user_update'), 'class_name' => 'alert-success', 'status_code' => 1]);

    }

/**
 * Change password for an user.
 *
 * @param  Request $request
 * @return A success or fail message return as json formated
 */
    public function changePassword(Request $request)
    {
        // return $request->all();
        $user_id = $request->user_id;
        $password = $request->password;
        $validation = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);
        if ($validation->passes()) {
            $user_id = $request->user_id;
            $password = $request->password;
            $hashed_password = Hash::make($password);
            $user = User::find($user_id);
            $user->password = $hashed_password;
            $user->save();
            Session::flash('message', __('messages.password_changed'));
            Session::flash('class_name', 'alert-success');
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'invalid']);
        }
    }

}
