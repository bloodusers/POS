function addToTable($id) {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $.ajax({
        url: "/getItem/" + $id,
        type: "get",
        data: {_token: "{{csrf_token()}}"},
        success: function (response) {
            if (response) {
                let obj = response;
                document.getElementById("search").value = "";
                document.getElementById("data").innerHTML = "";
                var table = document.getElementById("invoiceList").getElementsByTagName('tbody')[0];
                var rowCount = table.rows.length;
                console.log(rowCount);
                for (var i = 1; i <= rowCount; i++) {
                    console.log(document.getElementById("invoiceList").rows[i].cells[1].innerHTML);
                    if (document.getElementById("invoiceList").rows[i].cells[1].innerHTML == obj.name) {
                        alert("Item already added");
                        return;
                    }
                }
                var row = $("#SampleDataRow").clone();
                var Sr = $("#ItemTableBody .DataRow").length + 1;
                $(row).find(".Serial").html(Sr);
                $(row).find(".id").html(obj.id);
                $(row).find(".ItemDescription").html(obj.name);
                $(row).find(".Price").html(obj.price);
                $(row).find(".Total").val(obj.price * 1);
                $(row).find(".Qty").val(1);


                $("#ItemTableBody").append(row);
                CalculateInvoiceTotals();
            }
        }
        ,
    });
}

function changeTotal(tag) {
    //CalculateInvoiceTotals();
    let total = parseInt($("#total").val());
    if (total) {
        let val = parseInt($(tag).val());
        if (!val)
            val = 0;
        if (val <= total) {
            total -= val;
            $("#subTotal").val(total);
        }
    }
}

function RemoveItem(tag) {
    $(tag).closest(".DataRow").remove();
    CalculateInvoiceTotals();
    ReCalculateSerialNumbers();
    if ($("#ItemTableBody .DataRow").length < 1) {
        $("#ItemSelection").show();
    }
}

function ChangeQty(tag, operation) {
    var CurrentValue = $(tag).parent().find(".Qty").val();
    if (operation == "Add") {
        $(tag).parent().find(".Qty").val(++CurrentValue);
    }
    if (operation == "Subtract" && CurrentValue > 1) {
        $(tag).parent().find(".Qty").val(--CurrentValue);
    }
    CalculateLineTotal($(tag).parent().find(".Qty"));
}

function CalculateLineTotal(tag) {
    var Qty = $(tag).val();
    var Price = parseFloat($(tag).closest(".DataRow").find(".Price").html());
    $(tag).closest(".DataRow").find(".Total").val(Price * Qty);
    CalculateInvoiceTotals();
}

function CalculateInvoiceTotals() {
    var total = 0;
    $("#ItemTableBody .DataRow").each(function () {
        var totalForItem = $(this).find(".Total").val();
        total += parseFloat(totalForItem);
    });
    document.getElementById("total").value = total;
    document.getElementById("subTotal").value = total;
    changeTotal($('#discount'))
}

function ReCalculateSerialNumbers() {
    var Sr = 1;
    $("#ItemTableBody .DataRow").each(function () {
        $(this).find(".Serial").html(Sr);
        Sr++;
    });
}

function addInvoice($userId) {
    console.log($('#tName').val());
    let token = $('#tName').val();
    var table = document.getElementById("invoiceList").getElementsByTagName('tbody')[0];
    var row = table.rows.length;

    console.log(data);
    for (let i = 1; i <= row; i++) {
        console.log(document.getElementById("invoiceList").rows[i].cells[1].innerHTML);
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/addInvoice",
        type: "post",
        data: {_token: token,  "customerName" :$('#customerName').val(),
            "remarks" : $('#remarks').val() ,
            "totalAmount" : parseInt($('#total').val()) ,
            "totalItems" : parseInt(row) ,
            "discount" : parseInt($('#discount').val()) ,
            "payableAmount" : parseInt($('#subTotal').val()) ,},
        success: function (response) {
            if (response) {
                let id=response;
                $("#ItemTableBody .DataRow").each(function ()
                {
                    /*console.log(($(this).find(".id").text()));
                    console.log(parseInt($(this).find(".Qty").val()));
                    console.log((parseInt($(this).find(".Price").text())));*/
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/addInvoiceItem",
                        type: "post",
                        data: {
                            _token: token, "invoice_id": id,
                            "item_id": ($(this).find(".id").text()),
                            "qty": parseInt($(this).find(".Qty").val()),
                            "price": (parseInt($(this).find(".Price").text())),
                            "returnQty": parseInt(1),
                        },
                        success: function (response) {
                            if (response) {
                                console.log('done');
                                console.log(response);
                                location.reload(true);
                            }
                        }
                        ,
                    });
                })
            }
        }
        ,
    });
}

/*
var data = '[' +
    '{"customerName":"' + $('#customerName').val() + '"}' +
    '{"remarks":"' + $('#remarks').val() + '"}' +
    '{"total":"' + $('#total').val() + '"}' +
    '{"totalItems":"' + row + '"}' +
    '{"discount":"' + $('#discount').val() + '"}' +
    '{"payableAmount":"' + $('#subTotal').val() + '"}' +
    ']';*/

/*
var data = {
        "customerName" :$('#customerName').val(),
    "remarks" : $('#remarks').val() ,
    "total" : $('#total').val() ,
    "totalItems" : row ,
    "discount" : $('#discount').val() ,
    "payableAmount" : $('#subTotal').val() ,
    };
*/
