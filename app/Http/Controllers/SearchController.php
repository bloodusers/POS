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

    public function search(Request $request)
    {

        if ($request->ajax()) {
            if ($request->search) {
                $output = "";
                $products = DB::table('items')->where('name', 'LIKE', '%' . $request->search . "%")->whereIn('category_id', getFeild('id', 'categories', 'organization_id =' . Auth::user()->organization_id))
                    ->get();
                if ($products) {
                    $output.='<table class="table table-bordered table-hover">'.
                    '<thead>'.
                    '<tr>'.
                        '<th>ID</th>'.
                        '<th>Product Name</th>'.
                        '<th>Description</th>'.
                        '<th>Price</th>'.
                       '<th>Add item</th>'.
                    '</tr>'.
                    '</thead>'.
                        '<tbody>';

                    foreach ($products as $key => $product) {
                        $output .= '<tr>' .
                            '<td>' . $product->id . '</td>' .
                            '<td>' . $product->name . '</td>' .
                            '<td>' . $product->description . '</td>' .
                            '<td>' . $product->price . '</td>' .
                            '<td>
                            <li>
                                                                <a href="#" onclick="
                                                                    var result=confirm(\'Are you Sure you Want to remove'. ucfirst($product->name).'\');
                                                                    if(result)
                                                                    {
                                                                    event.preventDefault();
                                                                    document.getElementById('.$product->id.').submit();
                                                                    }"

                                                                >
                                                                    <button type="submit"
                                                                            class="btn red-button"
                                                                            style="padding-right: 35px;padding-left: 35px;border-radius: 5%;border-style: none">
                                                                        Add
                                                                    </button>
                                                                </a>
                                                                <form id="{{$cat->id}}" method="post"
                                                                      action="{{route(`Category.destroy`,[$cat->id])}}"
                                                                      style="display: none">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="delete">
                                                                </form>
                                                            </li>
                                                            </td>' .
                            '</tr>';
                    }
                   $output.= '</tbody>'.
                    '</table>';
                   //dd($output);
                    return Response($output);
                }
            }
        }
    }
}
