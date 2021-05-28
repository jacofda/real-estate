<?php

namespace Areaseb\Estate\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Accounting\Requests\{EditInvoice, CreateInvoice};
use Areaseb\Estate\Models\{Category, Company, Exemption, Invoice, InvoicePayment, InvoiceNotice, Item, Primitive, Product, Setting, Stat};
use \Carbon\Carbon;

class InvoicePaymentController extends Controller
{
    public function show(Invoice $invoice)
    {
        return view('estate::core.accounting.payments.show', compact('invoice'));
    }

    public function store(Request $request, $invoice)
    {

        $invoice = Invoice::find($invoice);
        $total = $invoice->total;

        $payed = $invoice->payments()->sum('amount');

        if($total > ($payed+$request->amount))
        {
            InvoicePayment::create([
                'invoice_id' => $invoice->id,
                'amount' => $request->amount,
                'payment_type' => $request->tipo_saldo,
                'date' => Carbon::createFromFormat('d/m/Y',$request->data)
            ]);
            return back()->with('message', 'Rata aggiunta');
        }
        elseif($total == ($payed+$request->amount))
        {
            InvoicePayment::create([
                'invoice_id' => $invoice->id,
                'amount' => $request->amount,
                'payment_type' => $request->tipo_saldo,
                'date' => Carbon::createFromFormat('d/m/Y',$request->data)
            ]);

            $invoice->update([
                'data_saldo' => $request->data,
                'saldato' => 1,
                'tipo_saldo' => $request->tipo_saldo
            ]);

            return back()->with('message', 'Rata aggiunta ed ora la fattura risulta completamente saldata');
        }
        else
        {
            return back()->with('error', 'Rata NON aggiunta. Quantità maggiore della richiesta');
        }


    }

    public function destroy(InvoicePayment $payment)
    {
        $invoice = $payment->invoice;
        $payment->delete();
        $invoice->update(['saldato' => 0, 'data_saldo' => null]);

        return back()->with('message', 'Rata eliminata');
    }

    public function storeNotice(Request $request, $invoice)
    {
        InvoiceNotice::create([
            'invoice_id' => $invoice,
            'response' => $request->response,
            'type' => $request->type,
            'date' => Carbon::createFromFormat('d/m/Y',$request->date)
        ]);
        return back()->with('message', 'Rata aggiunta');
    }

    public function destroyNotice($notice)
    {
        InvoiceNotice::find($notice)->delete();
        return back()->with('message', 'Sollecito rimosso');
    }


}
