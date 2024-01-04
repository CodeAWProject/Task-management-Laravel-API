<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CardResource::collection(Card::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $card = Card::create([
            ...$request->validate([
                'name' => 'required|string|max:255',
                'priority' => 'required|string|max:25'
            ]),
            'user_id' => 2
        ]);

        return new CardResource($card);
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return new CardResource($card);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $card->update($request->validate([
            'name' => 'sometimes|string|max:255',
            'priority' => 'sometimes|string|max:25'
        ]));

        return new CardResource($card);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return response(status: 204);
    }
}
