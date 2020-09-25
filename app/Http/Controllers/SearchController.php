<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.search');
    }

    public function getItemWithId($id)
    {
        return Item::find($id);
    }

    public function search(Request $request)
    {

        if ($request->ajax()) {
            if ($request->search) {
                $output = "";
                $products = DB::table('items')->where('name', 'LIKE', '%' . $request->search . "%")->whereIn('category_id', getFeild('id', 'categories', 'organization_id =' . Auth::user()->organization_id))
                    ->get();
                if ($products) {
                    foreach ($products as $key => $product) {
                        if ($output)
                            $output .= "<hr/>";
                        $output .= "<a id='" . $product->id . "' href=# style='text-decoration: underline;' onclick='addToTable($product->id)'>" . $product->name . "</a>";
                    }
                    //dd($output);
                    return Response($output);
                }
            }
        }
    }
}
