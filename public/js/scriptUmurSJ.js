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

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal1").modal("show");
    ajaxSetup;
    $.post("umur_sj/getCustomer", function (datas) {
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
    $("#exampleModal2").modal("show");
    ajaxSetup;
    $.post("umur_sj/getCustomer", function (datas) {
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

const hideModal = function (e, modal, inputNode) {
    if (!e.target.parentElement) return;
    $(modal).modal("hide");
    const data = e.target.parentElement.dataset.isi;
    inputNode.value = data;
};

tBodyCustomer.onclick = function (e) {
    hideModal(e, "#exampleModal1", startWithCustomer);
};

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "#exampleModal2", endWithCustomer);
};
