<?php
namespace App\Observers;

use App\Models\Payment;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment)
    {
        if ($payment->installment) {
            $payment->installment->updateStatus();
        }
    }

    /**
     * Handle the Payment "updated" event.
     */
   public function updated(Payment $payment)
    {
        if ($payment->installment) {
            $payment->installment->updateStatus();
        }
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        if ($payment->installment) {
            $payment->installment->updateStatus();
        }
    }
}
