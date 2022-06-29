<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->location_id = $request->location_id;
        $item->save();

        $request->session()->flash('link', 'Stubbed out <a href="/items/'.$item->id.'/edit">'.$item->name.'</a>.');

        return redirect()->back()->withInput($request->except('name','description'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $item = Item::find($id);
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $item = Item::find($id);
        $item->name = $request->name;
        $item->description = $request->description ?? null;
        $item->location_id = $request->location_id ?? null;
        $item->make_model = $request->make_model ?? null;
        $item->serial_number = $request->serial_number ?? null;
        $item->date_purchased = $request->date_purchased ?? null;
        $item->where_purchased = $request->where_purchased ?? null;
        $item->purchase_price = ($request->purchase_price * 100 ?? null);
        $item->estimated_value = ($request->estimated_value * 100 ?? null);
        $item->save();
        return redirect()->to('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
