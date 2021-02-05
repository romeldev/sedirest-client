<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mike42\Escpos\Printer;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PrintService extends Model
{
    const CONN_TYPE_WINDOWS = 1;
    const CONN_TYPE_NETWORK = 2;
    const CONN_TYPE_FILE = 3;

    public $viewPath = 'print';

    protected $attributes = [
        'conn_type',    
        'conn_name',    //cajita // 192.168.1.31:9600
        'cpl',          //48
        'html_width',   //500
    ];

    public function printView($viewName, $data )
    {
        $filePhp = view("$this->viewPath.$viewName", compact('data'));
        $x = Storage::disk('public')->put("/print/$viewName.html", $filePhp->render());
        // $source = Storage::disk('public')->url("/print/$viewName.html");
        $source = base_path("public\storage\print\\$viewName.html");
        return $this->printHtml($source);
    }

    public function printHtml( $source )
    {
        $res = [];
        try {
            // $printer = new Printer($this->getPrintConnector());
            $pathBin = base_path('bin\wkhtmltopdf\64');

            $width = 550;

            $dest = tempnam(sys_get_temp_dir(), 'escpos') . ".png";

            $command = sprintf(
                "%s --width %s %s %s",
                escapeshellarg($pathBin.'\wkhtmltoimage.exe'),
                escapeshellarg($width),
                escapeshellarg($source),
                escapeshellarg($dest)
            );

            $process = Process::fromShellCommandline($command);
            $process->run();
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // exec($command, $output, $retVal);
            // if($retVal!=0)  throw new \Exception("fail to generate image from html");

            /* Load up the image */
            try {
                $img = EscposImage::load($dest);
            } catch (Exception $e) {
                unlink($dest);
                throw $e;
            }
            // unlink($dest);
            // $printer->bitImage($img); // bitImage() seems to allow larger images than graphics() on the TM-T20. bitImageColumnFormat() is another option.
            // $printer->cut();
            // $printer->close();
            $res['status'] = true;
            $res['message'] = "print success!";
            return $res;
        } catch (\Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
    }


    public function getPrintConnector() {
        $connector = null;
        if( $this->conn_type == PrintService::CONN_TYPE_NETWORK ){
            $meta = explode(':', $this->conn_name);
            $ip = isset($meta[0])? trim($meta[0]): null;
            $port = isset($meta[1])? trim($meta[1]): null;
            $connector = new NetworkPrintConnector($ip, $port);
        }else if( $this->conn_type == PrintService::CONN_TYPE_WINDOWS ){
            $connector = new WindowsPrintConnector($this->conn_name);
        }else if( $this->conn_type == PrintService::CONN_TYPE_FILE ){
            $connector = new FilePrintConnector($this->conn_name);
        }
        return $connector;
    }

    public static function PrintShippingBill($dataPrint) 
    {
        $boxPrinted = null;
        if(isset($dataPrint['data_box']) ) {
            $sp = new PrintService;
            $sp->conn_type = $dataPrint['data_box']['conn_type'];
            $sp->conn_name = $dataPrint['data_box']['conn_name'];
            $boxPrinted = $sp->printView('shipping', $dataPrint['data_box']);
        }

        $kitchenPrinted = null;
        if(isset($dataPrint['data_kitchen'])) {
            $sp = new PrintService;
            $sp->conn_type = $dataPrint['data_kitchen']['conn_type'];
            $sp->conn_name = $dataPrint['data_kitchen']['conn_name'];
            $kitchenPrinted = $sp->printView('shipping', $dataPrint['data_kitchen']);
        }

        $commandPrinted = null;
        if(isset($dataPrint['data_bill'])) {
            $sp = new PrintService;
            $sp->conn_type = $dataPrint['data_bill']['conn_type'];
            $sp->conn_name = $dataPrint['data_bill']['conn_name'];
            $commandPrinted = $sp->printView('bill', $dataPrint['data_bill']);
        }

        return [
            'box_printed' => $boxPrinted,
            'kitchen_printed' => $kitchenPrinted,
            'command_printed' => $commandPrinted,
        ];
    }

    
}
