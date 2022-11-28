<?php

namespace App\Http\Requests;

class MoveActionRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'room_id' => 'required|numeric|integer|exists:rooms,id',
        ];
    }
}
