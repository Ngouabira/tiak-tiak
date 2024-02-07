<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderDeliveryRequestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function (OrderDeliveryRequest $orderDeliveryRequest) {
                return new OrderDeliveryRequestResource($orderDeliveryRequest);
            }),
            'meta' => [
                'total_orderDeliveryRequest' => $this->collection->count(),
            ],
        ];
    }
}
