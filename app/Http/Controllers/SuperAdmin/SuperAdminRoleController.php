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
           'employee' => $request->employee,
           'payroll' => $request->payroll,
           'attendance' => $request->attendance,
           'leave' => $request->leave,
           'hr_notification' => $request->hr_notification,
           'activity_logs' => $request->activity_logs,
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

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move('upload/admin_images/', $fileName);

            User::findOrFail($user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'block' => $request->block ? 1 : 0,
                'invoice_type' => $request->invoice_type ? 1 : 0,
                'flat_area' => $request->flat_area ? 1 : 0,
                'flats' => $request->flats ? 1 : 0,
                'visitors' => $request->visitors ? 1 : 0,
                'invoice' => $request->invoice ? 1 : 0,
                'allotment' => $request->allotment ? 1 : 0,
                'complaint' => $request->complaint ? 1 : 0,
                'adminuserregister' => $request->adminuserregister ? 1 : 0,
                'employee' => $request->employee ? 1 : 0,
                'payroll' => $request->payroll ? 1 : 0,
                'attendance' => $request->attendance ? 1 : 0,
                'leave' => $request->leave ? 1 : 0,
                'hr_notification' => $request->hr_notification ? 1 : 0,
                'activity_logs' => $request->activity_logs ? 1 : 0,
                'type' => 2,
                'profile_photo_path' => $fileName,
                'updated_at' => Carbon::now()
            ]);

            $notification = [
                'message' => 'SuperAdmin Update Member Successfully',
                'alert-type' => 'success',
            ];
            return redirect()->route('all.superadmin.user')->with($notification);
        } else {
            User::findOrFail($user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'block' => $request->block ? 1 : 0,
                'invoice_type' => $request->invoice_type ? 1 : 0,
                'flat_area' => $request->flat_area ? 1 : 0,
                'flats' => $request->flats ? 1 : 0,
                'visitors' => $request->visitors ? 1 : 0,
                'invoice' => $request->invoice ? 1 : 0,
                'allotment' => $request->allotment ? 1 : 0,
                'complaint' => $request->complaint ? 1 : 0,
                'adminuserregister' => $request->adminuserregister ? 1 : 0,
                'employee' => $request->employee ? 1 : 0,
                'payroll' => $request->payroll ? 1 : 0,
                'attendance' => $request->attendance ? 1 : 0,
                'leave' => $request->leave ? 1 : 0,
                'hr_notification' => $request->hr_notification ? 1 : 0,
                'activity_logs' => $request->activity_logs ? 1 : 0,
                'type' => 2,
                'updated_at' => Carbon::now()
            ]);

            $notification = [
                'message' => 'SuperAdmin Update Member Successfully',
                'alert-type' => 'success',
            ];
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
