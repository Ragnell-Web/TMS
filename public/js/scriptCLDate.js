const startWithCustomer = document.querySelector("#startWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal1").modal("show");
    ajaxSetup;
    $.post("ags_last_payment/getCustomer", function (datas) {
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

endWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return false;
    $("#exampleModal2").modal("show");
    ajaxSetup;
    $.post("ags_last_payment/getCustomer", function (datas) {
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
});

tBodyCustomer.onclick = function (e) {
    if (!e.target.parentElement) return;
    $("#exampleModal1").modal("hide");
    const dataCustcode = e.target.parentElement.dataset.custcode;
    startWithCustomer.value = dataCustcode;
};

tBodyCustomer2.onclick = function (e) {
    if (!e.target.parentElement) return;
    $("#exampleModal2").modal("hide");
    const dataCustcode = e.target.parentElement.dataset.custcode;
    endWithCustomer.value = dataCustcode;
};

