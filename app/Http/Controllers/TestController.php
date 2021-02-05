<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrintService;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\PhpExecutableFinder;

class TestController extends Controller
{

    public function index(Request $request)
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
    }    
}
