<?php

namespace App\Http\Controllers;

use App\Family_card;
use Illuminate\Http\Request;

class Family_cardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kk = Family_card::select('family_cards.family_card_number','house_building_id')
                            ->selectRaw('count(citizens.national_identity_number) as jumlah')
                            ->leftJoin('citizens', 'family_cards.family_card_number', '=', 'citizens.family_card_number')
                            ->groupBy('family_cards.family_card_number')
                            ->orderBy('family_card_number')
                            ->get();
        //return $kk;
        return view ('admin.kependudukan.keluarga',['kk' => $kk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'family_card_number' => 'required|max:25|unique:family_cards'
        ]);
        $request->family_card_number = str_replace("`", "", $request->family_card_number);
        Family_card::create($request->all());
        $pesan = "<b>".$request->family_card_number.'</b> added successfully';
        return redirect('/keluarga')->with('status', $pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family_card  $family_card
     * @return \Illuminate\Http\Response
     */
    public function show(Family_card $family_card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family_card  $family_card
     * @return \Illuminate\Http\Response
     */
    public function edit(Family_card $family_card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family_card  $family_card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family_card $family_card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family_card  $family_card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family_card $family_card)
    {
        //
    }
}
