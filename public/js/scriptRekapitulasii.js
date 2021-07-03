const printByFormRow = document.querySelector(".printBy");
const startPartNo = document.querySelector("#startPartNo");
const endPartNo = document.querySelector("#endPartNo");
const tBodyItem = document.querySelector("#tBodyItem");
const tBodyItem2 = document.querySelector("#tBodyItem2");
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const startWithSJNo = document.querySelector("#startWithSJNo");
const endWithSJNo = document.querySelector("#endWithSJNo");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const tBodySJ = document.querySelector("#tBodySJ");
const tBodySJ2 = document.querySelector("#tBodySJ2");
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
            $("#startPartNo").prop("disabled", false);
            $("#endPartNo").prop("disabled", false);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSJNo").prop("disabled", true);
            $("#endWithSJNo").prop("disabled", true);
        }
    }
    if (e.target.id == "date") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startPartNo").prop("disabled", true);
            $("#endPartNo").prop("disabled", true);
            $("#startWithDate").prop("disabled", false);
            $("#endWithDate").prop("disabled", false);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSJNo").prop("disabled", true);
            $("#endWithSJNo").prop("disabled", true);
        }
    }
    if (e.target.id == "customer") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startPartNo").prop("disabled", true);
            $("#endPartNo").prop("disabled", true);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", false);
            $("#endWithCustomer").prop("disabled", false);
            $("#startWithSJNo").prop("disabled", true);
            $("#endWithSJNo").prop("disabled", true);
        }
    }
    if (e.target.id == "number") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startPartNo").prop("disabled", true);
            $("#endPartNo").prop("disabled", true);
            $("#startWithDate").prop("disabled", true);
            $("#endWithDate").prop("disabled", true);
            $("#startWithCustomer").prop("disabled", true);
            $("#endWithCustomer").prop("disabled", true);
            $("#startWithSJNo").prop("disabled", false);
            $("#endWithSJNo").prop("disabled", false);
        }
    }
    if (e.target.id == "combination") {
        if (e.target.checked) {
            console.log(e.target);
            $("#startPartNo").prop("disabled", false);
            $("#endPartNo").prop("disabled", false);
            $("#startWithDate").prop("disabled", false);
            $("#endWithDate").prop("disabled", false);
            $("#startWithCustomer").prop("disabled", false);
            $("#endWithCustomer").prop("disabled", false);
            $("#startWithSJNo").prop("disabled", false);
            $("#endWithSJNo").prop("disabled", false);
        }
    }
});

startPartNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal1").modal("show");
        ajaxSetup;
        $.post("rekapitulasi_i/getPartNo", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-part="${dat.PART_NO}" data-isi="${dat.PART_NO}">
              <td>${dat.PART_NO}</td>
              <td>${dat.ITEMCODE}</td>
              <td>${dat.DESCRIPT}</td>
              <td>${dat.DESCRIPT1}</td>
              <td>${dat.UNIT}</td>
              <td>${dat.LOT_QTY}</td>
            </tr>
          `;
                })
                .join("");
            tBodyItem.innerHTML = data;
        });
    }
});

endPartNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
        ajaxSetup;
        $.post("rekapitulasi_i/getPartNo", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-part="${dat.PART_NO}" data-isi="${dat.PART_NO}">
              <td>${dat.PART_NO}</td>
              <td>${dat.ITEMCODE}</td>
              <td>${dat.DESCRIPT}</td>
              <td>${dat.DESCRIPT1}</td>
              <td>${dat.UNIT}</td>
              <td>${dat.LOT_QTY}</td>
            </tr>
          `;
                })
                .join("");
            tBodyItem2.innerHTML = data;
        });
    }
});

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal3").modal("show");
    ajaxSetup;
    $.post("rekapitulasi_i/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-custcode="${dat.custcode}" data-isi="${dat.custcode}">
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
    $.post("rekapitulasi_i/getCustomer", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-custcode="${dat.custcode}" data-isi="${dat.custcode}">
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

startWithSJNo.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal5").modal("show");
    ajaxSetup;
    $.post("rekapitulasi_i/getSJ", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-do="${dat.do_no}" data-isi="${dat.do_no}">
                    <td>${dat.do_no}</td>
                    <td>${dat.ref_no}</td>
                    <td>${dat.written}</td>
                    <td>${dat.po_no}</td>
                    <td>${dat.dn_no}</td>
                    <td>${dat.cust_name}</td>
                </tr>
            `;
            })
            .join("");
        tBodySJ.innerHTML = data;
    });
});

endWithSJNo.onkeyup = function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal6").modal("show");
    ajaxSetup;
    $.post("rekapitulasi_i/getSJ", function (datas) {
        let data = datas
            .map((dat, i) => {
                return /*html*/ `
                <tr class="invoice" data-id="${dat.id}" data-do="${dat.do_no}"
                    data-isi="${dat.do_no}">
                    <td>${dat.do_no}</td>
                    <td>${dat.ref_no}</td>
                    <td>${dat.written}</td>
                    <td>${dat.po_no}</td>
                    <td>${dat.dn_no}</td>
                    <td>${dat.cust_name}</td>
                </tr>
            `;
            })
            .join("");
        tBodySJ2.innerHTML = data;
    });
};

const hideModal = function (e, modal, inputNode) {
    if (!e.target.parentElement) return;
    $(modal).modal("hide");
    const data = e.target.parentElement.dataset.isi;
    inputNode.value = data;
};

tBodyItem.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal1",startPartNo);
});

tBodyItem2.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal2", endPartNo);
});

tBodyCustomer.onclick = function (e) {
    hideModal(e, "#exampleModal3", startWithCustomer);
};

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "#exampleModal4", endWithCustomer);
};

tBodySJ.onclick = function (e) {
    hideModal(e, "#exampleModal5", startWithSJNo);
};

tBodySJ2.onclick = function (e) {
    hideModal(e, "#exampleModal6", endWithSJNo);
};
