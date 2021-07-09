const printByFormRow = document.querySelector(".printBy");
const startInvoiceNo = document.querySelector("#startInvoiceNo");
const endInvoiceNo = document.querySelector("#endInvoiceNo");
const tBodyInvoice = document.querySelector("#tBodyInvoice");
const tBodyInvoice2 = document.querySelector("#tBodyInvoice2");
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const startWithDate = document.querySelector("#startWithDate");
const endWithDate = document.querySelector("#endWithDate");
const printItem = document.querySelector("#printItem");
const reportTitle = document.querySelector("#reportTitle");
const disabledInput = function (...opsis) {
    $("#startInvoiceNo").prop("disabled", opsis[0]);
    $("#endInvoiceNo").prop("disabled", opsis[1]);
    $("#startWithDate").prop("disabled", opsis[2]);
    $("#endWithDate").prop("disabled", opsis[3]);
    $("#startWithCustomer").prop("disabled", opsis[4]);
    $("#endWithCustomer").prop("disabled", opsis[5]);
    $("#startWithSales").prop("disabled", opsis[6]);
    $("#endWithSales").prop("disabled", opsis[7]);
};
const showModalInvoice = function (modal, element) {
    $(`#${modal}`).modal("show");
    ajaxSetup;
    $.post("list_standart/getInvoice", function (datas) {
        let data = datas
            .map((dat) => {
                return /*html*/ `
            <tr class="tableRowInvoice" data-isi="${dat.invoice}" data-invoice="${dat.invoice}">
              <td>${dat.invoice}</td>
              <td>${dat.tax_no}</td>
              <td>${dat.ref_no}</td>
              <td>${dat.remark}</td>
              <td>${dat.written}</td>
              <td>${dat.company}</td>
              <td>${dat.custcode}</td>
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
    $.post("list_standart/getCustomer", function (datas) {
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
    $(modal).modal("hide");
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
    if (e.target.id == "number") {
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

startInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        showModalInvoice("exampleModal1", tBodyInvoice);
    }
});

endInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        showModalInvoice("exampleModal2", tBodyInvoice2);
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

tBodyInvoice.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal1", startInvoiceNo);
});

tBodyInvoice2.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal2", endInvoiceNo);
});

tBodyCustomer.onclick = function (e) {
    hideModal(e, "#exampleModal3", startWithCustomer);
};

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "#exampleModal4", endWithCustomer);
};

printItem.onclick = function (e) {
    ajaxSetup;
    if (
        startInvoiceNo.disabled == false &&
        endInvoiceNo.disabled == false &&
        startWithDate.disabled == false &&
        endWithDate.disabled == false &&
        startWithCustomer.disabled == false &&
        endWithCustomer.disabled == false
    ) {
        $.post(
            "list_standart/print",
            {
                reportTitle: reportTitle.value,
                invoice1: startInvoiceNo.value,
                invoice2: endInvoiceNo.value,
                written1: startWithDate.value,
                written2: endWithDate.value,
                custcode1: startWithCustomer.value,
                custcode2: endWithCustomer.value,
            },
            function (datas) {
                const w = window.open("about:blank");
                w.document.open();
                w.document.write(datas);
                w.document.close();
            }
        );
    } else if (
        startInvoiceNo.disabled == false &&
        endInvoiceNo.disabled == false
    ) {
        $.post(
            "list_standart/print",
            {
                reportTitle: reportTitle.value,
                invoice1: startInvoiceNo.value,
                invoice2: endInvoiceNo.value,
            },
            function (datas) {
                const w = window.open("about:blank");
                w.document.open();
                w.document.write(datas);
                w.document.close();
            }
        );
    } else if (
        startWithDate.disabled == false &&
        endWithDate.disabled == false
    ) {
        $.post(
            "list_standart/print",
            {
                reportTitle: reportTitle.value,
                written1: startWithDate.value,
                written2: endWithDate.value,
            },
            function (datas) {
                const w = window.open("about:blank");
                w.document.open();
                w.document.write(datas);
                w.document.close();
            }
        );
    } else if (
        startWithCustomer.disabled == false &&
        endWithCustomer.disabled == false
    ) {
        $.post(
            "list_standart/print",
            {
                reportTitle: reportTitle.value,
                custcode1: startWithCustomer.value,
                custcode2: endWithCustomer.value,
            },
            function (datas) {
                const w = window.open("about:blank");
                w.document.open();
                w.document.write(datas);
                w.document.close();
            }
        );
    }
};
