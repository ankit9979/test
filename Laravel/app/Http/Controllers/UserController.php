<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Validator;
use App\User;
use DB;
use DOMPDF;

class UserController extends Controller {

    public function login(Request $request) {

        $input = $request->all();

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {


            return redirect('home/notification')->with('success', 'Login Sucessfully!');
        } else {
            return redirect()->back()->withInput()
                            ->with('danger', 'Username and Password are not matched');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/')->with('success', 'Logout Sucessfully!');
    }

    public function time(Request $request) {
        $input = $request->all();

        $times = DB::table('times')
                ->where('date', date('d-m-Y'))
                ->where('user_id', Auth::user()->id)
                ->first();


        if (!empty($input)) {
            if (isset($input['history'])) {

                $history = DB::table('times')
                        ->where('user_id', Auth::user()->id)
                        ->whereBetween('date', array($input['date1'], $input['date2']))
                        ->get();
            }




            if (isset($input['time_in']) && $input['time_in'] != null && $input['time_in'] != " ") {

                $array = [

                    'user_id' => Auth::user()->id,
                    'date' => date('d-m-Y'),
                    'time_in' => $input['time_in'],
                ];

                if (empty($times)) {

                    $insert = DB::table('times')
                            ->insert($array);
                } else {
                    DB::table('times')
                            ->where('date', date('d-m-Y'))
                            ->where('user_id', Auth::user()->id)
                            ->update($array);
                }
                return redirect()->back()->with('success', 'Clock in Time Submitted.');
            }
            if (isset($input['time_out']) && $input['time_out'] != null && $input['time_out'] != " ") {

                $duration = $this->timeDiff($input['time_out'], $times->time_in);
                $array2 = [
                    'time_out' => $input['time_out'],
                    'duration' => $duration,
                ];
                DB::table('times')
                        ->where('date', date('d-m-Y'))
                        ->where('user_id', Auth::user()->id)
                        ->update($array2);
                return redirect()->back()->with('success', 'Clock out time Submitted.');
            }
        }

        return view('home.time', compact('times', 'history'));
    }

    public function employee_timesheet_one(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            return redirect('home/employee_timesheet_one/' . $input['employee_id'] . '/' . $input['date1'] . '/' . $input['date2']);
        }
        $empolyees = DB::table('users')
                ->get();
        return view('employee.one_employee', compact('empolyees'));
    }

    public function employee_timesheet($id, $date1, $date2) {


        $empolyees = DB::table('users')
                ->get();
        $history = DB::table('times')
                ->where('user_id', $id)
                ->whereBetween('date', array($date1, $date2))
                ->get();
        return view('employee.one_employee', compact('id', 'empolyees', 'history'));
    }

    public function employee_timesheet_delete(Request $request) {
        $input = $request->all();
        if (empty($input['delete'])) {
            return redirect()->back()->with('danger', 'Please select atleast one date');
        }

        DB::table('times')
                ->whereIn('time_id', $input['delete'])
                ->delete();
        return redirect()->back()->with('success', 'Selected History Deleted.');
    }

    public function employee_timesheet_all(Request $request) {
        $input = $request->all();
        $empolyees = DB::table('users')
                ->get();

        if (!empty($empolyees) && !empty($input)) {
            foreach ($empolyees as $empolyee) {
                $histories = DB::table('times')
                        ->where('user_id', $empolyee->id)
                        ->whereBetween('date', array($input['date1'], $input['date2'],))
                        ->get();
                if (!empty($histories)) {
                    $time_t = 0;
                    foreach ($histories as $history) {
                        $time = explode(':', $history->duration);
                        if (count($time) > 1) {
                            $time_t += $time[0] * 3600 + $time[1] * 60;
                        } else {
                            $time_t += $time[0] * 3600;
                        }
                    }
                    $h1 = floor($time_t / 3600);
                    $m1 = strval(floor(($time_t % 3600) / 60));
                    if ($m1 == 0) {
                        $m1 = "00";
                    } else {
                        $m1 = $m1;
                    }
                    $total_hour = $h1 . ":" . $m1;
                    $arr1 = json_decode(json_encode($empolyee), true);
                    $arr2 = json_decode(json_encode(array('total_hour' => $total_hour)), true);
                    $arr3 = json_decode(json_encode(array('total_day' => count($histories))), true);
                    $arr4 = json_decode(json_encode(array('leave' => count($histories) / 17)), true);
                    $get_all_emps[] = (object) array_merge($arr1, $arr2, $arr3, $arr4);
                } else {
                    $arr1 = json_decode(json_encode($empolyee), true);
                    $arr2 = json_decode(json_encode(array('total_hour' => 0)), true);
                    $arr3 = json_decode(json_encode(array('total_day' => count($histories))), true);
                    $arr4 = json_decode(json_encode(array('leave' => 0)), true);
                    $get_all_emps[] = (object) array_merge($arr1, $arr2, $arr3, $arr4);
                }
            }
        }

        return view('employee.all_employee', compact('times', 'get_all_emps'));
    }

    public function notification(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            if (isset($input['delete']) && !empty($input['delete'])) {
                $suc = DB::table('notification')->whereIn('notification_id', $input['delete'])->delete();
                if ($suc) {
                    return redirect()->back()->with('success', 'Notification Deleted');
                }
            } else {
                return redirect()->back()->with('danger', 'Please select atleast one user');
            }
        }
        $notifications = DB::table('notification')
                ->join('users', 'users.id', '=', 'notification.user_id')
                ->get();
        $lists = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->get();
        $final_data = array();
        if (!empty($lists)) {
            foreach ($lists as $list) {
                $item_lists = DB::table('items')
                        ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                        ->where('items.item_id', $list->item_id)
                        ->where('items.current_items_no', '<=', $list->critical_items_no)
                        ->first();
                if (!empty($item_lists)) {
                    $final_data[] = $item_lists;
                }
            }
        }


        return view('home.notification', compact('notifications', 'final_data'));
    }

    public function critical_items_report(Request $request) {
        $input = $request->all();
        require_once( base_path() . '/dom/dompdf_config.inc.php');
        $final_data_all = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->whereIn('items.item_id', $input['item_id'])
                ->get();


        if (!empty($final_data_all)) {

            $final_data = array();
            $i = 1;
            $j = 1;

            foreach ($final_data_all as $key => $in) {

                if ($i % 30 != 0) {
                    $final_data[$j][] = $in;
                } else {
                    $final_data[$j][] = $in;
                    $j++;
                }
                $i++;
            }
        }
        $full = view('pdf.critical_items', compact('final_data'));
        $dompdf = new DOMPDF();
        $dompdf->load_html($full);
        $dompdf->render();
        $output = $dompdf->output();

        $file_name = date("ymdHi") . "_report.pdf";

        if ($input['save'] == 'Email') {
            $file_to_save = base_path() . '/pdf/' . $file_name;
            file_put_contents($file_to_save, $output);
            $subject = "Critical Items List";
            $message = 'Please find Attachment  ';
            $this->simple_mail_with_file(array('tptankit@gmail.com'), $subject, $message, array($file_to_save));
            return Redirect()->back()->with('success', 'Email Sent');
        }

        if ($input['save'] == 'Download') {
            $dompdf->stream($file_name);
        }






        //    
    }

    public function create_notification(Request $request) {
        $input = $request->all();
        $users = DB::table('users')
                ->where('id', '!=', 1)
                ->get();
        $notifications = DB::table('notification')
                ->join('users', 'users.id', '=', 'notification.user_id')
                ->get();
        if (!empty($input)) {

            $array = [

                'user_id' => $input['user_id'],
                'notification_name' => $input['notification_name'],
                'date_of_post' => $input['date_of_post'],
                'due_date_of_noty' => $input['due_date_of_noty']
            ];
            $insert = DB::table('notification')
                    ->insert($array);
            if ($insert) {
                return redirect()->back()->with('success', 'Notification Created.');
            }
        }
        return view('home.create_notification', compact('users', 'notifications'));
    }

    public function notification_update(Request $request) {
        $input = $request->all();

        if (!empty($input)) {

            $array = [

                'user_id' => $input['user_id'],
                'notification_name' => $input['notification_name'],
                'date_of_post' => $input['date_of_post'],
                'due_date_of_noty' => $input['due_date_of_noty']
            ];
            $insert = DB::table('notification')
                    ->where('notification_id', $input['notification_id'])
                    ->update($array);
            if ($insert) {
                return redirect()->back()->with('success', 'Notification Updated.');
            }
        }
    }

    public function notification_edit($id) {
        $users = DB::table('users')
                ->where('id', '!=', 1)
                ->get();

        $notification = DB::table('notification')
                ->join('users', 'users.id', '=', 'notification.user_id')
                ->where('notification.notification_id', $id)
                ->first();

        return view('home.notification_edit', compact('users', 'notification'));
    }

    public function layby_due_dates(Request $request) {
        $input = $request->all();
        if (!empty($input)) {

            if (isset($input['item_paid']) && !empty($input['item_paid'])) {
                $item_paid = $input['item_paid'];
                DB::table('sales')
                        ->whereIn('sale_id', $item_paid)
                        ->update(['is_paid' => 1]);
                return redirect()->back()->with('success', 'Users Updated.');
            }

            if (isset($input['item_delete']) && !empty($input['item_delete'])) {
                $item_delete = $input['item_delete'];
                DB::table('sales')
                        ->whereIn('sale_id', $item_delete)
                        ->delete();
                return redirect()->back()->with('success', 'Sales Deleted.');
            }
        } else {
            $notifications = DB::table('sales')
                    ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                    ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                    ->where('sales.is_layby', 1)
                    ->where('sales.is_paid', 0)
                    ->get();
            return view('home.layby_due_dates', compact('notifications'));
        }
    }

    public function user_add(Request $request) {
//           User::create([
//
//            'email' => "ankitjogani99@gmail.com",
//            'name' => "ankit",
//            'surname' => "patel",
//            'role_code' => "SA",
//            'password' => bcrypt('admin@123')
//        ]);
        $input = $request->all();

        if (!empty($input)) {

            if (!isset($input['role_code'])) {
                return redirect()->back()->with('danger', 'Please Select Permission');
            }
            $id = User::create([

                        'email' => $input['email'],
                        'password' => bcrypt($input['password']),
                        'cpassword' => $input['password'],
                        'name' => $input['name'],
                        'surname' => $input['surname'],
                        'title' => implode(",", $input['title']),
                        'role_code' => implode(",", $input['role_code'])
            ]);
            if ($id) {
                $message = '<html><b>Dear ' . $input['name'] . ',  </b><br>
                                    <p>Your Account with Remy has been created. Please login with this username: ' . $input['email'] . ' and this password: ' . $input['password'] . ' </p>
                                    <p>Kind Regards,</p><p> Remy Team</p>
                                  </html>';



                $this->simple_mail($input['email'], "Login Detail", $message);

                return redirect()->back()->with('success', 'User added successfully!');
            } else {
                return redirect()->back()->with('danger', 'Not Inserted Sucessfully!');
            }
        } else {
            return view('user.user_add');
        }
    }

    public function users_list() {
        $users = DB::table('users')
                ->where('id', '!=', 1)
                ->get();
        return view('user.users_list', compact('users'));
    }

    public function user_profile_edit($id) {
        $user = DB::table('users')
                ->where('id', '=', $id)
                ->first();
        return view('user.user_profile_edit', compact('user'));
    }

    public function user_profile_update(Request $request) {
        $input = $request->all();

        if (!empty($input)) {
            $role_code = $input['role_code'];



            $array = array(
                'password' => bcrypt($input['password']),
                'cpassword' => $input['password'],
                'name' => $input['name'],
                'surname' => $input['surname'],
                'title' => implode(",", $input['title']),
                'role_code' => implode(",", $input['role_code']),
            );

            DB::table('users')
                    ->where('id', $input['id'])
                    ->update($array);

            return redirect()->back()->with('success', 'User Updated.');
        }
    }

    public function users_update(Request $request) {
        $input = $request->all();

        if (!empty($input)) {
            $role_code = $input['role_code'];

            if (isset($input['delete_user'])) {
                $ter = $input['delete_user'];
                if (empty($ter)) {
                    return redirect()->back()->with('danger', 'Please select User for remove');
                }
                $suc = DB::table('users')->whereIn('id', $input['delete_user'])->delete();


                if ($suc) {
                    return redirect()->back()->with('success', 'Users Updated.');
                }
            }
            foreach ($role_code as $k => $code) {
                $array = array('role_code' => implode(",", $code));

                DB::table('users')
                        ->where('id', $k)
                        ->update($array);
            }
            return redirect()->back()->with('success', 'Users Updated.');
        }
    }

    public function forgot_pass(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $email = $input['email'];
            $users = DB::table('users')->where('email', $email)->first();
            if (!empty($users)) {


                function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') {
                    $sets = array();
                    if (strpos($available_sets, 'l') !== false)
                        $sets[] = 'abcdefghjkmnpqrstuvwxyz';
                    if (strpos($available_sets, 'u') !== false)
                        $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
                    if (strpos($available_sets, 'd') !== false)
                        $sets[] = '23456789';
                    if (strpos($available_sets, 's') !== false)
                        $sets[] = '!@#$%&*?';

                    $all = '';
                    $password = '';
                    foreach ($sets as $set) {
                        $password .= $set[array_rand(str_split($set))];
                        $all .= $set;
                    }

                    $all = str_split($all);
                    for ($i = 0; $i < $length - count($sets); $i++)
                        $password .= $all[array_rand($all)];

                    $password = str_shuffle($password);

                    if (!$add_dashes)
                        return $password;

                    $dash_len = floor(sqrt($length));
                    $dash_str = '';
                    while (strlen($password) > $dash_len) {
                        $dash_str .= substr($password, 0, $dash_len) . '-';
                        $password = substr($password, $dash_len);
                    }
                    $dash_str .= $password;
                    return $dash_str;
                }

                $pass = generateStrongPassword();
                $up = DB::table('users')
                        ->where('id', $users->id)
                        ->update(['password' => bcrypt($pass), 'cpassword' => $pass]);
                if ($up) {

                    $message = '<html><b>Dear ' . $users->name . ' ' . $users->surname . ',  </b><br>
                                    <p> Your password has changed. Please login with this password:' . $pass . '                                 </p>
                                   </html>';
                    $this->simple_mail($input['email'], "Scanner Project", $message);



                    return redirect()->back()->with('success', 'Your new password has been changed. Please check your mail for new password.');
                }
            } else {

                return redirect()->back()->with('danger', 'No username found');
            }
        } else {
            return view('forgot_password');
        }
    }

    public function edit_profile(Request $request) {

        $input = $request->all();
        if (!empty($input)) {


            $user_id = Auth::user()->id;

            if (isset($input['image'])) {
                if (Auth::user()->photo != NULL) {
                    $destinationPath_unlink = public_path() . '/userimg/' . Auth::user()->photo;
                    if (file_exists($destinationPath_unlink)) {
                        unlink($destinationPath_unlink);
                    }
                }
                $file = $input['image'];
                $destinationPath = public_path() . '/userimg/';
                $filename = time() . '_' . $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $filename);



                chmod($destinationPath . $filename, 0777);
                $this->load($destinationPath . $filename);
                $this->resizeToWidth(150);



                $this->save_img($destinationPath . $filename);

                $user = User::find($user_id);

                $user->photo = $filename;
                $user->save();
            }
            $array = [

                'password' => bcrypt($input['password']),
                'cpassword' => $input['password'],
                'name' => $input['name'],
                'surname' => $input['surname']
            ];
            $update = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update($array);
            if ($update) {
                return redirect()->back()->with('success', 'Data Updated Sucessfully!');
            } else {
                return redirect()->back()->with('danger', 'Something went wrong!');
            }
        } else {
            $users = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->first();

            return view('user.edit_profile', compact('users'));
        }
    }

    public function user_detail($id) {
        $users = DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_id')
                ->where('id', $id)
                ->first();

        return view('manager.user_add', compact('users'));
    }

}
