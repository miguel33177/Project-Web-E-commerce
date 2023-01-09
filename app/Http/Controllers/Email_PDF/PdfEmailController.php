<?php

namespace App\Http\Controllers\Email_PDF;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;
use Mail;

class PdfEmailController extends Controller
{
    //Function to send email with pdf attached after successful payment. 
    //In addition, it saves the pdf in the database for each order.
    public function sendMailWithPDF($orderId)
    {
        $data["email"] = "test@gmail.com";
        $data["title"] = "Details of your order";
        $data["body"] = "This is the email body.";

        $products = DB::table('ordereds')
        ->join('orders', 'ordereds.orderId', '=', 'orders.id')
        ->join('products', 'products.id', '=', 'ordereds.productId')
        ->select('ordereds.quantity', 'products.nameProduct', 'products.price','orders.priceTotal', 'orders.id')
        ->where('ordereds.orderId', '=', $orderId)
        ->get();

        $orders = DB::table('orders')
            ->join('residences', 'orders.residenceId', '=', 'residences.id')
            ->select('orders.*', 'residences.*')
            ->where('orders.id', '=', $orderId)
            ->get();

        $shipping = 5;
       
        $pdf = PDF::loadView('email.emailPdf', compact('products' , 'shipping' , 'orders'));

        $order = Order::find($orderId);
        $filename = $orderId . '.pdf';

        $pdf->save('storage/attachments/'. $filename);
        $order->pdf ='storage/attachments/' . $filename;
        $order->save();
      
        Mail::send('email.emailBody', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "test.pdf");
        });

        return redirect()->route('payment');
    }
}

