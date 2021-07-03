const printByFormRow = document.querySelector(".printBy");
const startWithItemCode = document.querySelector("#startWithItemCode");
const endWithItemCode = document.querySelector("#endWithItemCode");
const tBodyInvoice = document.querySelector("#tBodyInvoice");
const tBodyInvoice2 = document.querySelector("#tBodyInvoice2");
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

printByFormRow.addEventListener("click", function (e) {
    if (e.target.id == "item") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startWithItemCode").prop("disabled", false);
            $("#endWithItemCode").prop("disabled", false);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSales").prop("disabled", true);
            $("#endWithSales").prop("disabled", true);
        }
    }
    if (e.target.id == "date") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startWithItemCode").prop("disabled", true);
            $("#endWithItemCode").prop("disabled", true);
            $("#startWithDate").prop("disabled", false);
            $("#endWithDate").prop("disabled", false);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSales").prop("disabled", true);
            $("#endWithSales").prop("disabled", true);
        }
    }
    if (e.target.id == "customer") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startWithItemCode").prop("disabled", true);
            $("#endWithItemCode").prop("disabled", true);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", false);
            $("#endWithCustomer").prop("disabled", false);
            $("#startWithSales").prop("disabled", true);
            $("#endWithSales").prop("disabled", true);
        }
    }
    if (e.target.id == "sales") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startWithItemCode").prop("disabled", true);
            $("#endWithItemCode").prop("disabled", true);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSales").prop("disabled", false);
            $("#endWithSales").prop("disabled", false);
        }
    }
    if (e.target.id == "combination") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startWithItemCode").prop("disabled", false);
            $("#endWithItemCode").prop("disabled", false);
            $("#startWithDate").prop("disabled", false);
            $("#endWithDate").prop("disabled", false);
            $("#startWithCustomer").prop("disabled", false);
            $("#endWithCustomer").prop("disabled", false);
            $("#startWithSales").prop("disabled", false);
            $("#endWithSales").prop("disabled", false);
        }
    }
});

startWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal1").modal("show");
        ajaxSetup;
        $.post("list_item_standart/getItem", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowItem" data-item="${dat.ITEMCODE}">
              <td>${dat.ITEMCODE}</td>
              <td>${dat.PART_NO}</td>
              <td>${dat.DESCRIPT}</td>
              <td>${dat.DESCRIPT1}</td>
              <td>${dat.UNIT}</td>
              <td>${dat.LOT_QTY}</td>
            </tr>
          `;
                })
                .join("");
            tBodyInvoice.innerHTML = data;
        });
    }
});

endWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
        ajaxSetup;
        $.post("list_item_standart/getItem", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowItem" data-item="${dat.ITEMCODE}">
              <td>${dat.ITEMCODE}</td>
              <td>${dat.PART_NO}</td>
              <td>${dat.DESCRIPT}</td>
              <td>${dat.DESCRIPT1}</td>
              <td>${dat.UNIT}</td>
              <td>${dat.LOT_QTY}</td>
            </tr>
          `;
                })
                .join("");
            tBodyInvoice2.innerHTML = data;
        });
    }
});

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal3").modal("show");
    ajaxSetup;
    $.post("list_item_standart/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-custcode="${dat.custcode}">
                    <td width="10%">${i}</td>
                    <td width="15%" class="tdCustcode">${dat.custcode}</td>
                    <td width="45%">${dat.company}</td>
                    <td width="30%">${dat.contact}</td>
                </tr>
            `;
            })
            .join("");
        tBodyCustomer.innerHTML = data;
    });
});

endWithCustomer.onkeyup = function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal4").modal("show");
    ajaxSetup;
    $.post("list_item_standart/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-custcode="${dat.custcode}">
                    <td width="10%">${i}</td>
                    <td width="15%" class="tdCustcode">${dat.custcode}</td>
                    <td width="45%">${dat.company}</td>
                    <td width="30%">${dat.contact}</td>
                </tr>
            `;
            })
            .join("");
        tBodyCustomer2.innerHTML = data;
    });
};

tBodyInvoice.addEventListener("click", function (e) {
    console.log(e.target);
    if (e.target.parentElement) {
        $("#exampleModal1").modal("hide");
        const dataItem = e.target.parentElement.dataset.item;
        startWithItemCode.value = dataItem;
    }
});

tBodyInvoice2.addEventListener("click", function (e) {
    console.log(e.target);
    if (e.target.parentElement) {
        $("#exampleModal2").modal("hide");
        const dataItem = e.target.parentElement.dataset.item;
        endWithItemCode.value = dataItem;
    }
});

tBodyCustomer.onclick = function (e) {
    if (!e.target.parentElement) return;
    $("#exampleModal3").modal("hide");
    const dataCustcode = e.target.parentElement.dataset.custcode;
    startWithCustomer.value = dataCustcode;
};

tBodyCustomer2.onclick = function (e) {
    if (!e.target.parentElement) return;
    $("#exampleModal4").modal("hide");
    const dataCustcode = e.target.parentElement.dataset.custcode;
    endWithCustomer.value = dataCustcode;
};
