@extends('layouts.theme')
@section('content')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card">

        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
            </div>
            <input id="search" list="sList" onkeyup="fillData(this)" onchange="fillData(this)" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div id="data" style="border-radius: 1px;border-color: #21252900"></div>
        <div class="card-header">
            <h2 class="text-center">Create Invoice </h2>
        </div>
        <div class="card-body">
            <table id="invoiceList" class="table container-fluid p-500">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">ID</th>
                    <th scope="col">Item</th>
                    <th scope="col" class="text-center">Qty</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col" class="text-center">Total</th>
                    <th scope="col" class="text-center">Remove</th>
                </tr>
                </thead>

                <tbody id="ItemTableBody">
                </tbody>
            </table>

            <table style="display:none;">
                <tr class="DataRow" id="SampleDataRow">
                    <td class="Serial"></td>
                    <td class="id"></td>
                    <td class="ItemDescription"></td>
                    <!--Quantity-->
                    <td class="text-center w-set vertical_align : top">
                        <div class="form-inline">
                            <button class="btn btn-outline-danger" title="Deduct Qty"
                                    onclick="ChangeQty(this,'Subtract');">
                                -
                            </button>
                            <input type="text" class="Qty form-control" size="1"
                                   onchange="CalculateLineTotal(this);" value="1" readonly/>
                            <button class="btn btn-outline-success" title="Add Qty" onclick="ChangeQty(this,'Add');">+
                            </button>
                        </div>
                    </td>
                    <td class="Price text-center"></td>
                    <td class="text-center">
                        <input type="number" size="1" min="1" class="Total form-control" readonly/>
                    </td>
                    <td class="Rem hidden-print text-right">
                                <span class="fa fa-close red pointer" style="font-size:30px;color:red"
                                      title="Remove Item" onclick="RemoveItem(this);"></span>
                    </td>
                </tr>
            </table>
            <!--new-->

            <!--total/discount/cName/remarks-->
            <form action="">
                <div class="form-group row" size="5">
                    <label for="total"
                           class="col-md-4 col-form-label text-md-right">{{ __('Total') }}</label>

                    <div class="col-md-6">
                        <input id="total" type="text"
                               class="form-control @error('total') is-invalid @enderror" name="total"
                               required autocomplete="name" autofocus min="1" readonly>

                        @error('total')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="discount"
                           class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>

                    <div class="col-md-6">
                        <input id="discount" type="number"
                               class="form-control @error('discount') is-invalid @enderror" name="discount"
                               value="{{ old('discount') }}" required autocomplete="discount" autofocus min="0"
                               onchange="changeTotal(this)" onkeyup="changeTotal(this)" placeholder="0">

                        @error('discount')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row" size="5">
                    <label for="total"
                           class="col-md-4 col-form-label text-md-right">{{ __('sub Total') }}</label>

                    <div class="col-md-6">
                        <input id="subTotal" type="text"
                               class="form-control @error('total') is-invalid @enderror" name="total"
                               required autocomplete="name" autofocus min="1" readonly>

                        @error('total')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customerName"
                           class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>

                    <div class="col-md-6">
                        <input id="customerName" type="text"
                               class="form-control @error('customerName') is-invalid @enderror" name="customerName"
                               value="{{ old('customerName') }}" required autocomplete="customerName" autofocus min="1">

                        @error('customerName')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="remarks"
                           class="col-md-4 col-form-label text-md-right">{{ __('Remarks') }}</label>

                    <div class="col-md-6">
                        <input id="remarks" type="text"
                               class="form-control @error('remarks') is-invalid @enderror" name="remarks"
                               value="{{ old('remarks') }}" autocomplete="remarks" autofocus min="1">

                        @error('remarks')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <form>
                    @csrf
                    <button type="button" class="btn btn-primary justify-content-end" onclick="addInvoice(this)">Create
                        Invoice
                    </button>
                </form>
                <input type='hidden' name='tName' id='tName' value='{{csrf_token()}}'>
                <input type='hidden' name='tHash' id='tHash' value='{{csrf_token()}}'>
            </form>
        </div>
        <!--total/discount/cName/remarks-->
    </div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<link href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel ="Stylesheet">
<script type="text/javascript">
    function fillData(tag)
    {
        $value = $(tag).val();
        $.ajax({
            type: 'get',
            url: '{{URL::to('search')}}',
            data: {'search': $value},
            success: function (data) {
                console.log(data);
                if ($value) {
                    document.getElementById("data").innerHTML = data;
                    document.getElementById("data").style.border = "1px solid #A5ACB2";
                    document.getElementById("data").style.border = "1px solid rgb(255 255 255)";
                    document.getElementById("data").style.borderRadius = "50px";
                    document.getElementById("data").style.borderLeftWidth = "100px";
                    document.getElementById("data").style.borderRightWidth = "100px";
                    document.getElementById("data").style.backgroundColor = "rgb(189 187 181 / 32%)";

                } else {
                    document.getElementById("data").innerHTML = '';
                }

            }
        });
    }
</script>


<script src="js/invoiceAjax.js"></script>
