const printByFormRow = document.querySelector(".printBy");
const startWithItemCode = document.querySelector("#startWithItemCode");
const endWithItemCode = document.querySelector("#endWithItemCode");
const tBodyItem = document.querySelector("#tBodyItem");
const tBodyItem2 = document.querySelector("#tBodyItem2");
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const reportTitle = document.querySelector("#reportTitle");
const printItem = document.querySelector("#printItem");
const disabledInput = function (...opsis) {
    $("#startWithItemCode").prop("disabled", opsis[0]);
    $("#endInvoiceNo").prop("disabled", opsis[1]);
    $("#startWithDate").prop("disabled", opsis[2]);
    $("#endWithDate").prop("disabled", opsis[3]);
    $("#startWithCustomer").prop("disabled", opsis[4]);
    $("#endWithCustomer").prop("disabled", opsis[5]);
    $("#startWithSales").prop("disabled", opsis[6]);
    $("#endWithSales").prop("disabled", opsis[7]);
};
const showModalItem = function (modal, element) {
    $(`#${modal}`).modal("show");
    ajaxSetup;
    $.post("list_item_standart/getItem", function (datas) {
        let data = datas
            .map((dat) => {
                return /*html*/ `
            <tr class="tableRowItem" data-isi="${dat.ITEMCODE}" data-item="${dat.ITEMCODE}">
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
        element.innerHTML = data;
    });
};
const showModalCustomer = function (modal, element) {
    $(`#${modal}`).modal("show");
    ajaxSetup;
    $.post("list_item_standart/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-isi="${
                    dat.custcode
                }" data-custcode="${dat.custcode}">
                    <td width="10%">${i + 1}</td>
                    <td width="15%" class="tdCustcode">${dat.custcode}</td>
                    <td width="45%">${dat.company}</td>
                    <td width="30%">${dat.contact}</td>
                </tr>
            `;
            })
            .join("");
        element.innerHTML = data;
    });
};
const hideModal = function (e, modal, element) {
    if (!e.target.parentElement) return;
    $(`#${modal}`).modal("hide");
    const data = e.target.parentElement.dataset.isi;
    element.value = data;
};
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

printByFormRow.addEventListener("click", function (e) {
    if (e.target.id == "item") {
        if (e.target.checked) {
            disabledInput(false, false, true, true, true, true, true, true);
        }
    }
    if (e.target.id == "date") {
        if (e.target.checked) {
            disabledInput(true, true, false, false, true, true, true, true);
        }
    }
    if (e.target.id == "customer") {
        if (e.target.checked) {
            disabledInput(true, true, true, true, false, false, true, true);
        }
    }
    if (e.target.id == "sales") {
        if (e.target.checked) {
            disabledInput(true, true, true, true, true, true, false, false);
        }
    }
    if (e.target.id == "combination") {
        if (e.target.checked) {
            disabledInput(
                false,
                false,
                false,
                false,
                false,
                false,
                false,
                false
            );
        }
    }
});

startWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        showModalItem("exampleModal1", tBodyItem);
    }
});

endWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        showModalItem("exampleModal2", tBodyItem2);
    }
});

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    showModalCustomer("exampleModal3", tBodyCustomer);
});

endWithCustomer.onkeyup = function (e) {
    if (!e.keyCode == 13) return;
    showModalCustomer("exampleModal4", tBodyCustomer2);
};

tBodyItem.addEventListener("click", function (e) {
    hideModal(e, "exampleModal1", startWithItemCode);
});

tBodyItem2.addEventListener("click", function (e) {
    hideModal(e, "exampleModal2", endWithItemCode);
});

tBodyCustomer.onclick = function (e) {
    hideModal(e, "exampleModal3", startWithCustomer);
};

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "exampleModal4", endWithCustomer);
};

printItem.onclick = function (e) {
    ajaxSetup;
    $.post(
        "list_item_standart/print",
        { reportTitle: reportTitle.value },
        function (data) {
            const w = window.open('about#blank');
            w.document.open();
            w.document.write(data);
            w.document.close();
        }
    );
};
