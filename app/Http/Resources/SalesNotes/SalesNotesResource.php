<?php

namespace App\Http\Resources\SalesNotes;

use App\Models\Customers;
use App\Models\SalesNotesProducts;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesNotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $users = User::all();
        $customers = Customers::all();
        $products = SalesNotesProducts::all();
        return [
            '_id' => $this->_id,
            'user_id' => $users->find($this->user_id),
            'sales_notes_product_id' => $products->find($this->sales_notes_product_id),
            'invoice_number' => $this->invoice_number,
            'subtotal' => $this->subtotal,
            'client_id' => $customers->find($this->client_id),
            'discount' => $this->discount,
            'date' => $this->date,
            'observation' => $this->observation,
            'forma_pago' => $this->forma_pago,
            'iva' => $this->iva,
            'total' => $this->total,
            'state' => $this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
