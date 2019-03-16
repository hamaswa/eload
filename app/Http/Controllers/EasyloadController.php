<?php

namespace App\Http\Controllers;

use App\Easyload;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Customer;

class EasyloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("update");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data = Excel::load($path, function ($reader) {
        })->get()->toArray();
        foreach ($data as $row) {
            $customer = Customer::where("email",$row['email_address'])->get();
            if(count($customer) !== 0){
                $easyload = new Easyload();
                $easyload->customer_id = $customer[0]['id'];
                $easyload->tid = $row['tid'];
                $easyload->caticawi = $row['caticawi'];
                $easyload->amount = $row['amount'];              ;
                $easyload->save();
            }
        }
        //redirect()->route('customers');
        return view ("customers",array(['msg'=>"Successfully uploaded"]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$query = "Select * from easyloads where customer_id = " . $id;
        return Datatables::of(Easyload::where("customer_id",$id))->make(true);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
