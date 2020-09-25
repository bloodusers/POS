@extends('layouts.theme')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <form>
        <input id="search" type="text" size="130" style="">
        <div id="data" style="border-radius: 1px;border-color: #1d643b"></div>
    </form>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6>Create Invoice </h6>
                    <table id="invoiceList" class="table table-condensed table-responsive">
                        <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Item</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Remove</th>
                        </tr>
                        </thead>

                        <tbody id="ItemTableBody">
                        </tbody>
                    </table>

                    <table style="display:none;">

                        <tr class="DataRow" id="SampleDataRow">
                            <td class="Serial"></td>
                            <td class="ItemDescription"></td>
                            <!--Quantity-->
                            <td class="text-center w-set vertical_align : top">
                                <div class="form-inline" >
                                    <button class="qty-button" title="Deduct Qty" onclick="ChangeQty(this,'Subtract');">
                                        -
                                    </button>
                                    <input type="text" class="Qty form-control" size="1"
                                           onchange="CalculateLineTotal(this);" value="1" readonly/>
                                    <button class="qty-button" title="Add Qty" onclick="ChangeQty(this,'Add');">+
                                    </button>
                                </div>
                            </td>

                            <td class="Price text-center"></td>
                            <td class="text-center">
                                <input type="number" size="1" min="1" class="Total form-control" readonly/>
                            </td>
                            <td class="Rem hidden-print text-right">
                                <span class="fa fa-close red pointer" style="font-size:30px;color:red" title="Remove Item" onclick="RemoveItem(this);"></span>
                            </td>
                        </tr>
                    </table>
                    <!--new-->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#search').on('keyup', function () {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{URL::to('search')}}',
                data: {'search': $value},
                success: function (data) {
                    //$('#data').html(data);
                    if ($value) {
                        document.getElementById("data").innerHTML = data;
                        //document.getElementById("data").style.border = "1px solid #A5ACB2";
                        document.getElementById("data").style.border = "1px solid rgb(255 255 255)";
                        document.getElementById("data").style.borderRadius = "50px";
                        document.getElementById("data").style.borderLeftWidth = "100px";
                        document.getElementById("data").style.borderRightWidth = "100px";
                        document.getElementById("data").style.backgroundColor = "rgb(189 187 181 / 32%)";

                    } else {
                        document.getElementById("data").innerHTML = '';
                        //document.getElementById("data").style.border = "";
                    }

                }
            });
        })
        /*function addToTable($id) {
            console.log($id);
            document.getElementById($id).innerHTML =$id => name;
        }*/
    </script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>


    <script src="js/invoiceAjax.js"></script>
@endsection
