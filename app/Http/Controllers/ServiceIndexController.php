<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceIndexController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        return ServiceResource::collection(
            Service::query()
                ->when($request->has('clientId'), function(Builder $query) use ($request) {
                    $query->where('client_id', $request->get('clientId'));
                })
                ->when($request->has('carId'), function(Builder $query) use ($request) {
                    $query->where('car_id', $request->get('carId'));
                })
                ->latest('log_number')
                ->get()
        );
    }
}
