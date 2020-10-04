<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\User;
use Auth;

class ReportController extends Controller
{

     /**
     * Searching a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $users = User::with('report')->where('first_name', 'like', $request->search.'%')->orWhere('last_name', 'like', $request->search.'%')->orderBy('first_name', 'ASC')->get();
        return view('report.search')->with('users', $users)->with('oldSearch', $request->search);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->paginate(3);
        return view('report.index')->with('reports', $reports);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'report' => ['required', 'max:65530'],
        ]);

        $report = new Report();
        $report->user_id = Auth::id();
        $report->title = $request->title;
        $report->report = $request->report;
        
        if($report->save()){
            return redirect()->route('report.index')->with('status', 'Report toegevoegd!');
        }
        else{
            return redirect()->back()->with('status_fail', 'Report is niet toegevoegd! probeer later opnieuw.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        return view('report.edit')->with('report', $report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'report' => ['required', 'max:65530'],
        ]);

        $report = Report::findOrFail($id);
        $report->title = $request->title;
        $report->report = $request->report;
        if($report->save()){
            return redirect()->route('report.index')->with('status', 'Report Aangepast!');
        }
        else{
            return redirect()->back()->with('status_fail', 'Report is niet Aangepast! probeer later opnieuw.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->is_admin){
            $report = Report::findOrFail($id);
            $report->delete();
            return redirect()->back()->with('status', 'Report is verwijderd!');
        }
        return abort(403);
    }
}
