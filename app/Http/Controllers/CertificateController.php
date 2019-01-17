<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Student;
use App\StudentCertificate;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use setasign\Fpdi\Fpdi;

class CertificateController extends Controller
{
    public function index()
    {


    }

    public function give($IdNo)
    {

        $id = 'SN: '.$IdNo;

        $data = StudentCertificate::select('*')
            ->where('IdNo', '=', $IdNo)
            ->first();
        $certificate_data = Certificate::select('*')
            ->where('subject_id' , '=' , $data->subject_id)
            ->first();
        $student_info = Student::select('*')
            ->where('user_id' , '=' , $data->user_id)
            ->first();
        $student_name = $student_info->firstName." ".$student_info->lastName;

        $NAME = $student_name;
        $SN = $id;
        $IB = $certificate_data->inspired_by;
        $PB = "ASTC Global";
        $CN = $certificate_data->on_behalf_and_for;

        $pdf = new Fpdi('P', 'mm', 'A4');
        $pageCount = $pdf->setSourceFile('assets/certificates/certificate.pdf');
        $tplIdx = $pdf->importPage(1);

        $pdf->addPage();
        $pdf->useTemplate($tplIdx, 0, 0, 210, 297);
        $pdf->SetMargins(0, 0, 0, 0);
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont('Arial', '', '10');
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetXY(160, 10);
        $pdf->Write(0, '' . $SN);

        $pdf->SetFont('Arial', 'I', '20');
        $pdf->SetTextColor(255, 255, 0);

        $x = 120;
        $y = 5;
        if($certificate_data->text1 != null) {
            $pdf->SetFont('Arial', 'B', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->SetXY($y, $x);
            $pdf->Write(0, strtoupper($certificate_data->text1));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text2 != null) {
            $pdf->SetFont('Arial', 'B', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->Write(0, strtoupper($certificate_data->text2));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text3 != null) {
            $pdf->SetFont('Arial', 'BI', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->Write(0, strtoupper($certificate_data->text3));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text4 != null) {
            $pdf->SetFont('Arial', 'BI', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->Write(0, strtoupper($certificate_data->text4));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text5 != null) {
            $pdf->SetFont('Arial', 'BI', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->SetXY($y, $x);
            $pdf->Write(0, strtoupper($certificate_data->text5));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text6 != null) {
            $pdf->SetFont('Arial', 'BI', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->Write(0, strtoupper($certificate_data->text6));
            $pdf->SetXY($y, $x += 7.5);
        }
        if($certificate_data->text7 != null) {
            $pdf->SetFont('Arial', 'B', '20');
            $pdf->SetTextColor(255, 255, 0);
            $pdf->Write(0, strtoupper($certificate_data->text7));
            $pdf->SetXY($y, $x += 7.5);
        }

        $pdf->SetFont('Arial', 'B', '22');
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Write(0, $NAME);
        $pdf->SetTextColor(255, 255, 0);
        $pdf->SetXY($y, $x += 7.5);
        $pdf->SetFont('Arial', 'B', '16');
        $pdf->Write(0, '            ' .  date('F Y',strtotime($certificate_data->created_at)));

        $pdf->SetFont('Arial', 'B', '10');
        $x = 125;
        $y = 276;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY($x, $y);
        $pdf->Write(0, "INSPIRED BY: " . $IB);///print this output
        $pdf->SetXY($x, $y + 6.5);
        $pdf->Write(0, "POWERED BY: " . $PB);///print this output
        $pdf->SetXY($x, $y + 13);
        $pdf->Write(0, "ON BEHALF AND FOR: " . $CN);///print this output
        $pdf->Output('gift_coupon_generated.pdf', 'I', true);
    }


}
