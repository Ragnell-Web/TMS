const printByFormRow = document.querySelector(".printBy");
const startInvoiceNo = document.querySelector("#startInvoiceNo");
const endInvoiceNo = document.querySelector("#endInvoiceNo");
const tBodyInvoice = document.querySelector("#tBodyInvoice");
const tBodyInvoice2 = document.querySelector("#tBodyInvoice2");
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector('#tBodyCustomer');
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const printItem = document.querySelector('#printItem');
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

printByFormRow.addEventListener("click", function (e) {
    if (e.target.id == "number") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startInvoiceNo").prop("disabled", false);
            $("#endInvoiceNo").prop("disabled", false);
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
            $("#startInvoiceNo").prop("disabled", true);
            $("#endInvoiceNo").prop("disabled", true);
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
            $("#startInvoiceNo").prop("disabled", true);
            $("#endInvoiceNo").prop("disabled", true);
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
            $("#startInvoiceNo").prop("disabled", true);
            $("#endInvoiceNo").prop("disabled", true);
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
            $("#startInvoiceNo").prop("disabled", false);
            $("#endInvoiceNo").prop("disabled", false);
            $("#startWithDate").prop("disabled", false);
            $("#endWithDate").prop("disabled", false);
            $("#startWithCustomer").prop("disabled", false);
            $("#endWithCustomer").prop("disabled", false);
            $("#startWithSales").prop("disabled", false);
            $("#endWithSales").prop("disabled", false);
        }
    }
});

startInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal1").modal("show");
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
            tBodyInvoice.innerHTML = data;
        });
    }
});

endInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
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
            tBodyInvoice2.innerHTML = data;
        });
    }
});

startWithCustomer.addEventListener('keyup', function (e) {
    if (!e.keyCode == 13) return;
    $('#exampleModal3').modal('show');
    ajaxSetup;
    $.post('list_standart/getCustomer', function (datas) {
        let data = datas.map((dat, i) => {
            return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-isi="${dat.custcode}" data-custcode="${dat.custcode}">
                    <td width="10%">${i}</td>
                    <td width="15%" class="tdCustcode">${dat.custcode}</td>
                    <td width="45%">${dat.company}</td>
                    <td width="30%">${dat.contact}</td>
                </tr>
            `;
        }).join('');
        tBodyCustomer.innerHTML = data;
    })
});

endWithCustomer.onkeyup = function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal4").modal("show");
    ajaxSetup;
    $.post("list_standart/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-isi="${dat.custcode}" data-custcode="${dat.custcode}">
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
 }

const hideModal = (e, modal, element) => {
    if (!e.target.parentElement) return;
    $(modal).modal("hide");
    const data = e.target.parentElement.dataset.isi;
    element.value = data;
}

tBodyInvoice.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal1", startInvoiceNo);
});

tBodyInvoice2.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal2", endInvoiceNo);
});

tBodyCustomer.onclick = function (e) {
    hideModal(e, "#exampleModal3", startWithCustomer);
}

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "#exampleModal4", endWithCustomer);
};
