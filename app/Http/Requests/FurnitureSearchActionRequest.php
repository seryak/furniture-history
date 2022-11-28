<?php

namespace App\Http\Requests;

class FurnitureSearchActionRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'flat_id' => 'required|numeric|integer|exists:flats,id',
            'room_id' => 'nullable|numeric|integer|exists:rooms,id',
            'time' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
