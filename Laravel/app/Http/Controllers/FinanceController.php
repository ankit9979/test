<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;
use DOMPDF;

class FinanceController extends Controller {

    public function item_cost_price(Request $request) {
        $input = $request->all();
        $items = DB::table('items')
                ->get();
        if (!empty($input)) {
         

          
            $array[] = array('Item Name', 'Item Description', 'Barcode Number', 'Size', 'Cost Price', 'Sale Price');
            foreach ($items as $item) {
                $array[] = array($item->item_name, $item->item_desc, $item->barcode_number, $item->size, $item->cost_price, $item->price,);
            }
          

            $this->convert_to_csv($array, 'items.csv', ',');
            exit;
        }

        return view('finance.item_cost_price', compact('items'));
    }

    public function edit_cost_sales($id = null) {
        $item = DB::table('items')
                ->where('item_id', $id)
                ->first();
        return view('finance.edit_cost_sales', compact('item'));
    }

    public function update_cost_sales(Request $request) {
        $input = $request->all();
        if (!empty($input)) {

            $array1 = [
                'cost_price' => $input['cost_price'],
                'price' => $input['price']
            ];

            $id = DB::table('items')
                    ->where('item_id', '=', $input['item_id'])
                    ->update($array1);
          
                return redirect('finanace/item_cost_price')
                                ->with('success', 'Success');
            
        }
    }

    public function business_expance(Request $request) {
        $input = $request->all();
        if (!empty($input)) {

            $array1 = [
                'start_date' => $input['start_date'],
                'end_date' => $input['end_date'],
                'expenses_name' => $input['expenses_name'],
                'amount' => $input['amount'],
            ];

            $id = DB::table('expenses')
                    ->insert($array1);
            if ($id) {
                return redirect('finanace/business_expance')
                                ->with('success', 'Success');
            }
        }
        $expenses = DB::table('expenses')
                ->get();
        return view('finance.business_expence', compact('expenses'));
    }

    public function business_expance_remove(Request $request) {
        $input = $request->all();
        if (!empty($input)) {

            if (isset($input['delete']) && !empty($input['delete'])) {
                $id = DB::table('expenses')
                        ->whereIn('expenses_id', $input['delete'])
                        ->delete();
                return redirect()->back()
                                ->with('success', 'Deleted');
            } else {
                return redirect()->back()
                                ->with('success', 'Deleted');
            }
        }
    }

    public function performance(Request $request) {
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
            $expenses = DB::table('expenses')
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
                        ->where('payment_type', 'Cash')
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
                $commision += $total_itm * $item->commission_amount;
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
        } else {
            
        }

        $full = view('pdf.performance', compact('get_all_pck_infos', 'full_of_array', 'expenses', 'start_date', 'end_date'));


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


            $message = ' PERFORMANCE  ';


            $dompdf->load_html($full);
            $dompdf->render();
            $output = $dompdf->output();

            $file_name = date("ymdHi") . "_report.pdf";

            //     $dompdf->stream($file_name);

            $file_to_save = base_path() . '/pdf/' . $file_name;
            file_put_contents($file_to_save, $output);






            $subject = "Sales Report";

            if ($this->simple_mail_with_file(array('tptankit@gmail.com'), $subject, $message, array($file_to_save))) {
                //  
            } else {
                //   return Redirect::back()->with('success', 'Email Sent');
            }
            return Redirect()->back()->with('success', 'Email Sent');
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
        return view('finance.performance', compact('get_all_pck_infos', 'full_of_array', 'expenses', 'start_date', 'end_date'));
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

}
