@extends('layouts.theme')

@section('content')
    <div id="result" class="" hidden>
        <div class="card container-fluid p-500">
            <div class="card-header">
                <h2 class="text-center">Return Invoice </h2>
            </div>
            <h2 id="cName" class="text-center"></h2>
            <div class="card-body">
                <table id="invoiceList" class="table container-fluid p-500">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sr.</th>
                        <th scope="col">ID</th>
                        <th scope="col">Item</th>
                        <th scope="col" class="text-left">Return Qty</th>
                        <th scope="col" class="text-left">Qty</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Total</th>
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
                                        onclick="ChangeRQty(this,'Subtract');">
                                    -
                                </button>
                                <input type="text" class="Qty form-control" size="1"
                                       onchange="CalculateLineTotal(this);" value="0" readonly/>
                                <button class="btn btn-outline-success" title="Add Qty"
                                        onclick="ChangeRQty(this,'Add');">+
                                </button>
                            </div>
                        </td>
                        <td class="tQty text-center"></td>
                        <td class="Price text-center"></td>
                        <td class="text-center">
                            <input type="number" size="1" min="1" class="Total form-control" readonly/>
                        </td>
                    </tr>
                </table>
                <!--total/discount/cName/remarks-->
                <hr>
                <form id="tForm" action="">
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
                            <input id="discount" readonly type="text"
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
                    <div class="form-group row mb-0 justify-content-center">
                        <div class="col-md-0 offset-md-0 ">
                            <form>
                                @csrf
                                <button type="button" class="btn btn-primary justify-content-end"
                                        onclick="createReturn(this)">
                                    Create
                                    Return
                                </button>
                            </form>
                        </div>
                    </div>
                    <input type='hidden' name='tName' id='tName' value='{{csrf_token()}}'>
                    <input type='hidden' name='invId' id='invId' value=''>
                    {{--        <input type='hidden' name='tHash' id='tHash' value='{{csrf_token()}}'>--}}
                </form>
            </div>
        </div>
    </div>
    <!--to get id-->
    <div id="search" class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Enter Invoice Id</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="IID"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Invoice id') }}</label>

                                <div class="col-md-6 ">
                                    <input id="IID" type="number"
                                           class="form-control @error('number') is-invalid @enderror"
                                           name="invoice_id" value="{{ old('invoice_id') }}" required
                                           autocomplete="invoice_id" autofocus>

                                    @error('invoice_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <p id="noResult" class="text-danger font-weight-bold"></p>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary"
                                            onclick="searchInvoice(this)">
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script type="text/javascript">
    function searchInvoice(tag) {
        let id = $('#IID').val();
        if (id) {
            tag.innerText = 'searching';
            tag.disabled = true;
            $.ajax({
                url: "/invoice/" + id + '/find',
                type: "get",
                data: {},
                success: function (response) {
                    if (response) {
                        document.getElementById('result').hidden = false;
                        $('#result').animate({opacity: 0.0}, 0.0);
                        // $('#result').slideUp(0.0);
                        let obj = response;
                        document.getElementById('invId').value = obj.id;
                        $('#search').hide();
                        document.getElementById('cName').innerText = "Customer Name: " + obj.customerName;
                        $.ajax({
                            url: "/invoiceItems/" + obj.id,
                            type: "get",
                            data: {},
                            async: false,
                            success: function (response) {
                                for (let i = 0; i < response.length; i++) {
                                    insertToReturnTable(response[i]);
                                }
                            }
                        });
                        document.getElementById('discount').value = parseFloat((obj.discount / obj.totalAmount) * 100) + "%";
                        //$('#result').slideToggle(500);
                        // $('#result').fadeIn(1000);
                        $('#result').animate({opacity: 1.0}, 1000);
                    } else {
                        document.getElementById("noResult").innerHTML = "❌ No result Found against id " + id;
                        tag.innerText = 'Search';
                        tag.disabled = false;
                    }
                }
            });
        }
    }

    function insertToReturnTable(obj) {
        //console.log('obj: ' + obj.id + ' ' + obj.name + ' ' + obj.qty);
        var row = $("#SampleDataRow").clone();
        var Sr = $("#ItemTableBody .DataRow").length + 1;
        $(row).find(".Serial").html(Sr);
        $(row).find(".id").html(obj.id);
        $(row).find(".ItemDescription").html(obj.name);
        $(row).find(".Price").html(obj.price);
        $(row).find(".Total").val(0);
        $(row).find(".Qty").val(0);
        $(row).find(".tQty").html(obj.qty);
        if (obj.qty)
            $("#ItemTableBody").append(row);
    }

    function ChangeRQty(tag, operation) {
        var CurrentValue = $(tag).parent().find(".Qty").val();
        if (operation == "Add") {
            console.log();
            if (CurrentValue < parseInt($(tag).closest(".DataRow").find(".tQty").html())) {
                $(tag).parent().find(".Qty").val(++CurrentValue);
            }
        }
        if (operation == "Subtract" && CurrentValue >= 1) {
            $(tag).parent().find(".Qty").val(--CurrentValue);
        }
        $(tag).parent().find(".Total");
        CalculateRLineTotal($(tag).parent().find(".Qty"));
    }

    function CalculateRLineTotal(tag) {
        var Qty = $(tag).val();
        var Price = parseFloat($(tag).closest(".DataRow").find(".Price").html());
        $(tag).closest(".DataRow").find(".Total").val(Price * Qty);
        CalculateReturnTotals();
    }

    function CalculateReturnTotals() {
        var total = 0;
        $("#ItemTableBody .DataRow").each(function () {
            var totalForItem = $(this).find(".Total").val();
            total += parseFloat(totalForItem);
        });
        let disc = parseFloat(document.getElementById('discount').value);
        document.getElementById("total").value = total;
        document.getElementById("subTotal").value = parseInt(total - (total * (disc / 100)));

    }

    function createReturn(tag) {
        if (!parseInt(document.getElementById('total').value)) {
            return;
        }
        let token = getCSRF();
        //console.log(token);

        var table = document.getElementById("invoiceList").getElementsByTagName('tbody')[0];
        var row = table.rows.length;
        tag.disabled = true;
        tag.innerText = "Creating return";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/returnInvoice",
            type: "post",
            data: {
                _token: token, "invoice_id": $('#invId').val(),
                "remarks": $('#remarks').val(),
                "totalAmount": parseInt($('#total').val()),
                "discount": parseInt(parseInt($('#total').val()) - parseInt($('#subTotal').val())),
                "payableAmount": parseInt($('#subTotal').val()),
            },
            success: function (response) {
                if (response) {
                    console.log(response);
                    let id = response;
                    $("#ItemTableBody .DataRow").each(function () {
                        if (parseInt($(this).find(".Qty").val())) {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "/returnInvoiceItems",
                                type: "post",
                                data: {
                                    _token: token, "invoice_id": id,
                                    "item_id": ($(this).find(".id").text()),
                                    "qty": parseInt($(this).find(".Qty").val()),
                                },
                                success: function (response) {
                                    if (response) {
                                        //
                                    }
                                }
                                ,
                            });
                        }
                    })
                    // window.location.replace("/invoice/" + id + "/receipt");
                    window.location.reload();
                }
            }
            ,
        });
    }
</script>
<script src="js/invoiceAjax.js"></script>

