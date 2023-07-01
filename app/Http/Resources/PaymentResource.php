<?php

namespace App\Http\Resources;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public static $wrap = null;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {        
        return [
            'payment_id' => $this->id ,
            'student_id' => $this->order->student->id,
            'amt_paid' => $this->amount,
            'balance' => Payment::where('payment_date', '<=' , $this->payment_date )->sum('amount'),             
            'paid' => true,
            'order_confirm' => $this->state == 'approved'?  true : false,                
            'student_my_class_id' => null, //needed
            'year' => null,
            'month_number' => null,
            'created_at' => $this->payment_date,
            'updated_at' => null,
        ];
    }

}
