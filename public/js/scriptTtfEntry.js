// const addRow = document.querySelector('#addRow');
const trModals = [...document.querySelectorAll(".tableTtf")];
const tBodyUtama = document.querySelector("#ttfArlBody");
const tBodyModal = document.querySelector("#bodyTable");
const addBtn = document.querySelector("#addBtn");
const editBtn = document.querySelector("#editBtn");
const addRow = document.querySelector("#addRow");
const saveRow = document.querySelector("#saveRow");
const trInvoicesForTtf = [...document.querySelectorAll(".invoice-for-ttf")];
const dateInput = $("#date").val();

window.addEventListener("load", function (e) {
    trModals.forEach((trModal) => {
        const trChildrens = [...trModal.children];
        trChildrens.forEach((trChildren) => {
            const inputChildrens = [...trChildren.children];
            inputChildrens
                .filter((inputChild) => {
                    const noUrutId = document.querySelector("#noUrut");
                    return inputChild !== noUrutId;
                })
                .forEach((inp) => {
                    inp.value = "";
                });
        });
    });
});

$(".invoice").on("click", function (e) {
    let dataId = $(this).data("id");
    console.log(dataId);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.post("ttf_entry/customer", { id: dataId }, function (data) {
        $('input[name="custcode"]').val(data[0]["custcode"]);
        $('input[name="company"]').val(data[0]["company"]);
    });
});

addBtn.addEventListener("click", function (e) {
    console.log(e);
    const ttf_no = $("#ttfNo1").val();
    const date = $("#date").val();
    const valas = $("#valas").val();
    const ref_no = $("#refNo").val();
    const total_amt = $("#amountTotal").val();
    const custcode = $('input[name="custcode"]').val();
    const company = $('input[name="company"]').val();
    const remark = $("#remark").val();
    const operator = $("#staff_create_stin").val();
    const total_inv = $("input[name='noOfInvoice']").val();
    $("input[name='ttfNo1']").val(Number(ttf_no) + 1);
    if (
        !$('input[name="custcode"]').val() &&
        !$('input[name="company"]').val()
    ) {
        $("#exampleModal2").modal("show");
        $("#exampleModal1").modal("hide");
    } else {
        $.post(
            "ttf_entry/addTtfEntry",
            {
                ttf_no,
                ref_no,
                written: date,
                custcode,
                company,
                valas,
                total_inv,
                total_amt,
                remark,
                operator,
            },
            function (data) {
                $('input[name="custcode"]').val("");
                $('input[name="company"]').val("");
                const trBaruModals = [
                    ...document.querySelectorAll(".tableTtf-baru"),
                ];
                trBaruModals.forEach((trBaruModal) => {
                    tBodyModal.removeChild(trBaruModal);
                });
                trModals.forEach((trModal) => {
                    const trChildrens = [...trModal.children];
                    trChildrens.forEach((trChildren) => {
                        const inputChildrens = [...trChildren.children];
                        inputChildrens
                            .filter((inputChild) => {
                                const noUrutId =
                                    document.querySelector("#noUrut");
                                return inputChild !== noUrutId;
                            })
                            .forEach((inp) => {
                                inp.value = "";
                            });
                    });
                });
            }
        );
    }
});

editBtn.addEventListener("click", function (e) {
    console.log(e);
    const ttf_no = $("#ttfNo1").val();
    const date = $("#date").val();
    const valas = $("#valas").val();
    const ref_no = $("#refNo").val();
    const total_amt = $("#amountTotal").val();
    const custcode = $('input[name="custcode"]').val();
    const company = $('input[name="company"]').val();
    const remark = $("#remark").val();
    const operator = $("#staff_create_stin").val();
    const total_inv = $("input[name='noOfInvoice']").val();
    $("input[name='ttfNo1']").val(Number(ttf_no) + 1);
    if (
        !$('input[name="custcode"]').val() &&
        !$('input[name="company"]').val()
    ) {
        $("#exampleModal2").modal("show");
        $("#exampleModal1").modal("hide");
    } else {
        $.post(
            "ttf_entry/editTtfEntry",
            {
                ttf_no,
                ref_no,
                written: date,
                custcode,
                company,
                valas,
                total_inv,
                total_amt,
                remark,
                operator,
            },
            function (data) {
                $('input[name="custcode"]').val("");
                $('input[name="company"]').val("");
                const trBaruModals = [
                    ...document.querySelectorAll(".tableTtf-baru"),
                ];
                trBaruModals.forEach((trBaruModal) => {
                    tBodyModal.removeChild(trBaruModal);
                });
                trModals.forEach((trModal) => {
                    const trChildrens = [...trModal.children];
                    trChildrens.forEach((trChildren) => {
                        const inputChildrens = [...trChildren.children];
                        inputChildrens
                            .filter((inputChild) => {
                                const noUrutId =
                                    document.querySelector("#noUrut");
                                return inputChild !== noUrutId;
                            })
                            .forEach((inp) => {
                                inp.value = "";
                            });
                    });
                });
            }
        );
    }
});

addRow.addEventListener("click", function (e) {
    if (
        !$('input[name="custcode"]').val() &&
        !$('input[name="company"]').val()
    ) {
        $("#exampleModal2").modal("show");
        $("#exampleModal1").modal("hide");
    } else {
        const element = /*html*/ `
                            <td><input type="text" style="width:50px;" class="form-control form-control-sm noUrut" name="" disabled></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm invNo"></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm refNo"></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm taxNo"></td>
                            <td><input type="text" style="width:200px;" class="form-control form-control-sm kwNo"></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm dateModal"></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm due"></td>
                            <td><input type="text" style="width:50px;" class="form-control form-control-sm dollar"></td>
                            <td><input type="text" style="width:150px;" class="form-control form-control-sm totAmount"></td>

    `;
        const trBaruModal = document.createElement("tr");
        trBaruModal.classList.add("tableTtf-baru");
        trBaruModal.classList.add("tableTtf");
        trBaruModal.innerHTML = element;
        tBodyModal.appendChild(trBaruModal);
        const noUrut = [...document.querySelectorAll(".noUrut")];
        noUrut.forEach((no, i) => {
            no.name = (i + 1).toString().padStart(3, 0);
            no.value = (i + 1).toString().padStart(3, 0);
        });
    }
});

saveRow.addEventListener("click", function (e) {
    const custcode = $("#custcode").val();
    const ttf_no = $("#ttfNo1").val();
    const nu = [...document.querySelectorAll(".noUrut")];
    const invoice = [...document.querySelectorAll(".invNo")];
    const ref_no = [...document.querySelectorAll(".refNo")];
    const tax_no = [...document.querySelectorAll(".taxNo")];
    const kw_no = [...document.querySelectorAll(".kwNo")];
    const inv_date = [...document.querySelectorAll(".dateModal")];
    const inv_due = [...document.querySelectorAll(".due")];
    const valas = [...document.querySelectorAll(".dollar")];
    const amount_tot = [...document.querySelectorAll(".totAmount")];
    if (
        !$('input[name="custcode"]').val() &&
        !$('input[name="company"]').val()
    ) {
        $("#exampleModal2").modal("show");
        $("#exampleModal1").modal("hide");
    } else {
        for (let i = 0; i < invoice.length; i++) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.post("ttf_entry/add", {
                ttf_no,
                custcode,
                nu: nu[i].value,
                invoice: invoice[i].value,
                ref_no: ref_no[i].value,
                tax_no: tax_no[i].value,
                kw_no: kw_no[i].value,
                received: inv_date[i].value,
                inv_date: inv_date[i].value,
                inv_due: inv_due[i].value,
                valas: valas[i].value,
                amount_tot: amount_tot[i].value,
            });

        }
        $.post("ttf_entry/getTtfWhereNo", { ttf_no }, function (datas) {
            $('input[name="noOfInvoice"]').val(datas.length);
            let amount_tot = datas
                .map((data) => data.amount_tot)
                .reduce((total, angka) => total + angka);
            $("#amountTotal").val(amount_tot);
        });
        const trBaruModals = [...document.querySelectorAll(".tableTtf-baru")];
        trBaruModals.forEach((trBaruModal) => {
            tBodyModal.removeChild(trBaruModal);
        });
        trModals.forEach((trModal) => {
            const trChildrens = [...trModal.children];
            trChildrens.forEach((trChildren) => {
                const inputChildrens = [...trChildren.children];
                inputChildrens
                    .filter((inputChild) => {
                        const noUrutId = document.querySelector("#noUrut");
                        return inputChild !== noUrutId;
                    })
                    .forEach((inp) => {
                        inp.value = "";
                    });
            });
        });
    }
});

tBodyModal.addEventListener("keyup", function (e) {
    if (e.target.classList.contains("invNo")) {
        if (e.keyCode == 13) {
            if (
                !$('input[name="custcode"]').val() &&
                !$('input[name="company"]').val()
            ) {
                $("#exampleModal2").modal("show");
                $("#exampleModal1").modal("hide");
            } else {
                $("#exampleModal3").modal("toggle");
                const inputValue =
                    e.target.parentElement.previousElementSibling.firstChild
                        .value;
                const invoiceForTtf = [
                    ...document.querySelectorAll(".invoice-for-ttf"),
                ];
                invoiceForTtf.forEach((trInvoice) => {
                    trInvoice.dataset.noUrut = inputValue;
                });
            }
        }
    }
});

$(".invoice-for-ttf").on("click", function (e) {
    const id = $(this).data("id");
    const custcode = $(this).data("custcode");
    const invoice = $(this).data("invoice");
    const dataNoUrut = $(this).data("noUrut");
    const trNoUrut = document.querySelector(
        `input[name=` + '"' + dataNoUrut + '"' + `]`
    ).parentElement.parentElement;
    console.log(trNoUrut);
    let inv = trNoUrut.children[1].children[0];
    let ref = trNoUrut.children[2].children[0];
    let tax = trNoUrut.children[3].children[0];
    let kw = trNoUrut.children[4].children[0];
    let date = trNoUrut.children[5].children[0];
    let due = trNoUrut.children[6].children[0];
    let dollar = trNoUrut.children[7].children[0];
    let amount = trNoUrut.children[8].children[0];
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    if ($('input[name="custcode"]').val() == custcode) {
        $("#exampleModal3").modal("hide");
        $.post("ttf_entry/getInvoice", { id }, function (data) {
            inv.value = data[0].invoice;
            ref.value = data[0].ref_no;
            tax.value = data[0].tax_no;
            kw.value = `${dateInput.substring(8)}/KWTCH/${data[0].remark}`;
            date.value = data[0].written;
            due.value = data[0].due;
            dollar.value = data[0].valas;
            amount.value = data[0].amount_sub;
        });
    } else {
        alert("Custcode tidak sama");
    }
    $.post("ttf_entry/getEntryTtfTbl", function (data) {
        for (let i = 0; i < data.length; i++) {
            if (invoice == data[i].invoice) {
                alert("No Invoice sudah ada");
                $("#exampleModal3").modal("show");
                inv.value = "";
                ref.value = "";
                tax.value = "";
                kw.value = ``;
                date.value = "";
                due.value = "";
                dollar.value = "";
                amount.value = "";
            }
        }
    });
});
