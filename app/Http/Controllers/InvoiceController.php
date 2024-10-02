<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function index()
    {
        $data['invoices'] = Invoice::with('product')->orderBy('id', 'desc')->get();
        return Inertia::render('Invoices/Index', $data);
    }

    public function showRawResponse($id)
    {
        $invoice = Invoice::find($id)->raw_response;
        $result = json_decode($invoice, true);
        return response()->json($result);
    }
}
