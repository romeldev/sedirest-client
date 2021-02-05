<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintService;

class ServiceController extends Controller
{
    public function print(Request $request)
    {
        $dataPrint = [
            'report_name' => 'test',
            'title' => 'prueba'
        ];

        $print = new PrintService;
        $print->conn_type =  1;
        $print->conn_name =  'CAJA';
        $resPrint = $print->printView($dataPrint['report_name'], $dataPrint);
        return response()->json($resPrint);


        // $dataPrint = $request->all();
        // // dd('dataPrint', $dataPrint);
        // $print = new PrintService;
        // $print->conn_type =  $dataPrint['conn_type'];
        // $print->conn_name =  $dataPrint['conn_name'];
        // $resPrint = $print->printView($dataPrint['report_name'], $dataPrint);
        // return response()->json($resPrint);
    }

    public function printShipping(Request $request)
    {
        $dataPrint = $request->all();
        $res = PrintService::printShippingBill($dataPrint);
        return response()->json($res);
    }
}
