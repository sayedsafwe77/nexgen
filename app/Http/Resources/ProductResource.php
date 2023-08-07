<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        if ($request->example_excel) {
            return [
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'function' => $this->function,
                'model_number' => $this->model_number,
                'discount' => $this->discount,
                'comment' => $this->comment,
            ];
        }

        return [
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'function' => $this->function,
            'model_number' => $this->model_number,
            'discount' => $this->discount,
            'comment' => $this->comment,
        ];
    }
}
