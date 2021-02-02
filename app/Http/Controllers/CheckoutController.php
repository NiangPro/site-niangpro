<?php

namespace App\Http\Controllers;

use App\Order;
use DateTime;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::count() <= 0) {
            return redirect()->route("product.index")->with([
                'current_page' => 'shop',
            ]);
        }
        Stripe::setApiKey('sk_test_51HNVghDvpK43F8S9x5IJcF7eiLwt0G4hiNBmi9CWmLQIJ1LdKjo9LhcLny65KaAtkC0hPChY4MfO0kW0xVel9tjC009EDhGZqN');

        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'eur'
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');

        return view('checkout.index')->with([
            'current_page' => 'shop',
            'clientSecret' => $clientSecret
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->json()->all();

        $order = new Order();

        $order->payment_intent_id = $data['payment_intent']['id'];
        $order->amount = $data['payment_intent']['amount'];

        $order->payment_created_at = (new DateTime())->setTimestamp($data['payment_intent']['created'])->format('Y-m-d H:i:s');

        $products = [];
        $i = 0;

        foreach (Cart::content() as $product) {
            $products['product_' . $i][] = $product->model->title;
            $products['product_' . $i][] = $product->model->price;
            $products['product_' . $i][] = $product->model->qty;

            $i++;
        }

        $order->products = serialize($products);

        $order->user_id = Auth()->user()->id;

        $order->save();

        if ($data['payment_intent']['status'] === 'succeeded') {
            Cart::destroy();

            Session::flash('success', 'Votre commande a été traitée avec succès.');
            return response()->json(['success' => 'Payment Intent Succeeded']);
        } else {
            return response()->json(['error' => 'Payment Intent Not Succeeded']);
        }
    }

    /**
     * thankyou
     *
     * @return void
     */
    public function thankyou()
    {
        return Session::has('successs')
            ? view('checkout.thankyou', ['current_page' => 'shop'])
            : view('ecommerce.products.index', ['current_page' => 'shop']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
