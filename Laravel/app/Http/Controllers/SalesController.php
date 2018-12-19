<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;
use DOMPDF;
use Session;

class SalesController extends Controller {

    public function record_sale(Request $request) {
        $input = $request->all();



        $cart = Session::get('items');
        $session_id = Session::getId();
        $sales_items = DB::table('sales')
                ->where('session_id', $session_id)
                ->first();

        if (!empty($cart)) {
            $price = 0;
            foreach ($cart as $c) {
                $cart_items[] = DB::table('items')
                        ->where('item_id', $c['item_id'])
                        ->first();

                $prices = DB::table('items')
                        ->where('item_id', $c['item_id'])
                        ->first();
                $price +=$prices->price;
            }
        }


        if (!empty($input)) {

            $array1 = [
                'item_id' => $input['item_id'],
            ];

            Session::push('items', $array1);
            return redirect('sales/record_sale')
                            ->with('success', 'Item Added.');
            exit;
        } else {
            $categories = DB::table('categories')
                    ->get();
            $items = DB::table('items')
                    ->get();
            $rolecode = explode(",", Auth::user()->role_code);
            if (in_array('SA', $rolecode)) {
                $users = DB::table('users')
                        ->where('title', 'like', '%CASHIER%')
                        ->get();
            } else {
                $users = DB::table('users')
                        ->where('title', 'like', '%CASHIER%')
                        ->where('id', '=', Auth::user()->id)
                        ->get();
            }

           
            return view('sales.record_sale', compact('users', 'items', 'categories', 'cart_items', 'price', 'sales_items'));
        }
    }

    public function insert_items_sale(Request $request) {
        $input = $request->all();
        if (!empty($input)) {


            $array1 = ['total_items_price' => $input['total_items_price'],
                'item_discount_percentage' => $input['item_discount_percentage'],
                'item_discount_amount' => $input['item_discount_amount'],
                'vat' => $input['vat'],
                'total_price' => $input['total_price'],
                'amount_paid' => $input['amount_paid'],
                'change' => $input['change'],
                'payment_type' => $input['payment_type'],
                'cashier_id' => $input['cashier_id'],
                'date_of_purchase' => strtotime(date('d-m-Y')),
                'session_id' => Session::getId()
            ];


            $id = DB::table('sales')
                    ->insertGetId($array1);
            if ($id) {

                $cart = Session::get('items');

                if (!empty($cart)) {

                    foreach ($cart as $c) {

                        $cart_item = DB::table('items')
                                ->where('item_id', $c['item_id'])
                                ->first();

                        $cart = ['sale_id' => $id,
                            'item_id' => $cart_item->item_id,
                            'sales_price' => $cart_item->price
                        ];
                        DB::table('sales_items')
                                ->insert($cart);

                        $count = DB::table('items')
                                ->where('item_id', '=', $cart_item->item_id)
                                ->lists('current_items_no');

                        $items = DB::table('items')
                                ->where('item_id', '=', $cart_item->item_id)
                                ->update(['current_items_no' => $count[0] - 1]);
                    }
                }

                return redirect('sales/record_sale')
                                ->with('success', 'Items Saved');
            }
        }
    }

    public function new_record_sale(Request $request) {
        $request->session()->forget('items');
        $request->session()->regenerate();
        return redirect('sales/record_sale');
    }

    public function new_layby_sale(Request $request) {
        $request->session()->forget('items');
        $request->session()->regenerate();
        return redirect('sales/new_layby');
    }

    public function email_receipt(Request $request, $id = null) {
        require_once( base_path() . '/dom/dompdf_config.inc.php');
        $input = $request->all();
        $email = $request['email'];
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Redirect()->back()->with('danger', 'Please enter valid E-mail address');
        }

        $sale_id = $request['sale_id'];

        if (isset($sale_id) && !empty($sale_id)) {
            $id = $sale_id;
        }
        $dompdf = new DOMPDF();

        $items = DB::table('sales')
                ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                ->where('sales.sale_id', '=', $id)
                ->get();
        $user = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();

        $full = view('pdf.sale_archive_receipt', compact('items', 'user'));
        $message = 'Sales Receipt  ';


        $dompdf->load_html($full);
        $dompdf->render();
        $output = $dompdf->output();

        $file_name = date("ymdHi") . "_report.pdf";

        //     $dompdf->stream($file_name);

        $file_to_save = base_path() . '/pdf/' . $file_name;
        file_put_contents($file_to_save, $output);
        $subject = "Sales Report";

        $this->simple_mail_with_file(array($email), $subject, $message, array($file_to_save));
        return Redirect()->back()->with('success', 'Email Sent');
    }

    public function archive_receipt($id = null) {
        require_once( base_path() . '/dom/dompdf_config.inc.php');

        $dompdf = new DOMPDF();

        $items = DB::table('sales')
                ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                ->where('sales.sale_id', '=', $id)
                ->get();

        $user = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();

        $full = view('pdf.sale_archive_receipt', compact('items', 'user'));





        $dompdf->load_html($full);
        $dompdf->render();
        $output = $dompdf->output();

        $file_name = date("ymdHi") . "_archive_receipt.pdf";

        $dompdf->stream($file_name);

        $file_to_save = base_path() . '/pdf/' . $file_name;
        file_put_contents($file_to_save, $output);

        exit;
    }

    public function print_receipt($id = null) {
        require_once( base_path() . '/dom/dompdf_config.inc.php');

        $dompdf = new DOMPDF();

        $items = DB::table('sales')
                ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                ->where('sales.sale_id', '=', $id)
                ->get();
        $user = DB::table('users')
                ->where('id', Auth::user()->id)
                ->first();

        $full = view('pdf.sale_archive_receipt', compact('items', 'user'));


        $dompdf->load_html($full);
        $dompdf->render();
        $output = $dompdf->output();

        $file_name = date("ymdHi") . "_print_receipt.pdf";

        //  $dompdf->stream($file_name);

        $file_to_save = base_path() . '/pdf/' . $file_name;
        file_put_contents($file_to_save, $output);

        $dompdf->stream($file_name, array('Attachment' => 0));
    }

    public function get_products($id = null) {


        $products = DB::table('items')
                ->where('item_category_id', '=', $id)
                ->get();
        ?>
        <option value="0">Select Product</option>
        <?php
        if (!empty($products)) {
            foreach ($products as $item) {
                ?>
                <option value="<?= $item->item_id ?>"><?= $item->item_name ?> (Size : <?= $item->size ?>)</option>
                <?php
            }
        }
        exit;
    }

    public function get_product_info($id = null) {


        $items = DB::table('items')
                ->where('item_id', '=', $id)
                ->get();
        echo json_encode($items);
        exit;
    }

    public function sale_item_barcode($id = null) {


        $items = DB::table('items')
                ->where('barcode_number', '=', $id)
                ->get();
        echo json_encode($items);
        exit;
    }

    public function record_layby(Request $request) {
        $input = $request->all();
        if (!empty($input)) {


            $array1 = [
                'item_id' => $input['item_id'],
                'item_discount_percentage' => $input['item_discount_percentage'],
                'item_discount_amount' => $input['item_discount_amount'],
                'vat' => $input['vat'],
                'total_price' => $input['total_price'],
                'amount_paid' => $input['amount_paid'],
                'change' => $input['change'],
                'payment_type' => $input['payment_type'],
                'cashier_id' => $input['cashier_id'],
                'date_of_purchase' => strtotime(date('d-m-Y'))
            ];

            $id = DB::table('sales')
                    ->insertGetId($array1);
            if ($id) {
                $count = DB::table('items')
                        ->where('item_id', '=', $input['item_id'])
                        ->lists('current_items_no');

                $items = DB::table('items')
                        ->where('item_id', '=', $input['item_id'])
                        ->update(['current_items_no' => $count[0] - 1]);
                return redirect('sales/record_sale')
                                ->with('success', 'Success');
            }
        } else {
            $items = DB::table('items')
                    ->get();
            $categories = DB::table('categories')
                    ->get();

            $rolecode = explode(",", Auth::user()->role_code);
            if (in_array('SA', $rolecode)) {
                $users = DB::table('users')
                        ->where('title', 'like', '%CASHIER%')
                        ->get();
            } else {
                $users = DB::table('users')
                        ->where('title', 'like', '%CASHIER%')
                        ->where('id', '=', Auth::user()->id)
                        ->get();
            }



            return view('sales.record_layby', compact('users', 'items', 'categories'));
        }
    }

    public function new_layby(Request $request) {
        $input = $request->all();
        $cart = Session::get('items');
        $session_id = Session::getId();
        $sales_items = DB::table('sales')
                ->where('session_id', $session_id)
                ->first();

        if (!empty($cart)) {
            $price = 0;
            foreach ($cart as $c) {
                $cart_items[] = DB::table('items')
                        ->where('item_id', $c['item_id'])
                        ->first();

                $prices = DB::table('items')
                        ->where('item_id', $c['item_id'])
                        ->first();
                $price +=$prices->price;
            }
        }
        if (!empty($input)) {
            $array1 = [
                'item_id' => $input['item_id'],
            ];

            Session::push('items', $array1);
            return redirect('sales/new_layby')
                            ->with('success', 'Item Added.');
        } else {
            $items = DB::table('items')
                    ->get();
            $categories = DB::table('categories')
                    ->get();
            $users = DB::table('users')
                    ->where('title', 'like', '%CASHIER%')
                    ->get();
            return view('sales.record_layby', compact('users', 'items', 'categories', 'sales_items', 'price', 'cart_items'));
        }
    }

    public function insert_record_layby(Request $request) {
        $input = $request->all();
        if (!empty($input)) {


            $array1 = [
                'total_items_price' => $input['total_items_price'],
                'item_discount_percentage' => $input['item_discount_percentage'],
                'item_discount_amount' => $input['item_discount_amount'],
                'total_price' => $input['total_price'],
                'amount_paid' => $input['amount_paid'],
                'change' => $input['change'],
                'payment_type' => $input['payment_type'],
                'cashier_id' => $input['cashier_id'],
                'date_of_purchase' => strtotime(date('d-m-Y')),
                //  'intial_date' => $input['intial_date'],
                'is_layby' => 1,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email_id' => $input['email_id'],
                'tel' => $input['tel'],
                'remained_amount' => number_format($input['total_price'] - $input['amount_paid'], 2),
                'due_date_remain_payment' => $input['due_date_remain_payment'],
                'session_id' => Session::getId()
            ];


            $id = DB::table('sales')
                    ->insertGetId($array1);
            if ($id) {

                $cart = Session::get('items');

                if (!empty($cart)) {

                    foreach ($cart as $c) {

                        $cart_item = DB::table('items')
                                ->where('item_id', $c['item_id'])
                                ->first();

                        $cart = ['sale_id' => $id,
                            'item_id' => $cart_item->item_id,
                            'sales_price' => $cart_item->price
                        ];
                        DB::table('sales_items')
                                ->insert($cart);

                        $count = DB::table('items')
                                ->where('item_id', '=', $cart_item->item_id)
                                ->lists('current_items_no');

                        $items = DB::table('items')
                                ->where('item_id', '=', $cart_item->item_id)
                                ->update(['current_items_no' => $count[0] - 1]);
                    }
                }

                return redirect('sales/new_layby')
                                ->with('success', 'Items Saved');
            }
        }
    }

    public function settle_layby(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $sale = DB::table('sales')
                    ->where('sale_id', '=', $input['sale_id'])
                    ->first();

            $array1 = [
                'payment_type' => $input['payment_type'],
                'cashier_id' => $input['cashier_id'],
                'amount_paid' => $input['amount_paid'] + $sale->amount_paid,
                'remained_amount' => number_format($sale->remained_amount - $input['amount_paid'], 2),
                'change' => $input['change'],
            ];

            $id = DB::table('sales')
                    ->where('sale_id', '=', $input['sale_id'])
                    ->update($array1);
            if ($id) {
                return redirect('sales/settle_layby')
                                ->with('success', 'Success');
            }
        } else {
            $sales = DB::table('sales')
                    ->where('is_layby', '=', 1)
                    ->get();
            $users = DB::table('users')
                    ->where('title', 'like', '%CASHIER%')
                    ->get();

            return view('sales.settle_layby', compact('sales', 'users'));
        }
    }

    public function sale_item_info($id = null) {
        $items = DB::table('sales')
                ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                ->where('sales.sale_id', '=', $id)
                ->get();
        ?>
        <div class="col-md-12" >
            <div class="table-responsive">
                <h3>Items Added</h3>
                <table class="table table-striped b-t b-b dataTable no-footer">
                    <thead>
                        <tr><th>Item No</th><th>Item Name</th><th>Barcode Number</th><th>Item Description</th><th>Size</th><th>Colour</th><th>Price</th></tr>
                    </thead>
                    <tbody >
                        <?php
                        if (!empty($items)) {
                            $i = 1;
                            foreach ($items as $ci) {
                                ?>
                                <tr><td><?= $i ?></td><td><?= $ci->item_name ?></td><td><?= $ci->barcode_number ?></td><td><?= $ci->item_desc ?></td><td><?= $ci->size ?></td><td><?= $ci->color ?></td><td>R <?= $ci->price ?></td></tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">

            <div class="form-group">
                <label for="exampleInputPassword1">OUTSTANDING AMOUNT</label>
                <input type="text" class="form-control" name="remained_amount" value="<?= $items[0]->remained_amount ?>" id="remained_amount" required >
            </div>                                     
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputPassword1">AMOUNT PAID</label>
                <input type="text" id="amount_paid_settle_layby" class="form-control " value="<?= $items[0]->amount_paid ?>" name="amount_paid"  required >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputPassword1">CHANGE</label>
                <input type="text" class="form-control " name="change" value="<?= $items[0]->change ?>" id="change" required >
            </div>
        </div>
        <?php
        exit;
    }

    public function daily_finance_sales(Request $request) {
        $input = $request->all();

        if (!empty($input)) {
            require_once( base_path() . '/dom/dompdf_config.inc.php');

            $dompdf = new DOMPDF();


            $start_date = $input['start_date'];
            $end_date = $input['end_date'];
            $items = DB::table('sales')
                    ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                    ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                    ->groupBy('sales_items.item_id')
                    ->get();
            $cash_amount = 0;
            $card_amount = 0;
            $commision = 0;
            foreach ($items as $item) {
                $total_itm = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->count();
                $cash_sales = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->where('sales.payment_type', 'Cash')
                        ->count();
                $card_sales = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->where('sales.payment_type', 'Debit/Credit Card')
                        ->count();
                $layby = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->where('sales.is_layby', 1)
                        ->count();
                $cash_total = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->where('sales.payment_type', 'Cash')
                        ->sum('sales.total_price');
                $card_total = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->where('payment_type', 'Debit/Credit Card')
                        ->sum('sales.total_price');
                $total = DB::table('sales')
                        ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                        ->where('sales_items.item_id', $item->item_id)
                        ->sum('sales.total_price');
                $commision += $total_itm * $item->commission_amount;

                $array = array('total_itm' => $total_itm,
                    'cash_sales' => $cash_sales,
                    'card_sales' => $card_sales,
                    'layby' => $layby,
                    'cash_total' => $cash_total,
                    'card_total' => $card_total,
                    'total' => $total,
                );
                $cash_amount +=$cash_total;
                $card_amount +=$card_total;
                $arr1 = json_decode(json_encode($item), true);
                $arr2 = json_decode(json_encode($array), true);



                $get_all_pck_infos[] = array_merge($arr1, $arr2);
            }





            $daily_cash_float = DB::table('daily_cash_float')
                    ->whereBetween('date', array($start_date, $end_date))
                    ->sum('float_amount');
            if (empty($daily_cash_float)) {
                $daily_cash_float = 0;
            }
            $cash_card_total = $cash_amount + $card_amount;

            $full_of_array = array('daily_cash_float' => $daily_cash_float,
                'cash_amount' => $cash_amount,
                'card_amount' => $card_amount,
                'cash_card_total' => $cash_card_total,
                'commision' => $commision,
                'result' => $cash_card_total - $commision
            );


            $full = view('pdf.daily_finance_sales', compact('get_all_pck_infos', 'full_of_array', 'start_date', 'end_date'));


            if (isset($input['archive_report'])) {


                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_invoice.pdf";

                $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);
            }

            if (isset($input['email_report'])) {


                $message .=' Test  ';


                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_report.pdf";

                //     $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);






                $subject = "Sales Report";

                if ($this->simple_mail_with_file('tptankit@gmail.com', $subject, $message, $file_to_save)) {
                    //  return Redirect::back()->with('success', 'Email Sent');
                } else {
                    //   return Redirect::back()->with('success', 'Email Sent');
                }
            }

            if (isset($input['print'])) {
                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_invoice.pdf";

                //  $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);

                $dompdf->stream($file_name, array('Attachment' => 0));
            }
        }
        return view('sales.daily_finance_sales', compact('get_all_pck_infos', 'full_of_array', 'start_date', 'end_date'));
    }

    public function daily_finance_cash_float(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $array1 = [
                'date' => $input['date'],
                'float_amount' => $input['float_amount']
            ];

            $id = DB::table('daily_cash_float')
                    ->insertGetId($array1);
            if ($id) {
                return redirect()->back()
                                ->with('success', 'Added');
            }
        }
        return view('sales.daily_finance_cash_float');
    }

    public function daily_finance_commision(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            require_once( base_path() . '/dom/dompdf_config.inc.php');

            $dompdf = new DOMPDF();

            $sales = DB::table('sales')
                    ->select('*', DB::raw('count(*) as total'))
                    //   ->whereBetween('date_of_purchase', array(strtotime($input['start_date']), strtotime($input['end_date'])))
                    ->join('sales_items', 'sales_items.sale_id', '=', 'sales.sale_id')
                    ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                    ->where('sales.cashier_id', $input['user_id'])
                    ->groupBy('sales_items.item_id')
                    ->get();
            $user = DB::table('users')
                    ->where('id', $input['user_id'])
                    ->first();
            $data = array('start_date' => $input['start_date'], 'end_date' => $input['end_date']);


            $full = view('pdf.daily_finance_commision', compact('sales', 'data', 'user'));


            if (isset($input['archive_report'])) {


                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_invoice.pdf";

                $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);
            }

            if (isset($input['email_report'])) {


                $message .=' Test  ';


                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_report.pdf";

                //     $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);






                $subject = "Commision Report";

                if ($this->simple_mail_with_file('tptankit@gmail.com', $subject, $message, $file_to_save)) {
                    //  return Redirect::back()->with('success', 'Email Sent');
                } else {
                    //   return Redirect::back()->with('success', 'Email Sent');
                }
            }

            if (isset($input['print'])) {
                $dompdf->load_html($full);
                $dompdf->render();
                $output = $dompdf->output();

                $file_name = date("ymdHi") . "_invoice.pdf";

                //  $dompdf->stream($file_name);

                $file_to_save = base_path() . '/pdf/' . $file_name;
                file_put_contents($file_to_save, $output);

                $dompdf->stream($file_name, array('Attachment' => 0));
            }
        }
        $users = DB::table('users')
                ->where('title', 'like', '%CASHIER%')
                ->get();
        return view('sales.daily_finance_commision', compact('users', 'sales', 'data'));
    }

    public function add_project(Request $request) {
        $input = $request->all();
        if (!empty($input)) {


            $array1 = [
                'project_name' => $input['project_name'],
                'client_id' => $input['client_id'],
                'type' => $input['type']
            ];

            $id = DB::table('projects')
                    ->insertGetId($array1);
            if ($id) {
                return redirect('manager/add_project_2/' . $id);
            }
        }
        $clients = DB::table('clients')
                ->get();

        $types = DB::table('types')
                ->get();
        return view('manager.project_add', compact('types', 'clients'));
    }

    public function add_project_2($id = null) {
        $consultant = DB::table('users')
                ->join('user_details', 'user_details.user_id', '=', 'users.id')
                // ->where('users.created_by', Auth::user()->id)
                ->where('users.user_type', 'em')
                ->get();
        return view('manager.project_add_2', compact('id', 'consultant'));
    }

    public function project_delete($id = null) {

        DB::table('projects')->where('project_id', $id)
                ->delete();
        DB::table('project_co')->where('project_id', $id)
                ->delete();
        return redirect()->back()
                        ->with('success', 'Project Deleted');
    }

    public function sale_transactions(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $sales = DB::table('sales')
                    ->join('users', 'users.id', '=', 'sales.cashier_id')
                    ->where('sales.is_layby', 0)
                    ->whereBetween('sales.date_of_purchase', array(strtolower($input['start_date']), strtolower($input['end_date'])))
                    ->get();
        } else {
            $sales = DB::table('sales')
                    ->join('users', 'users.id', '=', 'sales.cashier_id')
                    ->where('sales.is_layby', 0)
                    ->get();
        }
        $data = $input;

        $lists = array();
        if (!empty($sales)) {
            foreach ($sales as $sale) {
                $sale_item = DB::table('sales_items')
                        ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                        ->where('sales_items.sale_id', $sale->sale_id)
                        ->get();

                $arr1 = json_decode(json_encode($sale), true);
                $arr2 = json_decode(json_encode(array('items_list' => $sale_item)), true);



                $lists[] = (object) array_merge($arr1, $arr2);
            }
        }


        return view('sales.sale_transactions', compact('lists', 'data'));
    }

    public function layby_transactions(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $sales = DB::table('sales')
                    ->join('users', 'users.id', '=', 'sales.cashier_id')
                    ->where('sales.is_layby', 1)
                    ->whereBetween('sales.date_of_purchase', array(strtolower($input['start_date']), strtolower($input['end_date'])))
                    ->get();
        } else {
            $sales = DB::table('sales')
                    ->join('users', 'users.id', '=', 'sales.cashier_id')
                    ->where('sales.is_layby', 1)
                    ->get();
        }
        $data = $input;

        $lists = array();
        if (!empty($sales)) {
            foreach ($sales as $sale) {
                $sale_item = DB::table('sales_items')
                        ->join('items', 'items.item_id', '=', 'sales_items.item_id')
                        ->where('sales_items.sale_id', $sale->sale_id)
                        ->get();

                $arr1 = json_decode(json_encode($sale), true);
                $arr2 = json_decode(json_encode(array('items_list' => $sale_item)), true);



                $lists[] = (object) array_merge($arr1, $arr2);
            }
        }

        return view('sales.layby_transactions', compact('lists', 'data'));
    }

    public function transaction_delete(Request $request) {
        $input = $request->all();
        if (!empty($input)) {

            if (!isset($input['delete'])) {
                return redirect()->back()
                                ->with('danger', 'Please select atleast one record');
            }
            $sale_id = $input['delete'];
            DB::table('sales')->whereIn('sale_id', $sale_id)
                    ->delete();
            DB::table('sales_items')->whereIn('sale_id', $sale_id)
                    ->delete();
            DB::table('sales_layby')->whereIn('sales_id', $sale_id)
                    ->delete();
            return redirect()->back()
                            ->with('success', 'Transaction record(s) Deleted');
        }
    }

}
