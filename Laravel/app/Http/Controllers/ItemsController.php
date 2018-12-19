<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;

class ItemsController extends Controller {

    public function existing_items() {
        $items = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->get();
        $items_c = DB::table('items_clearance')
                ->join('items', 'items.item_id', '=', 'items_clearance.item_id')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->get();
        return view('items.existing_items', compact('items', 'items_c'));
    }

    public function show_stocks() {
        $items = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->get();
        return view('items.show_stocks', compact('items'));
    }

    public function item_delete($id = null) {
        DB::table('items')
                ->where('item_id', $id)
                ->delete();
        return redirect('items/existing_items')
                        ->with('success', 'Item Deleted Successfully!');
    }

    public function load_stock($id = null) {
        $item = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->where('items.item_id', $id)
                ->first();
        $categories = DB::table('categories')
                ->get();

        return view('items.load_stock', compact('item', 'categories'));
    }

    public function move_to_clearance($id = NULL) {
        $item = DB::table('items')
                ->join('categories', 'categories.category_id', '=', 'items.item_category_id')
                ->where('items.item_id', $id)
                ->first();

        return view('items.move_to_clearance', compact('item'));
    }

    public function add_clearance_item(Request $request) {
        $input = $request->all();

        if (!empty($input)) {


            $array1 = [
                'item_id' => $input['item_id'],
                'clearance_stock' => $input['clearance_stock'],
                'item_price' => $input['item_price']
            ];
            $array2 = [

                'current_items_no' => $input['remained_stock'],
            ];


            $id = DB::table('items_clearance')
                    ->insertGetId($array1);
            if ($id) {
                DB::table('items')
                        ->where('item_id', $input['item_id'])
                        ->update($array2);
                return redirect('items/existing_items')
                                ->with('success', 'Item Added Successfully to clearance.!');
            }
        }
    }

    public function new_number($unique) {
        $items_data = DB::table('items')
                ->where('barcode_number', $unique)
                ->get();
        if (empty($items_data)) {
            $unique = $unique;
        } else {
            $unique = substr(uniqid(rand(), true), 1, 7);
        }
        return $unique;
    }

    public function new_item(Request $request) {
        $input = $request->all();
        $number = substr(uniqid(rand(), true), 1, 7);


        $unique_number = $this->new_number($number);


        $categories = DB::table('categories')
                ->get();
        if (!empty($input)) {


            $array1 = [
                'item_category_id' => $input['item_category_id'],
                'item_name' => $input['item_name'],
                'size' => $input['size'],
                'item_desc' => $input['item_desc'],
                'price' => $input['price'],
                'color' => $input['color'],
                'barcode_number' => $input['barcode_number'],
                'current_items_no' => $input['current_items_no'],
                'commission_percentage' => $input['commission_percentage'],
                'commission_amount' => $input['commission_amount'],
                'critical_items_no' => $input['critical_items_no'],
            ];

            $id = DB::table('items')
                    ->insertGetId($array1);
            if ($id) {
                return redirect()->back()
                                ->with('success', 'Item Added Successfully.!');
            }
        }
        return view('items.new_item', compact('categories', 'unique_number'));
    }

    public function update_stocks(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $array = [
                'item_category_id' => $input['item_category_id'],
                'item_name' => $input['item_name'],
                'size' => $input['size'],
                'price' => $input['price'],
                'color' => $input['color'],
                'item_desc' => $input['item_desc'],
                'barcode_number' => $input['barcode_number'],
                'current_items_no' => $input['total_items'],
            ];

            $update = DB::table('items')
                    ->where('item_id', $input['item_id'])
                    ->update($array);
            if ($update) {
                return redirect()->back()
                                ->with('success', 'Item Updated Successfully.!');
            }
        }
    }

    public function category_add(Request $request) {
        $input = $request->all();
        if (!empty($input)) {
            $array1 = [
                'category_name' => $input['category_name']
            ];


            $id = DB::table('categories')
                    ->insertGetId($array1);
            return redirect()->back()
                            ->with('success', 'Category Added');
        } else {
            $categories = DB::table('categories')
                    ->get();
            return view('items.category_add', compact('categories'));
        }
    }

    public function category_delete($id = null) {

        DB::table('categories')->where('category_id', $id)
                ->delete();
        return redirect()->back()
                        ->with('success', 'Category Deleted');
    }

    public function category_edit($id = null) {
        $category = DB::table('categories')
                ->where('category_id', $id)
                ->first();
        return view('items.category_edit', compact('category'));
    }

    public function category_update(Request $request) {
        $input = $request->all();

        if (!empty($input)) {
            $array = [
                'category_name' => $input['category_name']
            ];
            $update = DB::table('categories')
                    ->where('category_id', $input['category_id'])
                    ->update($array);
            return redirect('items/category_add')
                            ->with('success', 'Category Updated');
        }
    }

}
