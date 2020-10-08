@extends('layouts.theme')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <table class="container-fluid p-400">
                        <thead>
                        <tr>
                            <td><img src="/storage/{{(\App\User::find($data[0]->user_id)->organization->logo)}} "
                                     height="70px" width="70px"/></td>
                            <td><h3 class="text-right">
                                    Sale Invoice
                                </h3></td>
                            <td>
                                <div class="">
                                    <h3 class="text-right ml-0">
                                        {{--                                        {{$data[0]->created_at}}--}}
                                        Date: {{\Carbon\Carbon::parse($data[0]->created_at)->year}}
                                        /{{\Carbon\Carbon::parse($data[0]->created_at)->month}}
                                        /{{\Carbon\Carbon::parse($data[0]->created_at)->day}}
                                        <br>
                                        Time: {{\Carbon\Carbon::parse($data[0]->created_at)->hour}}
                                        :{{\Carbon\Carbon::parse($data[0]->created_at)->minute}}
                                        :{{\Carbon\Carbon::parse($data[0]->created_at)->second}}
                                    </h3>
                                </div>
                            </td>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-body">
                    <h4>Customer name: {{ucfirst($data[0]->customerName)}}</h4>
                    <h4>User Name: {{ucfirst(\App\User::find($data[0]->user_id)->name)}}</h4>
                    <table class="table container-fluid p-500 table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Sr.</th>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @for($i=0;$i<sizeof($data[0]->invoiceItems);$i++)
                            @if($data[0]->invoiceItems[$i]->qty-$data[0]->invoiceItems[$i]->returnQty)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{\App\Item::find($data[0]->invoiceItems[$i]->item_id)->name}}</td>
                                <td>{{$data[0]->invoiceItems[$i]->price}}</td>
                                <td>{{$data[0]->invoiceItems[$i]->qty-$data[0]->invoiceItems[$i]->returnQty}}</td>
                                <td>{{$data[0]->invoiceItems[$i]->price*$data[0]->invoiceItems[$i]->qty}}</td>
                            </tr>
                            @endif
                        @endfor
                        </tbody>
                    </table>
                    <h3 class="text-right">Total: {{$data[0]->totalAmount}}</h3>
                    <h3 class="text-right">Discount: {{$data[0]->discount}}</h3>
                    <h3 class="text-right">Payable Amount: {{$data[0]->payableAmount}}</h3>
                </div>
            </div>
        </div>
    </div>








@endsection
