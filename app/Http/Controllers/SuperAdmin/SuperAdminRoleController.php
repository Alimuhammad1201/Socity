<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;
//use function PHPUnit\Framework\name;


class SuperAdminRoleController extends Controller
{

    public function AllSuperAdminRole()
    {
        $user = User::where('type', 2)->latest()->get();
        return view('superadmin.user_role.superadmin_all_role',compact('user'));
    }

    public function AddSuperAdminRole()
    {
        return view('superadmin.user_role.superadmin_create_role');
    }

    public function StoreSuperAdminRole(Request $request)
    {
        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('upload/admin_images/', $fileName);
        }

        User::insert([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'phone' => $request->phone,
           'block' => $request->block,
           'invoice_type' => $request->invoice_type,
           'flat_area' => $request->flat_area,
           'flats' => $request->flats,
           'visitors' => $request->visitors,
           'invoice' => $request->invoice,
           'allotment' => $request->allotment,
           'complaint' => $request->complaint,
           'adminuserregister' => $request->adminuserregister,
           'type' => 2,
           'profile_photo_path' => $fileName,
           'created_at' => Carbon::now()

        ]);
        $notification = array(
            'message' => 'Admin User Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.superadmin.user')->with($notification);
    }
    public function EditSuperAdminRole($id)
    {
        $user = User::findorFail($id);
        return view('superadmin.user_role.superadmin_edit_role',compact('user'));

    }

    public function UpdateSuperAdminRole(Request $request)
    {
        $user_id = $request->id;
//        $old_img = $request->old_image;

        if ($request->file('profile_photo_path')) {
//            unlink($old_img);
            $file = $request->file('profile_photo_path');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('upload/admin_images/', $fileName);

            User::findorFail($user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'invoice_type' => $request->invoice_type,
                'flats' => $request->flats,
                'visitors' => $request->visitors,
                'invoice' => $request->invoice,
                'allotment' => $request->allotment,
                'complaint' => $request->complaint,
                'adminuserregister' => $request->adminuserregister,
                'type' => 2,
                'profile_photo_path' => $fileName,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'SuperAdmin Update Member Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('all.superadmin.user')->with($notification);


        } else {
            User::findorFail($user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'invoice_type' => $request->invoice_type,
                'flats' => $request->flats,
                'visitors' => $request->visitors,
                'invoice' => $request->invoice,
                'allotment' => $request->allotment,
                'complaint' => $request->complaint,
                'adminuserregister' => $request->adminuserregister,
                'type' => 2,
                'updated_at' => Carbon::now()
            ]);
//            dd($request->invoice_type);

            $notification = array(
                'message' => 'SuperAdmin Update Member Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('all.superadmin.user')->with($notification);
        }
    }

    public function DeleteSuperAdminRole($id)
    {
//        $user = User::findorFail($id);
//        $img = $user->profile_photo_path;
//        unlink($img);

        User::findorFail($id)->delete();

        $notification = array(
            'message' => 'SuperAdmin Delete Member Successfully',
            'alert-tyoe' => 'info',
        );
        return redirect()->back()->with($notification);

    }
}
