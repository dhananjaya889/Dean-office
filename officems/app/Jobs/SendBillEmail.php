<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillEmail;

class SendBillEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $billData;
    public $imagePath;

    /**
     * Create a new job instance.
     */
    public function __construct($billData, $imagePath)
    {
        $this->billData = $billData;
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        info("call");
        $user = User::find($this->billData['assign_user']);

        if ($user && $user->email) {
            Mail::to($user->email)->send(new BillEmail($this->billData, $this->imagePath));
        }
    }
}
