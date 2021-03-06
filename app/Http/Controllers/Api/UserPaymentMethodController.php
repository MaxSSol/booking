<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPaymentMethodRequest;
use App\Http\Requests\UpdateUserPaymentMethodRequest;
use App\Http\Resources\UserPaymentMethodResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return UserPaymentMethodResource::collection($user->paymentMethods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function store(StoreUserPaymentMethodRequest $request)
    {
        $validated = collect($request->validated());
        $user = User::findOrFail(Auth::user()->id);
        $user
            ->paymentMethods()
            ->syncWithoutDetaching(
                [$validated->get('payment_method_id') =>
                    [
                        'bill_number' => $validated->get('bill_number')
                    ]
                ]
            );

        return UserPaymentMethodResource::collection($user->paymentMethods);
    }

    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function update(UpdateUserPaymentMethodRequest $request, $id)
    {
        $validated = collect($request->validated());
        $user = User::findOrFail(Auth::user()->id);
        $user
            ->paymentMethods()
            ->updateExistingPivot(
                $validated->get('payment_method_id'),
                ['bill_number' => $validated->get('bill_number')]
            );

        return UserPaymentMethodResource::collection($user->paymentMethods);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function destroy($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->paymentMethods()->detach($id);
        return UserPaymentMethodResource::collection($user->paymentMethods);
    }
}
