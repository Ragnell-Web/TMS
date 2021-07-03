const startWithCustomer = document.querySelector("#startWithCustomer");
const tBodyCustomer = document.querySelector("#tBodyCustomer");
const endWithCustomer = document.querySelector("#endWithCustomer");
const tBodyCustomer2 = document.querySelector("#tBodyCustomer2");
const terms = document.querySelectorAll(".terms");
const tgl = document.querySelector("#tgl");
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

terms.forEach((term) => (term.disabled = true));

startWithCustomer.addEventListener("keyup", function (e) {
    if (!e.keyCode == 13) return;
    $("#exampleModal1").modal("show");
    ajaxSetup;
    $.post("ags_customer_interest/getCustomer", function (datas) {
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
    if (!e.keyCode == 13) return;
    $("#exampleModal2").modal("show");
    ajaxSetup;
    $.post("ags_customer_interest/getCustomer", function (datas) {
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

tgl.addEventListener("change", function (e) {
    if (tgl.value == "day") {
        $("#terms1").val("7");
        $("#terms2").val("13");
        $("#terms3").val("30");
        $("#terms4").val("45");
        $("#terms5").val("60");
        terms.forEach((term) => (term.disabled = true));
    } else if (tgl.value == "month") {
        $("#terms1").val("30");
        $("#terms2").val("60");
        $("#terms3").val("90");
        $("#terms4").val("120");
        $("#terms5").val("150");
        terms.forEach((term) => (term.disabled = true));
    } else {
        $("#terms1").val("");
        $("#terms2").val("");
        $("#terms3").val("");
        $("#terms4").val("");
        $("#terms5").val("");
        terms.forEach((term) => (term.disabled = false));
    }
});
