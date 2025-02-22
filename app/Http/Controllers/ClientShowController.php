<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ClientShowController extends Controller
{
    public function __invoke(Request $request)
    {
        $clients = Client::query()
            ->when($request->input('name'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->input('name')}%");
            })
            ->when($request->input('cardNumber'), function ($query) use ($request) {
                $query->where('card_number', $request->input('cardNumber'));
            })
            ->with('cars.latestService')
            ->get();

        if($clients->count() != 1) {
            abort(Response::HTTP_BAD_REQUEST, 'pontosítsa a szűrési feltételeket!');
        }

        return new ClientResource($clients->first());
    }
}
