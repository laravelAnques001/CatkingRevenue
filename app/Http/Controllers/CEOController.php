<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CEOController extends Controller
{
    public $startDate, $endDate, $lastStartDate, $lastEndDate, $previousStartDate, $previousEndDate;
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $date = isset($request->date) ? $request->date : null;
            $course = isset($request->course) ? $request->course : null;
            if ($date != 'custom') {
                $this->getStartEndDate($date);
            } else {
                $startDate = isset($request->start_date) ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->startOfDay();
                $endDate = isset($request->end_date) ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();
                $daysDifference = $endDate->diffInDays($startDate) + 1;

                $this->startDate = $startDate->format('Y-m-d H:i:s');
                $this->endDate = $endDate->format('Y-m-d H:i:s');

                $this->lastStartDate = $startDate->subYear()->format('Y-m-d H:i:s');
                $this->lastEndDate = $endDate->subYear()->format('Y-m-d H:i:s');

                $startDate = isset($request->start_date) ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->startOfDay();
                $endDate = isset($request->end_date) ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();

                $this->previousStartDate = $startDate->subDay($daysDifference)->format('Y-m-d H:i:s');
                $this->previousEndDate = $endDate->subDay($daysDifference)->format('Y-m-d H:i:s');
            }

            // return " startDate : $this->startDate ::::   endDate : $this->endDate :::: Last startDate : $this->lastStartDate ::::  Last endDate : $this->lastEndDate :::: Previous StartDay : $this->previousStartDate  :::: Previous EndDay : $this->previousEndDate";

            if ($course == 'sales') {
                return view('Admin.CeoRevenue.sales');
            } elseif ($course == 'cat') {
                // $cat = $this->getCATData();
                $commonGraph = $this->commonGraphData('cat');
                // return json_encode($commonGraph);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } elseif ($course == 'non_cat') {
                // $nonCat = $this->getNonCATData();
                $commonGraph = $this->commonGraphData('non-cat');
                // return json_encode($nonCat);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } elseif ($course == 'study_abroad') {
                // $studyAbroad = $this->getStudyAbroadData();
                $commonGraph = $this->commonGraphData('study-abroad');
                // return json_encode($commonGraph);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } elseif ($course == 'undergrad') {
                // $undergrad = $this->getUnderGradData();
                $commonGraph = $this->commonGraphData('undergrad');
                // return json_encode($undergrad);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } elseif ($course == 'gdpi') {
                // $gdpi = $this->getGDPIData();
                $commonGraph = $this->commonGraphData('gdpi');
                // return json_encode($gdpi);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } elseif ($course == 'mocks') {
                // $mocks = $this->getMocksData();
                $commonGraph = $this->commonGraphData('mocks');
                // return json_encode($mocks);
                return view('Admin.CeoRevenue.commonGraph', compact('commonGraph'));
            } else {
                $revenue = $this->getRevenueData();
                // return json_encode($revenue);
                return view('Admin.CeoRevenue.revenue', compact('revenue'));
            }

            return '<h1>Hello Dashboard</h1>';
        }
        return view('Admin.CeoRevenue.index');
    }

    public function getStartEndDate($date = 'today')
    {
        if ($date == 'yesterday') {
            $this->startDate = Carbon::yesterday()->startOfDay()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::yesterday()->endOfDay()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::yesterday()->subYear()->startOfDay()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::yesterday()->subYear()->endOfDay()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::yesterday()->subDay()->startOfDay()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::yesterday()->subDay()->endOfDay()->format('Y-m-d H:i:s');

        } elseif ($date == 'this_week') {
            $this->startDate = Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->startOfWeek()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->endOfWeek()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d H:i:s');

        } elseif ($date == 'last_month') {
            $this->startDate = Carbon::now()->subMonths()->startOfMonth()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->subMonths()->startOfMonth()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::now()->subMonths(2)->startOfMonth()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::now()->subMonths(2)->endOfMonth()->format('Y-m-d H:i:s');

        } elseif ($date == '3_months') {
            $this->startDate = Carbon::now()->subMonths(3)->startOfMonth()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->subMonths(3)->startOfMonth()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::now()->subMonths(4)->endOfMonth()->format('Y-m-d H:i:s');

        } elseif ($date == '6_months') {
            $this->startDate = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->subMonths(6)->startOfMonth()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->subMonths()->endOfMonth()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::now()->subMonths(12)->startOfMonth()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::now()->subMonths(7)->endOfMonth()->format('Y-m-d H:i:s');

        } elseif ($date == 'this_year') {
            $this->startDate = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->startOfYear()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->endOfYear()->format('Y-m-d H:i:s');

            $this->previousStartDate = $this->lastStartDate;
            $this->previousEndDate = $this->lastEndDate;

        } elseif ($date == 'last_year') {
            $this->startDate = Carbon::now()->subYear()->startOfYear()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->subYear()->endOfYear()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear(2)->startOfYear()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear(2)->endOfYear()->format('Y-m-d H:i:s');

            $this->previousStartDate = $this->lastStartDate;
            $this->previousEndDate = $this->lastEndDate;

        } else {
            $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
            $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');

            $this->lastStartDate = Carbon::now()->subYear()->startOfDay()->format('Y-m-d H:i:s');
            $this->lastEndDate = Carbon::now()->subYear()->endOfDay()->format('Y-m-d H:i:s');

            $this->previousStartDate = Carbon::yesterday()->startOfDay()->format('Y-m-d H:i:s');
            $this->previousEndDate = Carbon::yesterday()->endOfDay()->format('Y-m-d H:i:s');
        }
    }

    public function getRevenueData()
    {
        $new_total_order_count = $new_total_revenue = $old_total_order_count = $old_total_revenue = $failed_order_repeat_purchase = $new_order_previous_revenue = $old_order_previous_revenue = 0;
        $maxValue = null;

        $new_order_course_category = $old_order_course_category = $failedOrderItemIDs = $data = [];
        // This Year :: total No of enrollment start
        $new_this_year_total = DB::table('orders')->selectRaw('COUNT(id) as count,SUM(total) as total_amount')->where('payment_status', 'completed')->whereBetween('created_at', [$this->startDate, $this->endDate])->first();
        // return $old_this_year_total;
        $old_this_year_total = DB::table('old_orders')->selectRaw('COUNT(id) as count,SUM(total_revenue) as total_amount')->whereBetween('order_date', [$this->startDate, $this->endDate])->first();

        $data['this_year_total_enrollments'] = $new_this_year_total->count + $old_this_year_total->count;
        $data['this_year_total_revenue'] = (int) ($new_this_year_total->total_amount + $old_this_year_total->total_amount);
        // This Year :: total No of enrollment end

        // Last Year :: total No of enrollment start
        $new_last_year_total = DB::table('orders')->selectRaw('COUNT(id) as count,SUM(total) as total_amount')->where('payment_status', 'completed')->whereBetween('created_at', [$this->lastStartDate, $this->lastEndDate])->first();

        $old_last_year_total = DB::table('old_orders')->selectRaw('COUNT(id) as count,SUM(total_revenue) as total_amount')->whereBetween('order_date', [$this->lastStartDate, $this->lastEndDate])->first();

        $data['last_year_total_enrollments'] = $new_last_year_total->count + $old_last_year_total->count;
        $lastYearTotalRevenue = (int) ($new_last_year_total->total_amount + $old_last_year_total->total_amount);
        $data['last_year_total_revenue'] = $lastYearTotalRevenue != 0 ? $lastYearTotalRevenue : 1;
        // Last Year :: total No of enrollment end

        // Enrollment Per start
        $data['this_year_total_enrollments_per'] = number_format((($data['this_year_total_enrollments'] * 100) / ($data['this_year_total_enrollments'] + $data['last_year_total_enrollments'])), 2);
        $data['last_year_total_enrollments_per'] = number_format((($data['last_year_total_enrollments'] * 100) / ($data['this_year_total_enrollments'] + $data['last_year_total_enrollments'])), 2);
        $data['this_year_total_revenue_per'] = number_format((($data['this_year_total_revenue'] * 100) / ($data['this_year_total_revenue'] + $data['last_year_total_revenue'])), 2);
        $data['last_year_total_revenue_per'] = number_format((($data['last_year_total_revenue'] * 100) / ($data['this_year_total_revenue'] + $data['last_year_total_revenue'])), 2);
        $data['total_revenue_per'] = number_format(((($data['this_year_total_revenue'] - $data['last_year_total_revenue']) / $data['last_year_total_revenue']) * 100), 2);
        // Enrollment Per end

        // This Year :: enrollments through Installments & EMI start
        $new_this_year_emi_enrollments = DB::table('orders')
            ->selectRaw('COUNT(orders.id) as count,SUM(orders.total) as total_amount')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$this->startDate, $this->endDate])
            ->where(function ($q) {
                $q->where('order_items.name', 'like', '%installment%')
                    ->orWhere('order_items.name', 'like', '%emi%');
            })->where('orders.payment_status', 'completed')->first();

        $old_this_year_emi_enrollments = DB::table('old_orders')
            ->selectRaw('COUNT(id) as count,SUM(total_revenue) as total_amount')
            ->where(function ($q) {
                $q->where('name', 'like', '%installment%')->orWhere('name', 'like', '%emi%');
            })->whereBetween('order_date', [$this->startDate, $this->endDate])->first();

        $data['this_year_emi_enrollments'] = $new_this_year_emi_enrollments->count + $old_this_year_emi_enrollments->count;
        $data['this_year_emi_revenue'] = (int) ($new_this_year_emi_enrollments->total_amount + $old_this_year_emi_enrollments->total_amount);
        // This Year :: enrollments through Installments & EMI end

        // Last Year :: enrollments through Installments & EMI start
        $new_last_year_emi_enrollments = DB::table('orders')
            ->selectRaw('COUNT(orders.id) as count,SUM(orders.total) as total_amount')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', [$this->lastStartDate, $this->lastEndDate])
            ->where(function ($q) {
                $q->where('order_items.name', 'like', '%installment%')
                    ->orWhere('order_items.name', 'like', '%emi%');
            })->where('orders.payment_status', 'completed')->first();

        $old_last_year_emi_enrollments = DB::table('old_orders')
            ->selectRaw('COUNT(id) as count,SUM(total_revenue) as total_amount')
            ->where(function ($q) {
                $q->where('name', 'like', '%installment%')->orWhere('name', 'like', '%emi%');
            })->whereBetween('order_date', [$this->lastStartDate, $this->lastEndDate])->first();

        $data['last_year_emi_enrollments'] = $new_last_year_emi_enrollments->count + $old_last_year_emi_enrollments->count;
        $data['last_year_emi_revenue'] = (int) ($new_last_year_emi_enrollments->total_amount + $old_last_year_emi_enrollments->total_amount);
        // Last Year :: enrollments through Installments & EMI end

        // Enrollment through Installments & EMI start
        $totalEMIEnrollments = ($data['this_year_emi_enrollments'] + $data['last_year_emi_enrollments']);
        $totalEMIRevenue = ($data['this_year_emi_revenue'] + $data['last_year_emi_revenue']);

        $data['this_year_emi_enrollments_per'] = number_format((($data['this_year_emi_enrollments'] * 100) / ($totalEMIEnrollments > 0 ? $totalEMIEnrollments : 1)), 2);
        $data['last_year_emi_enrollments_per'] = number_format((($data['last_year_emi_enrollments'] * 100) / ($totalEMIEnrollments > 0 ? $totalEMIEnrollments : 1)), 2);
        $data['this_year_emi_revenue_per'] = number_format((($data['this_year_emi_revenue'] * 100) / ($totalEMIRevenue > 0 ? $totalEMIRevenue : 1)), 2);
        $data['last_year_emi_revenue_per'] = number_format((($data['last_year_emi_revenue'] * 100) / ($totalEMIRevenue > 0 ? $totalEMIRevenue : 1)), 2);
        $lastYearEMIRevenue = $data['last_year_emi_revenue'] != 0 ? $data['last_year_emi_revenue'] : 1;
        $data['total_emi_revenue_per'] = number_format(((($data['this_year_emi_revenue'] - $lastYearEMIRevenue) / $lastYearEMIRevenue) * 100), 2);
        // Enrollment through Installments & EMI end

        // Total No of enrollment Chart And Table start
        $new_today_orders = DB::table('orders')
            ->selectRaw('course_categories.name as course_category_name, count(orders.id) as order_count,sum(orders.total) as total_revenue')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->join('course_categories', 'course_categories.id', '=', 'courses.category_ids')
            ->whereBetween('orders.created_at', [$this->startDate, $this->endDate])
            ->where('orders.payment_status', 'completed')
            ->groupBy('course_categories.name')
            ->orderByDesc('order_count')
            ->get();

        $old_today_orders = DB::table('old_orders')
            ->selectRaw('course_categories.name as course_category_name, count(old_orders.id) as order_count,sum(old_orders.total_revenue) as total_revenue')
            ->join('courses', 'courses.name', '=', 'old_orders.name')
            ->join('course_categories', 'course_categories.id', '=', 'courses.category_ids')
            ->whereBetween('old_orders.order_date', [$this->startDate, $this->endDate])
            ->groupBy('course_categories.name')
            ->orderByDesc('order_count')
            ->get();

        $new_previous_orders = DB::table('orders')
            ->selectRaw('course_categories.name as course_category_name, sum(orders.total) as total_revenue')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->join('course_categories', 'course_categories.id', '=', 'courses.category_ids')
            ->whereBetween('orders.created_at', [$this->previousStartDate, $this->previousEndDate])
            ->where('orders.payment_status', 'completed')
            ->groupBy('course_categories.name')
            ->pluck('total_revenue', 'course_category_name')->toArray();

        $old_previous_orders = DB::table('old_orders')
            ->selectRaw('course_categories.name as course_category_name,sum(old_orders.total_revenue) as total_revenue')
            ->join('courses', 'courses.name', '=', 'old_orders.name')
            ->join('course_categories', 'course_categories.id', '=', 'courses.category_ids')
            ->whereBetween('old_orders.order_date', [$this->previousStartDate, $this->previousStartDate])
            ->groupBy('course_categories.name')
            ->pluck('total_revenue', 'course_category_name')->toArray();

        foreach ($new_today_orders as $order) {
            $new_total_order_count += $order->order_count;
            $new_total_revenue += $order->total_revenue;
            $new_order_course_category['enrollment'][$order->course_category_name] = $order->order_count;
            $new_order_course_category['total_revenue'][$order->course_category_name] = $order->total_revenue;
        }

        foreach ($old_today_orders as $order) {
            $old_total_order_count += $order->order_count;
            $old_total_revenue += $order->total_revenue;
            $old_order_course_category['enrollment'][$order->course_category_name] = $order->order_count;
            $old_order_course_category['total_revenue'][$order->course_category_name] = $order->total_revenue;
        }

        foreach ($new_previous_orders as $pervious) {
            $new_order_previous_revenue += $pervious;
        }

        foreach ($old_previous_orders as $pervious) {
            $old_order_previous_revenue += $pervious;
        }

        $total_order_count = ($new_total_order_count + $old_total_order_count);
        $total_order_count = isset($total_order_count) ? $total_order_count : 1;

        $data['total_revenue']['sum'] = $new_total_revenue + $old_total_revenue;
        $orderPreviousRevenue = $new_order_previous_revenue + $old_order_previous_revenue;
        $totalRevenuePer = min(($data['total_revenue']['sum'] - $orderPreviousRevenue) / ($orderPreviousRevenue > 0 ? $orderPreviousRevenue : 1) * 100, 100);
        $data['total_revenue']['per'] = number_format($totalRevenuePer, 2);

        // total No of enrollment enrollment pie chart start
        $enrollment_CAT = ((isset($new_order_course_category['enrollment']['CAT']) ? $new_order_course_category['enrollment']['CAT'] : 0)
             + (isset($old_order_course_category['enrollment']['CAT']) ? $old_order_course_category['enrollment']['CAT'] : 0));
        $data['enrollment']['CAT'] = $enrollment_CAT != 0 ? number_format(($enrollment_CAT / $total_order_count * 100), 2) : 0;

        $enrollment_GDPI = ((isset($new_order_course_category['enrollment']['GDPI']) ? $new_order_course_category['enrollment']['GDPI'] : 0)
             + (isset($old_order_course_category['enrollment']['GDPI']) ? $old_order_course_category['enrollment']['GDPI'] : 0));
        $data['enrollment']['GDPI'] = $enrollment_GDPI != 0 ? number_format(($enrollment_GDPI / $total_order_count * 100), 2) : 0;

        $enrollment_Mocks = ((isset($new_order_course_category['enrollment']['Mocks']) ? $new_order_course_category['enrollment']['Mocks'] : 0)
             + (isset($old_order_course_category['enrollment']['Mocks']) ? $old_order_course_category['enrollment']['Mocks'] : 0));
        $data['enrollment']['Mocks'] = $enrollment_Mocks != 0 ? number_format(($enrollment_Mocks / $total_order_count * 100), 2) : 0;

        $enrollment_Non_CAT = ((isset($new_order_course_category['enrollment']['Non-CAT']) ? $new_order_course_category['enrollment']['Non-CAT'] : 0) + (isset($old_order_course_category['enrollment']['Non-CAT']) ? $old_order_course_category['enrollment']['Non-CAT'] : 0));
        $data['enrollment']['Non-CAT'] = $enrollment_Non_CAT != 0 ? number_format(($enrollment_Non_CAT / $total_order_count * 100), 2) : 0;

        $enrollment_Study_Abroad = ((isset($new_order_course_category['enrollment']['Study Abroad']) ? $new_order_course_category['enrollment']['Study Abroad'] : 0) + (isset($old_order_course_category['enrollment']['Study Abroad']) ? $old_order_course_category['enrollment']['Study Abroad'] : 0));
        $data['enrollment']['Study Abroad'] = $enrollment_Study_Abroad != 0 ? number_format(($enrollment_Study_Abroad / $total_order_count * 100), 2) : 0;

        $enrollment_UnderGrad = ((isset($new_order_course_category['enrollment']['UnderGrad']) ? $new_order_course_category['enrollment']['UnderGrad'] : 0) + (isset($old_order_course_category['enrollment']['UnderGrad']) ? $old_order_course_category['enrollment']['UnderGrad'] : 0));
        $data['enrollment']['UnderGrad'] = $enrollment_UnderGrad != 0 ? number_format(($enrollment_UnderGrad / $total_order_count * 100), 2) : 0;

        foreach ($data['enrollment'] as $key => $value) {
            if ($maxValue === null || $value > $maxValue) {
                $maxValue = $value;
            }
        }
        $data['enrollment']['maxValue'] = $maxValue;
        // total No of enrollment enrollment pie chart end

        // this day total revenue start
        $data['today_day_total_revenue']['CAT'] = (int) ((isset($new_order_course_category['total_revenue']['CAT']) ? $new_order_course_category['total_revenue']['CAT'] : 0)
             + (isset($old_order_course_category['total_revenue']['CAT']) ? $old_order_course_category['total_revenue']['CAT'] : 0));

        $data['today_day_total_revenue']['GDPI'] = (int) ((isset($new_order_course_category['total_revenue']['GDPI']) ? $new_order_course_category['total_revenue']['GDPI'] : 0)
             + (isset($old_order_course_category['total_revenue']['GDPI']) ? $old_order_course_category['total_revenue']['GDPI'] : 0));

        $data['today_day_total_revenue']['Mocks'] = (int) ((isset($new_order_course_category['total_revenue']['Mocks']) ? $new_order_course_category['total_revenue']['Mocks'] : 0) + (isset($old_order_course_category['total_revenue']['Mocks']) ? $old_order_course_category['total_revenue']['Mocks'] : 0));

        $data['today_day_total_revenue']['Non-CAT'] = (int) ((isset($new_order_course_category['total_revenue']['Non-CAT']) ? $new_order_course_category['total_revenue']['Non-CAT'] : 0) + (isset($old_order_course_category['total_revenue']['Non-CAT']) ? $old_order_course_category['total_revenue']['Non-CAT'] : 0));

        $data['today_day_total_revenue']['Study Abroad'] = (int) ((isset($new_order_course_category['total_revenue']['Study Abroad']) ? $new_order_course_category['total_revenue']['Study Abroad'] : 0) + (isset($old_order_course_category['total_revenue']['Study Abroad']) ? $old_order_course_category['total_revenue']['Study Abroad'] : 0));

        $data['today_day_total_revenue']['UnderGrad'] = (int) ((isset($new_order_course_category['total_revenue']['UnderGrad']) ? $new_order_course_category['total_revenue']['UnderGrad'] : 0) + (isset($old_order_course_category['total_revenue']['UnderGrad']) ? $old_order_course_category['total_revenue']['UnderGrad'] : 0));
        // this day total revenue end

        // previous day total revenue start
        $data['previous_day_total_revenue']['CAT'] = (int) ((isset($new_previous_orders['CAT']) ? $new_previous_orders['CAT'] : 0) + (isset($old_previous_orders['CAT']) ? $old_previous_orders['CAT'] : 0));

        $data['previous_day_total_revenue']['GDPI'] = (int) ((isset($new_previous_orders['GDPI']) ? $new_previous_orders['GDPI'] : 0) + (isset($old_previous_orders['GDPI']) ? $old_previous_orders['GDPI'] : 0));

        $data['previous_day_total_revenue']['Mocks'] = (int) ((isset($new_previous_orders['Mocks']) ? $new_previous_orders['Mocks'] : 0) + (isset($old_previous_orders['Mocks']) ? $old_previous_orders['Mocks'] : 0));

        $data['previous_day_total_revenue']['Non-CAT'] = (int) ((isset($new_previous_orders['Non-CAT']) ? $new_previous_orders['Non-CAT'] : 0) + (isset($old_previous_orders['Non-CAT']) ? $old_previous_orders['Non-CAT'] : 0));

        $data['previous_day_total_revenue']['Study Abroad'] = (int) ((isset($new_previous_orders['Study Abroad']) ? $new_previous_orders['Study Abroad'] : 0) + (isset($old_previous_orders['Study Abroad']) ? $old_previous_orders['Study Abroad'] : 0));

        $data['previous_day_total_revenue']['UnderGrad'] = (int) ((isset($new_previous_orders['UnderGrad']) ? $new_previous_orders['UnderGrad'] : 0) + (isset($old_previous_orders['UnderGrad']) ? $old_previous_orders['UnderGrad'] : 0));
        // previous day total revenue end

        // Failed Order List Start
        $failed_order = DB::table('orders')
            ->selectRaw('orders.id as order_id,orders.user_id as user_id, order_items.course_id as course_id,order_items.id as order_item_id')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
            ->whereBetween('orders.created_at', ["$this->startDate", "$this->endDate"])
            ->whereIn('orders.payment_status', ['timeout', 'failed'])
            ->get();

        foreach ($failed_order as $order) {
            $orderDetail = DB::table('orders')
                ->join('order_items', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.payment_status', 'completed')
                ->where('order_items.course_id', $order->course_id)
                ->where('order_items.user_id', $order->user_id)
                ->first();
            if (!$orderDetail) {
                if (!in_array($order->order_item_id, $failedOrderItemIDs)) {
                    array_push($failedOrderItemIDs, $order->order_item_id);
                }
            } else {
                ++$failed_order_repeat_purchase;
            }
        }
        $data['failed_order_repeat_purchase'] = $failed_order_repeat_purchase;
        $data['failed_order_dont_purchase'] = count($failedOrderItemIDs);
        $data['failed_order_list'] = DB::table('orders')
        // ->selectRaw('orders.id as order_id,users.id as user_id,users.name as name,users.email as email,users.phone_number as phone_number')
            ->selectRaw('orders.id as order_id,orders.bd_name as name,orders.bd_email as email,orders.bd_phone_number as phone_number,order_items.name as course_name')
            ->join('order_items', 'order_items.order_id', '=', 'orders.id')
        // ->join('users', 'users.id', '=', 'orders.user_id')
        // ->join('courses', 'courses.id', '=', 'order_items.course_id')
            ->whereIn('order_items.id', $failedOrderItemIDs)
            ->orderByDesc('orders.created_at')
            ->get();
        // Failed Order List End
        return $data;
    }
    public function getNewTodayCatCourses($id)
    {
        return DB::table('courses')
            ->selectRaw('courses.id as course_id,courses.slug as course_slug,COUNT(orders.id) as count,SUM(orders.total) as total_amount')
            ->join('order_items', 'order_items.course_id', 'courses.id')
            ->join('orders', 'orders.id', 'order_items.order_id')
            ->where('courses.show_on_menu', '=', 'yes')
            ->whereBetween('orders.created_at', [$this->startDate, $this->endDate])
            ->whereRaw("FIND_IN_SET($id, courses.category_ids)")
            ->where('courses.status', '=', 'published')
            ->groupBy('course_id')
            ->orderBy('courses.sort_order')
            ->get();
    }

    public function getNewLastDayCatCourses($id)
    {
        return DB::table('courses')
            ->selectRaw('courses.id as course_id,courses.slug as course_slug,COUNT(orders.id) as count,SUM(orders.total) as total_amount')
            ->join('order_items', 'order_items.course_id', 'courses.id')
            ->join('orders', 'orders.id', 'order_items.order_id')
            ->where('courses.show_on_menu', '=', 'yes')
            ->whereBetween('orders.created_at', [$this->previousStartDate, $this->previousEndDate])
            ->whereRaw("FIND_IN_SET($id, courses.category_ids)")
            ->where('courses.status', '=', 'published')
            ->groupBy('course_id')
            ->orderBy('courses.sort_order')
            ->get();
    }

    public function getOldTodayCatCourses($id)
    {
        return DB::table('courses')
            ->selectRaw('courses.id as course_id,courses.slug as course_slug,COUNT(old_orders.id) as count,SUM(old_orders.total_revenue) as total_amount')
            ->join('old_orders', 'old_orders.name', 'courses.name')
            ->where('courses.show_on_menu', '=', 'yes')
            ->whereBetween('old_orders.order_date', [$this->startDate, $this->endDate])
            ->whereRaw("FIND_IN_SET($id, courses.category_ids)")
            ->where('courses.status', '=', 'published')
            ->groupBy('course_id')
            ->orderBy('courses.sort_order')
            ->get();
    }

    public function getOldLastDayCatCourses($id)
    {
        return DB::table('courses')
            ->selectRaw('courses.id as course_id,courses.slug as course_slug,COUNT(old_orders.id) as count,SUM(old_orders.total_revenue) as total_amount')
            ->join('old_orders', 'old_orders.name', 'courses.name')
            ->where('courses.show_on_menu', '=', 'yes')
            ->whereBetween('old_orders.order_date', [$this->previousStartDate, $this->previousEndDate])
            ->whereRaw("FIND_IN_SET($id, courses.category_ids)")
            ->where('courses.status', '=', 'published')
            ->groupBy('course_id')
            ->orderBy('courses.sort_order')
            ->get();
    }

    public function commonGraphData($slug = null)
    {
        $data = $courseData = [];
        if ($slug) {
            $categories = DB::table('course_categories')->select('id')->where('slug', $slug)->first();
            $categories_id = isset($categories->id) ? $categories->id : null;
            if ($categories_id) {
                $courses = DB::table('courses')
                    ->where('show_on_menu', 'yes')
                    ->whereRaw("FIND_IN_SET($categories_id, category_ids)")
                    ->where('status', 'published')
                    ->orderBy('sort_order', 'asc')
                    ->pluck('name', 'slug')->toArray();

                $courses_slug = array_keys($courses);
                $courseData['courses_name'] = array_values($courses);
                $courseData['courses_slug'] = $courses_slug;
                $courseData['selected_course'] = $slug;

                foreach ($courses_slug as $slug) {
                    $data['today_enrollment'][$slug] = 0;
                    $data['lastDay_enrollment'][$slug] = 0;
                    $data['today_revenue'][$slug] = 0;
                    $data['lastDay_revenue'][$slug] = 0;
                }

                foreach ($this->getNewTodayCatCourses($categories_id) as $course) {
                    $data['today_enrollment'][$course->course_slug] += $course->count;
                    $data['today_revenue'][$course->course_slug] += $course->total_amount;
                }

                foreach ($this->getOldTodayCatCourses($categories_id) as $course) {
                    $data['today_enrollment'][$course->course_slug] += $course->count;
                    $data['today_revenue'][$course->course_slug] += $course->total_amount;
                }

                foreach ($this->getNewLastDayCatCourses($categories_id) as $course) {
                    $data['lastDay_enrollment'][$course->course_slug] += $course->count;
                    $data['lastDay_revenue'][$course->course_slug] += $course->total_amount;
                }

                foreach ($this->getOldLastDayCatCourses($categories_id) as $course) {
                    $data['lastDay_enrollment'][$course->course_slug] += $course->count;
                    $data['lastDay_revenue'][$course->course_slug] += $course->total_amount;
                }

                $courseData['today_enrollment'] = array_values($data['today_enrollment']);
                $courseData['today_revenue'] = array_values($data['today_revenue']);
                $courseData['lastDay_enrollment'] = array_values($data['lastDay_enrollment']);
                $courseData['lastDay_revenue'] = array_values($data['lastDay_revenue']);

                $courseData['total_today_enrollment'] = array_sum($courseData['today_enrollment']);
                $courseData['total_today_revenue'] = array_sum($courseData['today_revenue']);
                $lastDay_enrollment = array_sum($courseData['lastDay_enrollment']);
                $lastDay_revenue = array_sum($courseData['lastDay_revenue']);

                $courseData['per_today_enrollment'] = round(min(($courseData['total_today_enrollment'] - $lastDay_enrollment) / ($lastDay_enrollment > 0 ? $lastDay_enrollment : 1) * 100, 100), 2);

                $courseData['per_today_revenue'] = round(min(($courseData['total_today_revenue'] - $lastDay_revenue) / ($lastDay_revenue > 0 ? $lastDay_revenue : 1) * 100, 100), 2);

                return $courseData;
            }
            return "Categories not found";
        }
        return 'Data Not Found';
    }
}
