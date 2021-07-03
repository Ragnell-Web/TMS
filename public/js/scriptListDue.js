const startWithDate = document.querySelector("#startWithDate");
const endWithDate = document.querySelector('#endWithDate');
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
//ajaxSetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
//date
const d = new Date();
const day = d.getDate();
const month = d.getMonth() + 1;
const year = d.getFullYear();

endWithDate.value = `${year}-${month.toString().padStart(2, 0)}-${day}`;

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal1").modal("show");
    ajaxSetup;
    $.post("list_standart/getCustomer", function (datas) {
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
    $("#exampleModal2").modal("show");
    ajaxSetup;
    $.post("list_standart/getCustomer", function (datas) {
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