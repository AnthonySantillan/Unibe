<?php

namespace App\Http\Resources\SalesNotesProducts;

use App\Models\Products;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesNotesProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = Products::all();
        return [
            '_id' => $this->_id,
            'product_id' => $products->find($this->product_id),
            'sales_notes_id' =>  $this->sales_notes_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'importe' => $this->importe,
            'discount' => $this->discount,
            'unit_value' => $this->unit_value,
            'iva' => $this->iva,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
