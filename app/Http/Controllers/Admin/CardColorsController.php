<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CentralLogics\Helpers;
use App\Model\CardColor;
use Illuminate\Http\Request;
use App\Traits\OfferTrait;

class CardColorsController extends Controller
{
    use OfferTrait;
    public function index()
    {
        $data = CardColor::where('deleted','0')->get();
        return view('admin-views.card_colors.index', compact('data'));
    }
    public function create()
    {
        return view('admin-views.card_colors.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        CardColor::Create($input);
        return redirect()->route('admin.card_colors.list');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $data = CardColor::find($id);
        return view('admin-views.card_colors.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        $cardColor = CardColor::find($id);
        $cardColor->name_ar = $request->name_ar;
        $cardColor->name_en = $request->name_en;
        $cardColor->color_code = $request->color_code;
        $cardColor->save();
        return redirect()->route('admin.card_colors.list');
    }


    public function destroy($id)
    {
        $wraping = CardColor::find($id);
        $wraping->deleted = '1';
        $wraping->save();
        return \redirect()->route('admin.card_colors.list');
    }
}
