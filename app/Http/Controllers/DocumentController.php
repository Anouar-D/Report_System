<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Report;
use App\User;

class DocumentController extends Controller
{
    public function createDocument(Request $request){
        $reports = Report::orderBy('created_at', 'desc')->with('user')->get();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->addTitleStyle(1, array('name'=>'HelveticaNeueLT Std Med', 'style'=>'Title', 'size'=>16, 'color'=>'990000'));
        $section = $phpWord->addSection();
        $section->addTitle('Report - '.date_format(NOW(), 'd/m/Y'), 1);
        $text = $section->addText('________________________________________________________________________________');
        foreach($reports as $report){
            $text = $section->addText(date_format($report->created_at, 'd/m/Y H:i:s').' | '.$report->title.' | '.$report->user->first_name.' '.$report->user->last_name);
            \PhpOffice\PhpWord\Shared\Html::addHtml($section, $report->report);
            $text = $section->addText('________________________________________________________________________________');
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Report.docx');

        return response()->download(public_path('Report.docx'));
    }
}
