const startWithDate = document.querySelector("#startWithDate");
const endWithDate = document.querySelector('#endWithDate');
const startWithCustomer = document.querySelector("#startWithCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const printItem = document.querySelector("#printItem");
const reportTitle = document.querySelector("#reportTitle");
const showModalCustomer = function (modal, element) {
    $(`#${modal}`).modal("show");
    ajaxSetup;
    $.post("list_due/getCustomer", function (datas) {
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

endWithDate.value = `${year}-${month.toString().padStart(2, 0)}-${day
    .toString()
    .padStart(2, 0)}`;

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    showModalCustomer('exampleModal1', tBodyCustomer);
});

endWithCustomer.onkeyup = function (e) {
    if (!e.keyCode == 13) return;
    showModalCustomer('exampleModal2', tBodyCustomer2);
};

tBodyCustomer.onclick = function (e) {
    hideModal(e, 'exampleModal1', startWithCustomer);
};

tBodyCustomer2.onclick = function (e) {
    hideModal(e, "exampleModal2", endWithCustomer);
};

printItem.onclick = function (e) {
    ajaxSetup;
    $.post('list_due/print', {
        reportTitle: reportTitle.value
    }, function (data) {
        const w = window.open('about#blank');
        w.document.open();
        w.document.write(data);
        w.document.close()
     })
 }