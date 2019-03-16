<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function getImport()
    {
        return view('import');
    }

    public function parseImport(CsvImportRequest $request)
    {







    }
    public function processImport(Request $request)
    {

        return Datatables::of(Customer::query())->make(true);
    }

}
