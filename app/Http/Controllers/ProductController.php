<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CatatanProduct;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{

    public function listProduct()
    {
        $products = Product::all();
        return response()->json([
            'id' => '1',
            'data' => $products
        ]);
    }

    public function detailProduct($id)
    {
        $products = Product::find($id);
        if (!$products) {
            return response()->json([
                'id' => '0',
                'message' => 'data not found'
            ]);
        }
        return response()->json([
            'id' => '1',
            'data' => $products
        ]);
    }

    public function createProduct(Request $request)
    {
        $validateData = $request->validate([
            'name_product' => 'required',
            'quantity' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
        ]);
        $products = Product::create([
            'name_product' => $validateData['name_product'],
            'quantity' => $validateData['quantity'],
            'buy_price' => $validateData['buy_price'],
            'sell_price' => $validateData['sell_price'],
        ]);

        CatatanProduct::create([
            'product_id' => $products->id,
            'quantity' => $validateData['quantity'],
            'total_price' => $validateData['buy_price'] * $validateData['quantity'],
            'status' => '0'
        ]);

        return response()->json([
            'id' => '1',
            'message' => 'success',
            'data' => $products
        ]);
    }

    public function sellProduct(Request $request, $id)
    {
        $validateData = $request->validate([
            'quantity' => 'required',
            'sell_price' => 'required',
        ]);
        $products = Product::find($id);
        if (!$products) {
            return response()->json([
                'id' => '0',
                'message' => 'data not found'
            ]);
        }
        $products->quantity = $products->quantity - $validateData['quantity'];
        // $products->sell_price = $validateData['sell_price'];
        $products->save();

        CatatanProduct::create([
            'product_id' => $id,
            'quantity' => $validateData['quantity'],
            'total_price' => $validateData['sell_price'] * $validateData['quantity'],
            'status' => '1'
        ]);

        return response()->json([
            'id' => '1',
            'data' => $products
        ]);
    }
    public function buyProduct(Request $request, $id)
    {
        $validateData = $request->validate([
            'quantity' => 'required',
            'buy_price' => 'required',
        ]);
        $products = Product::find($id);
        if (!$products) {
            return response()->json([
                'id' => '0',
                'message' => 'data not found'
            ]);
        }
        $products->quantity = $products->quantity + $validateData['quantity'];
        // $products->buy_price = $validateData['buy_price'];
        $products->save();

        CatatanProduct::create([
            'product_id' => $id,
            'quantity' => $validateData['quantity'],
            'total_price' => $validateData['buy_price'] * $validateData['quantity'],
            'status' => '0'
        ]);

        return response()->json([
            'id' => '1',
            'data' => $products
        ]);
    }

    public function deleteProduct($id)
    {
        $products = Product::find($id);
        if (!$products) {
            return response()->json([
                'id' => '0',
                'message' => 'data not found'
            ]);
        }
        $products->delete();
        return response()->json([
            'id' => '1',
            'message' => 'success'
        ]);
    }



    public function export(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        $query = CatatanProduct::with('product');

        if ($year && $month) {
            // Monthly
            $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $end = Carbon::createFromDate($year, $month, 1)->endOfMonth();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($year && !$month) {
            // Yearly
            $start = Carbon::createFromDate($year, 1, 1)->startOfYear();
            $end = Carbon::createFromDate($year, 12, 31)->endOfYear();
            $query->whereBetween('created_at', [$start, $end]);
        }
        // else: no filter, all data

        $data = $query->get();

        return Excel::download(new ReportExport($data), 'laporan-transaksi.xlsx');
    }
}
