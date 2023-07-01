<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public static $wrap = null;

    public function __construct($resource, $userId, $studentId)
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);
        $this->payment_id = $this->id;
        $this->id = $userId;
        $this->student_id = $studentId;

    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ,
            'payment_id' => $this->id ,
            'student_id' => $this->student_id,
            'amt_paid' => $this->amount,
            'balance' => $this->amount,
            'paid' => true,
            'order_confirm' => $this->when(true, function () {
                if ($this->state == 'approved') {
                    return true;
                } else {
                    return false;
                }
            }),
            'student_my_class_id' => 1,
            'year' => Carbon::create($this->payment_date)->year,
            'month_number' => Carbon::create($this->payment_date)->month,
            'created_at' => $this->payment_date,
            'updated_at' => $this->payment_date,

        ];
    }
}
