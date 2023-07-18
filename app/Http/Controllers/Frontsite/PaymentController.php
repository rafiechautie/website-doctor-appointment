<?php

namespace App\Http\Controllers\Frontsite;


//use library here
use App\Http\Controllers\Controller;
use App\Models\MasterData\ConfigPayment;
use App\Models\Operational\Appointment;
use App\Models\Operational\Transaction;
use Exception;
use Illuminate\Http\Request;

//user everything here

//use model here

//Use thirdparty in here



class PaymentController extends Controller
{

    public function __construct()
    {
        //menandai bahwa landing page boleh digunakan secara full ketika user sudah login
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.frontsite.payment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // set random code for transaction code
        $data['transaction_code'] = Str::upper(Str::random(8) . '-' . date('Ymd'));

        $appointment = Appointment::where('id', $data['appointment_id'])->first();
        $config_payment = ConfigPayment::first();

        // set transaction
        $specialist_fee = $appointment->doctor->specialist->price;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        // total
        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        // total with vat and grand total
        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        // save to database
        $transaction = new Transaction();
        $transaction->appointment_id = $appointment['id'];
        $transaction->transaction_code = $data['transaction_code'];
        $transaction->fee_doctor = $doctor_fee;
        $transaction->fee_specialist = $specialist_fee;
        $transaction->fee_hospital = $hospital_fee;
        $transaction->sub_total = $total;
        $transaction->vat = $total_with_vat;
        $transaction->total = $grand_total;
        $transaction->save();

        // midtrans here
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // set all for midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $data['transaction_code'],
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        // redirect to website midtrans
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            // header('Location: ' . $paymentUrl);
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // update status appointment
        // $appointment = Appointment::find($appointment->id);
        // $appointment->status = 1; // set to completed payment
        // $appointment->save();

        // return redirect()->route('payment.success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return abort(404);
    }

    // custom

    public function payment($id)
    {
        $appointment = Appointment::where('id', $id)->first();
        $config_payment = ConfigPayment::first();

        // set value
        $specialist_fee = $appointment->doctor->specialist->price;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        return view('pages.frontsite.payment.index', compact('appointment', 'config_payment', 'total_with_vat', 'grand_total', 'id'));
    }

    public function success()
    {
        return view('pages.frontsite.success.payment-success');
    }

    public function callback()
    {
        // set configuration midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // instance midtrans notification
        $notification = new Notification();

        // Assign ke variable
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // search transaction by transaction code
        $transaction = Transaction::findOrFail('transaction_code', $order_id);
        $appointment_id = $transaction->appointment->id;

        // Handle notification status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                    $status_appointment = 0;
                } else {
                    $transaction->status = 'SUCCESS';
                    $status_appointment = 1;
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
            $status_appointment = 1;
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
            $status_appointment = 0;
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
            $status_appointment = 2;
        }

        // update status appointment
        $appointment = Appointment::find($appointment_id);
        $appointment->status = $status_appointment; // set to completed payment
        $appointment->save();

        return redirect()->route('payment.success');
    }
}
