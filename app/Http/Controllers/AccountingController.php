<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Payment;
use App\Config;

class AccountingController extends Controller
{
    public function index() {
      return view('payments.read')->withApartments(Apartment::paginate(8));
    }
    public function getPaymentsData(Request $request) {
      echo $request->apartment;
      //return response()->json(['payments' => $request->apartment]);
    }
    public function create() {
      return view('payments.create');
    }
    public function settings() {
      return view('calendario')->withConfig(Config::first());
    }
    public function storeOlderDebtor(Request $request) {
      $config = Config::first();
      $config->older_debtor = $request->older_debtor;
      $config->save();
    }
    public function listaSolventes() {
      return view('payments.read')->withApartments(Apartment::where('last_paid', '=', date('d-m-Y'))->paginate(10));
    }
}
