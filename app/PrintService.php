<?php

namespace App;
use Mike42\Escpos\Printer;
use Illuminate\Support\Facades\Storage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Database\Eloquent\Model;

class PrintService extends Model
{
    const CONN_TYPE_WINDOWS = 1;
    const CONN_TYPE_NETWORK = 2;
    const CONN_TYPE_FILE = 3;

    public $viewPath = 'print.pos';

    protected $attributes = [
        'conn_type',    
        'conn_name',    //cajita // 192.168.1.31:9600
        'cpl',          //48
        'html_width',   //500
    ];

    public function print( $data)
    {   
        $this->conn_type =  $data['conn_type'];
        $this->conn_name =  $data['conn_name'];
        return $this->printView($data['report_name'], $data);
    }

    public function printView($viewName, $data )
    {
        $filePhp = view("$this->viewPath.$viewName", compact('data'));
        // return $filePhp;
        $x = Storage::disk('public')->put("/print/$viewName.html", $filePhp->render());
        $source = base_path("public\storage\print\\$viewName.html");
        // dd($source);
        return $this->printHtml($viewName, $source);
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
        if( $connector==null) throw new \Exception("Print connection null");
        
        return $connector;
    }

    public function printHtml($viewName, $source )
    {
        $res['report_name'] = __c('report_'.$viewName);
        try {
            // $source = "https://es.wikipedia.org/wiki/Wikipedia:Portada";
            $printer = new Printer($this->getPrintConnector());
            $pathBin = base_path('bin\wkhtmltopdf\64');
            $width = 550;
            $dest = tempnam(sys_get_temp_dir(), 'escpos') . ".png";
            $command = sprintf(
                "%s --width %s %s %s",
                escapeshellarg($pathBin.'/wkhtmltoimage.exe'),
                escapeshellarg($width),
                escapeshellarg($source),
                escapeshellarg($dest)
            );
            // dd($command);

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

            $x = $printer->bitImage($img); // bitImage() seems to allow larger images than graphics() on the TM-T20. bitImageColumnFormat() is another option.
            $y = $printer->cut();
            $z = $printer->close();

            unlink($dest); //eliminamos la imagen generada

            $res['status'] = true;
            $res['message'] = __c('success_print');
        } catch (\Exception $e) {
            $res['status'] = false;
            $res['message'] = $e->getMessage();
        }
        return $res;
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

    public function printBill( $data )
    {
        $filePhp = view("$this->viewPath.bill", compact('data'));
        // return $filePhp;
        $x = Storage::disk('public')->put('/print/bill.html', $filePhp->render());
        $source = Storage::disk('public')->url('/print/bill.html');
        return $this->printHtml($source);
    }

    public function printSalesByPreparations( $data )
    {
        $filePhp = view("$this->viewPath.sales_by_preparations", compact('data'));
        return $filePhp;
        $x = Storage::disk('public')->put('/print/shipping.html', $filePhp->render());
        $source = Storage::disk('public')->url('/print/shipping.html');
        return $this->printHtml($source);
    }
}