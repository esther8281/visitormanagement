<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Charts\UserChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function create(){
        return view('pages.visitor.create');
    }

    public function store(Request $request){
        $name                               = $request->get('name');
        $mobileno                           = $request->get('mobileno');
        $passportoremirates                 = $request->get('passportoremirates');
        $companyname                        = $request->get('companyname');
        $personname                         = $request->get('personname');
        $visitor                            = new Visitor;
        $visitor->name                      = $name;
        $visitor->mobile_no                 = $mobileno;
        $visitor->passport_or_emiratesno    = $passportoremirates;
        $visitor->company_name              = $companyname;
        $visitor->person_name               = $personname;
        $visitor->save();
        return redirect()->back()->with('success', 'Visitor Added Successfully');
    }
    public function list()
    {
        $visitors = Visitor::all();
        return view('pages.visitor.list',['visitors'=>$visitors]);
    }
    public function searchVisitor(Request $request)
    {
        $name                   = $request->get('name');
        $mobileno               = $request->get('mobileno');
        $companyname            = $request->get('companyname');
        $date                   = $request->get('date');
        
        $visitors               = Visitor::query();
        if ($name) {
            $visitors->where('name', $name);
        }
        if ($mobileno) {
            $visitors->where('mobile_no', $mobileno);
        }
        if ($companyname) {
            $visitors->where('company_name', $companyname);
        }
        if ($date) {
            $visitors->where('created_at','>=', $date);
        }
        
        $searchVisitors  = $visitors->get();
        $visitorView = view('pages.visitor.visitorsearch', ['visitors' => $searchVisitors])->render();
        $data =['visitorView' => $visitorView];
        return $data;  
    }
    public function dashboard()
    {
        $visitorsByCompany = Visitor::select('company_name')->groupBy('company_name')->get();

        $visitors      = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("company_name"))
                    ->groupBy(DB::raw("company_name"))
                    ->pluck('count', 'company_name');

        $visitors1      = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("Date(created_at) as date"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("date"))
                    ->pluck('count', 'date');
        
        $labels     = $visitors->keys();
        $data       = $visitors->values();

        $labels1    = $visitors1->keys();
        $data1      = $visitors1->values();
           
        return view('pages.visitor.dashboard', compact('labels', 'data','labels1','data1','visitorsByCompany'));
    }
    public function searchByGraph(Request $request)
    {
        $companyname    = $request->get('companyame');
        
        if($companyname){
            $visitors   = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("company_name"))
                        ->where('company_name', $companyname)
                        ->groupBy(DB::raw("company_name"))
                        ->pluck('count', 'company_name');

        }else{
            $visitors   = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("company_name"))
                        ->groupBy(DB::raw("company_name"))
                        ->pluck('count', 'company_name');

        }
        $labels     = $visitors->keys();
        $data       = $visitors->values();
        $datagraph = ['labels' => $labels,'data' => $data];
        return $datagraph;
    }
    public function searchByDateRange(Request $request)
    {
        $startDate      = $request->get('startDate');
        $endDate        = $request->get('endDate');
        
        if($startDate && $endDate){
            $visitors   = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("Date(created_at) as date"))
                        ->whereBetween('created_at', [$startDate.' 00:00:00',$endDate.' 23:59:59'])
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("date"))
                        ->pluck('count', 'date');
        }else{
            $visitors   = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("Date(created_at) as date"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("date"))
                        ->pluck('count', 'date');

        }

        $labels     = $visitors->keys();
        $data       = $visitors->values();
        $datagraph = ['labels' => $labels,'data' => $data];
        return $datagraph;
    }
    public function edit(Request $request)
    {
        $id =   $request->visitor;
        if($id){
            $visitor = Visitor::where('id',$id)->first();
            return view('pages.visitor.edit',['visitor'=>$visitor]);
        }
    }
    public function update(Request $request)
    {
        $id =   $request->visitor;
        if($id){
            $name                               = $request->get('name');
            $mobileno                           = $request->get('mobileno');
            $passportoremirates                 = $request->get('passportoremirates');
            $companyname                        = $request->get('companyname');
            $personname                         = $request->get('personname');
            $visitor                            = Visitor::where('id',$id)->first();
            if($visitor)
            {
                $visitor->name                      = $name;
                $visitor->mobile_no                 = $mobileno;
                $visitor->passport_or_emiratesno    = $passportoremirates;
                $visitor->company_name              = $companyname;
                $visitor->person_name               = $personname;
                $visitor->save();
                return redirect()->intended('visitor/list');
            }   
        }
    }
    public function delete(Request $request)
    {
        $id =   $request->visitor;
        if($id){
            $visitor = Visitor::where('id',$id)->delete();
            return redirect()->intended('visitor/list');
        }
    }
}
