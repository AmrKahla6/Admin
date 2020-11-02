<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
use App\member;
use App\item;
use App\order;
use App\order_item;
use App\setting;

class adminitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $allitems   = item::orderBy('id', 'desc')->get();

        return view('admin.items.index', compact('mainactive', 'logo', 'subactive', 'allitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mainactive = 'items';
        $subactive  = 'additem';
        $logo       = DB::table('settings')->value('logo');
        return view('admin.items.create', compact('mainactive', 'subactive', 'logo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'artitle'     => 'required|max:200',
            'price'       => 'required',
        ]);
        $newitem                = new item;
        $newitem->artitle       = $request['artitle'];
        $newitem->price         = $request['price'];
        $newitem->details       = $request['ardesc'];

        if ($request->hasFile('image')) {
            $item = $request['image'];
            $img_name = rand(0, 999) . '.' . $item->getClientOriginalExtension();
            $item->move(base_path('users/images/'), $img_name);
            $newitem->image   = $img_name;
        }
        $newitem->save();
        session()->flash('success', 'تم اضافة المنتج بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $showitem   = item::findorfail($id);

        return view('admin.items.show', compact('mainactive', 'logo', 'subactive', 'showitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mainactive = 'items';
        $subactive  = 'item';
        $logo       = DB::table('settings')->value('logo');
        $editem     = item::findorfail($id);
        return view('admin.items.edit', compact('mainactive', 'logo', 'subactive', 'editem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upitem = item::find($id);
        if (Input::has('suspensed')) {
            if ($upitem->suspensed == 0) {
                DB::table('items')->where('id', $id)->update(['suspensed' => 1]);
                session()->flash('success', 'تم تعطيل المنتج بنجاح');
                return back();
            } else {
                DB::table('items')->where('id', $id)->update(['suspensed' => 0]);
                session()->flash('success', 'تم تفعيل المنتج بنجاح');
                return back();
            }
        } else {
            $this->validate($request, [
                'artitle'     => 'required|max:200',
                'price'       => 'required',
            ]);


            $upitem->artitle       = $request['artitle'];
            $upitem->price         = $request['price'];
            $upitem->details        = $request['ardesc'];
            if ($request->hasFile('image')) {
                $item = $request['image'];
                $img_name = rand(0, 999) . '.' . $item->getClientOriginalExtension();
                $item->move(base_path('users/images/'), $img_name);
                $upitem->image   = $img_name;
            }
            $upitem->save();


            session()->flash('success', 'تم تعديل المنتج بنجاح');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delitem = item::find($id);
        if ($delitem) {
            $order_items = order_item::where('item_id', $delitem->id)->get();
            foreach ($order_items as $order_item) {
                $order =  order::where('id', $order_item->order_id)->first();
                if ($order) {
                    $order->delete();
                }
                $order_item->delete();
            }
        }
        $delitem->delete();
        session()->flash('success', 'تم حذف المنتج بنجاح');
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids           = $request->ids;
        $selecteditems = DB::table("members")->whereIn('id', explode(",", $ids))->get();
        foreach ($selecteditems as $item) {
            $order_items = order_item::where('item_id', $item->id)->get();
            foreach ($order_items as $order_item) {
                $order =  order::where('id', $order_item->order_id)->first();
                if ($order) {
                    $order->delete();
                }
                $order_item->delete();
            }
            $item->delete();
        }
        return response()->json(['success' => "تم الحذف بنجاح"]);
    }
}