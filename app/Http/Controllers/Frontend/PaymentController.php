<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout(Booking $booking)
    {

        Stripe::setApiKey(
            config('services.stripe.secret')
        );

        $session = Session::create([

            'payment_method_types' => [
                'card',
            ],

            'line_items' => [[

                'price_data' => [

                    'currency' => 'inr',

                    'product_data' => [

                        'name' => 'BookingFlow Bus Ticket',

                    ],

                    'unit_amount' => $booking->total_amount * 100,

                ],

                'quantity' => 1,

            ]],

            'mode' => 'payment',

            'success_url' => route('payment.success', $booking),

            'cancel_url' => route('payment.cancel', $booking),

        ]);

        return redirect(
            $session->url
        );

    }

    public function success(Booking $booking)
    {

        $booking->update([

            'payment_status' => 'paid',

            'booking_status' => 'confirmed',

        ]);

        return redirect()
            ->route(
                'booking.confirmation',
                $booking
            );

    }

    public function cancel(Booking $booking)
    {

        return redirect()
            ->route(
                'booking.confirmation',
                $booking
            )
            ->with(
                'error',
                'Payment cancelled'
            );

    }
}
