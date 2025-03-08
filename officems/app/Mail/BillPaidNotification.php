<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Bill;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

// class BillPaidNotification extends Mailable
// {
//     use SerializesModels;

//     public $bill;

//     public function __construct(Bill $bill)
//     {
//         $this->bill = $bill;
//     }

//     public function build()
//     {
//         return $this->subject('Bill Payment Completed')
//                     ->view('emails.bill_paid')
//                     ->with(['bill' => $this->bill]);
//     }
// }
