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
                console.log(document.getElementById("search"));

                var table = document.getElementById("invoiceList").getElementsByTagName('tbody')[0];
                var rowCount = table.rows.length;
                console.log(rowCount);
                for (var i = 1; i <=rowCount; i++) {
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
                //$("#ItemSelection").hide();
                //GetItemPriceAgainstCustomerType(itemId);
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
    if ($("#ItemTableBody .DataRow").length <1) {
        $("#ItemSelection").show();
    }
}

function ChangeQty(tag, operation) {

    var CurrentValue = $(tag).parent().find(".Qty").val();

    if (operation == "Add") {
        $(tag).parent().find(".Qty").val(parseInt(CurrentValue) + 1);
    }
    if (operation == "Subtract") {
        if (CurrentValue <= 1) {
            // do nothing
        } else {
            $(tag).parent().find(".Qty").val(parseInt(CurrentValue) - 1);
        }

    }

    CalculateLineTotal($(tag).parent().find(".Qty"));
}

function CalculateLineTotal(tag) {
    var Qty = $(tag).val();
    var Price = parseFloat($(tag).closest(".DataRow").find(".Price").html());
    var LineTotal = Price * Qty;

    $(tag).closest(".DataRow").find(".Total").val(LineTotal);

    //CalculateInvoiceTotals();
}

function CalculateInvoiceTotals() {
    var ItemsTotal = 0;
    $("#invoiceList .DataRow").each(function () {
        var Price = $(this).find(".Price").html();
        var Qty = $(this).find(".Qty").val();
        var LineTotal = Price * Qty;
        $(this).find(".Total").val(LineTotal);

        ItemsTotal += parseFloat(LineTotal);
    });
    var Discount = parseInt($("#InvoiceDiscount").val());

    if (Discount > ItemsTotal || isNaN(Discount)) {
        Discount = 0;
        $("#InvoiceDiscount").val(0);
    }

    $("#InvoiceTotalBeforeDiscount").val(ItemsTotal);
    $("#InvoicePayable").val(ItemsTotal - Discount);

    var CashReceived = parseInt($("#CashReceived").val());

    if (CashReceived > 0) {
        var BalanceAmount = 0;
        if (CashReceived > $("#InvoicePayable").val()) {
            BalanceAmount = CashReceived - parseInt($("#InvoicePayable").val());
        }
        $("#BalanceAmount").val(BalanceAmount);
    }
}









/*var row = table.insertRow(rowCount);
row.insertCell().innerHTML = "<td class=\"Serial\">" + obj.id + "</td>"
row.insertCell().innerHTML = obj.name;
row.insertCell().innerHTML =
    "                                <button class=\"qty-button\" title=\"Deduct Qty\" onclick=\"ChangeQty(this,'Subtract');\">-</button>" +
    "                                <input type=\"text\" class=\"Qty form-control\" onchange=\"CalculateLineTotal(this);\" value=\"1\" readonly />" +
    "                                <button class=\"qty-button\" title=\"Add Qty\" onclick=\"ChangeQty(this,'Add');\">+</button>";
row.insertCell().innerHTML = "<td id='Price' class=\"Price text-center\">" + obj.price + "</td>";
row.insertCell().innerHTML = " <input type=\"number\" min=\"1\" class=\"Total form-control\" readonly value=\"" + obj.price + "\" />";
row.insertCell().innerHTML = "NA";*/
