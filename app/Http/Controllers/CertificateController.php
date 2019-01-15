<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    public function index(){
        $id = abs( crc32( uniqid() ) );

        $NAME = "Kasya Vasya Aykhan";
        $SN = $id;
        $IB = "ASSYLKHAN ALDANAZAR";
        $PB = "ASTC Global";
        $CN = "QAZAQ AIR";

        $pdf = new Fpdi( 'P', 'mm', 'A4');
        $pageCount = $pdf->setSourceFile('assets/certificates/certificate.pdf');
        $tplIdx = $pdf->importPage(1);

        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0, 210, 297);
        $pdf->SetMargins(0,0,0,0);
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial','', '10');
        $pdf->SetTextColor(255,255,255);
        $pdf->SetXY(160, 10);
        $pdf->Write(0, 'SN:'.$SN);

        $pdf->SetFont('Arial','B', '16');
        $pdf->SetTextColor(255,255,0);

        $x = 120;
        $y = 5;
        $pdf->SetXY($y, $x);
        $pdf->Write(0, "TO VALUABLE PARTICIPANT");
        $pdf->SetXY($y, $x += 7.5);
        $pdf->Write(0, "  OF THE ONLINE SEMINAR ");
        $pdf->SetXY($y, $x += 7.5);
        $pdf->Write(0, "      SPRING - SUMMER    ");
        $pdf->SetXY($y, $x += 7.5);
        $pdf->Write(0, " SEASONAL PREPARATION  ");
        $pdf->SetXY($y, $x += 7.5);
        $pdf->SetFont('Arial','B', '20');
        $pdf->SetTextColor(255,255,255);
        $pdf->Write(0, $NAME);
        $pdf->SetTextColor(255,255,0);
        $pdf->SetXY($y, $x += 7.5);
        $pdf->SetFont('Arial','I', '15');
        $pdf->Write(0, '            '.date('F Y'));

        $pdf->SetFont('Arial','B', '14');
        $x = 105; $y = 276;
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "INSPIRED BY ".$IB);///print this output
        $pdf->SetXY($x, $y+6.5);
        $pdf->Write(0, "POWERED BY: ".$PB);///print this output
        $pdf->SetXY($x, $y+13);
        $pdf->Write(0, "ON BEHALF AND FOR: ".$CN);///print this output
        $pdf->Output('gift_coupon_generated.pdf','I' ,true);
    }


}
