<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function getOrders()
    {
        $user = Auth::user();

        $orders = Orders::where('user_id', $user->id)->get();
        foreach ($orders as $order) {
            $order->order_item_details = json_decode($order->order_item_details);
        }
        return response()->json(['success' => true, 'message' => 'Order get successfully', 'orders' => $orders], 200);
    }


    public function addOrder(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                "customer_id" => "nullable",
                "customer_name" => "required",
                "customer_phone" => "nullable",
                "order_item_details" => "required|array",
                "order_type" => "nullable",
                "grand_total" => "required",

            ]);
            Orders::create([
                "user_id" => $user->id,
                "customer_id" => $validatedData['customer_id'],
                "customer_name" => $validatedData['customer_name'],
                "customer_phone" => $validatedData['customer_phone'],
                "order_item_details" => json_encode($validatedData['order_item_details']),
                "order_type" => $validatedData['order_type'],
                "grand_total" => $validatedData['grand_total'],
            ]);


            return response()->json(['success' => true, 'message' => 'Order add successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function dashboardData()
    {
        $user = Auth::user();

        $filter = request('filter');

        $query = Orders::select('grand_total', 'created_at')->where('user_id', $user->id);
        $productsQuery = Products::where('user_id', $user->id);

        if ($filter === 'today') {
            $query->whereDate('created_at', Carbon::today());
            $productsQuery->whereDate('created_at', Carbon::today());
        } elseif ($filter === 'week') {
            $fromDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            $toDate = Carbon::now()->endOfWeek()->format('Y-m-d');
            $query->whereBetween('created_at', [$fromDate, $toDate]);
            $productsQuery->whereBetween('created_at', [$fromDate, $toDate]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
            $productsQuery->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        }

            $totalSales = $query->sum('grand_total');
        $totalOrders = $query->count();
        $totalProducts = $productsQuery->count();

        // Build response data
        $data = [
            ['total_products' => $totalProducts],
            ['total_sales' => $totalSales],
            ['total_orders' => $totalOrders],
        ];


        return response()->json([
            'success' => true,
            'message' => 'Report fetched successfully',
            'data' => $data
        ], 200);


    }


    public function saleReport()
    {

        $user = Auth::user();
        $report = [];

        $filter = request('filter');
        $dateFrom = request('date_from');
        $dateTo = request('date_to');

        $query = Orders::select('customer_name', 'customer_phone', 'grand_total', 'created_at')->where('user_id', $user->id);

        if ($filter === 'today') {
            $query->whereDate('created_at', Carbon::today());
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        } elseif ($filter === 'week') {
            $fromDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            $toDate = Carbon::now()->endOfWeek()->format('Y-m-d');
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        } elseif ($filter === 'month') {
            $fromDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $toDate = Carbon::now()->endOfMonth()->format('Y-m-d');
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } else {
            $fromDate = $dateFrom ? Carbon::parse($dateFrom)->format('Y-m-d') : null;
            $toDate = $dateTo ? Carbon::parse($dateTo)->format('Y-m-d') : null;
        }

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', Carbon::parse($dateFrom));
            $fromDate = Carbon::parse($dateFrom)->format('Y-m-d');
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', Carbon::parse($dateTo));
            $toDate = Carbon::parse($dateTo)->format('Y-m-d');
        }

        $orders = $query->get();
        foreach ($orders as $order) {
            $order->order_date = Carbon::parse($order->created_at)->format('M d, Y');
        }

        $report['from_date'] = $fromDate;
        $report['to_date'] = $toDate;
        $report['orders'] = $orders;
        return response()->json(['success' => true, 'message' => 'Report fetched successfully', 'report' => $report], 200);
    }
}
