<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    public function index() {
        $title = "Dashboard";

        // $marketing_array = array("Diana Angel", "Brad Perkins", "Jonathan Dow", "Helen Marith");
        // $commission_rate = 0.5;
        // $gross_profit_job_array = [20000, 40000, 60000, 70000];
        // $gross_profit_period_array = ['Januari', 'Februari', 'Maret', 'April'];

        $employee_data = $this->get_marketing_employee_data();
        $commission_rate = 0.5;
        $marketing_array = [];
        $gross_profit_job_array = [];
        $gross_profit_period_array = [];
        $marketing_job_count = [];

        foreach ($employee_data as $data) {
            array_push($marketing_array, $data->name);
            array_push($gross_profit_job_array, $data->employee_job_gross_profit);
            array_push($marketing_job_count, $data->employee_job_count);
            array_push($gross_profit_period_array, $data->employee_job_date);
        }

        return view('home', compact('title', 'marketing_array', 'commission_rate', 'gross_profit_period_array', 'gross_profit_job_array', 'marketing_job_count'));
    }

    private function get_marketing_employee_data() {
        $result = DB::table('commission_data.marketing_job')
            ->leftJoin('commission_data.employee', 'commission_data.employee.id', '=', 'commission_data.marketing_job.employee_id')
            ->select('commission_data.marketing_job.*', 'commission_data.employee.name')
            ->orderBy('commission_data.marketing_job.employee_job_date', 'asc')
            ->get()
            ->toArray();

        return $result;
    }
}
