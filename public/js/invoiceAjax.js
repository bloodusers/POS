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

function ReCalculateSerialNumbers() {
    var Sr = 1;
    $("#ItemTableBody .DataRow").each(function () {
        $(this).find(".Serial").html(Sr);
        Sr++;
    });
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
    document.getElementById("subTotal").value = total;
}
