<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintService;

class ServiceController extends Controller
{
    public function print(Request $request)
    {
        $reports = $request->all();

        $resPrinter = [];
        foreach($reports as $report) {
            $resPrinter[] = (new PrintService)->print($report);
        }
        return response()->json($resPrinter);
    }

    public function printShipping(Request $request)
    {
        $data = $request->all();
        $printInKitchen = null;
        $printInBox = null;
        $printedIn = [];

        if( isset($data['data_kitchen'])) {
            $printInKitchen = (new PrintService)->print($data['data_kitchen']);
            if($printInKitchen['status']) $printedIn[] = __u('kitchen');
        }
        
        if( isset($data['data_box'])) {
            $printInBox = (new PrintService)->print($data['data_box']);
            if($printInBox['status']) $printedIn[] = __u('box');
        }

        $resPrint['status'] = count($printedIn)!=0;
        $resPrint['message'] = count($printedIn)==0? __c('nothing_print'): __c('print_in').': '.implode(',', $printedIn);

        $resPrint['meta'] = [
            'res_print_kitchen' => $printInKitchen,
            'res_print_box' => $printInBox,
        ];

        return response()->json($resPrint);
    }

    public function viewReport(Request $request, $viewName)
    {
        $filename = $viewName.'.html';

        return view('view-report', compact('filename'));
    }

}
