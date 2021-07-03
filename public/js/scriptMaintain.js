const addItem = document.querySelector("#addItem");
const editItems = [...document.querySelectorAll(".editItem")];
const deleteItems = [...document.querySelectorAll(".deleteItem")];
const addBtn = document.querySelector("#addBtn");
const tBodyInvoice = document.querySelector("#tBodyInvoice");
const tBodyInvoice2 = document.querySelector("#tBodyInvoice2");
const tBodyInvoice3 = document.querySelector("#tBodyInvoice3");
const startInvoiceNo = document.querySelector("#startInvoiceNo");
const endInvoiceNo = document.querySelector("#endInvoiceNo");
const eFakturBtn = document.querySelector("#eFakturBtn");
const note = document.querySelector("#note");
const eFakturCollapse = document.querySelector(".eFakturNote");
// ajaxSetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// date
const tgl = new Date();
const day = tgl.getDate();
const month = tgl.getMonth() + 1;
const year = tgl.getFullYear();

window.onload = () => $("#collapseExample1").collapse("show");

addItem.addEventListener("click", function (e) {
    $("#exampleModal1").modal("show");
});

tBodyInvoice.addEventListener("click", function (e) {
    if (e.target.parentElement) {
        const trInvoice = e.target.parentElement;
        ajaxSetup;
        $.post(
            "maintain/getEf_noWhere",
            { ef_no: trInvoice.dataset.ef },
            function (data) {
                $("#printedDate").html(data.printed);
                $("#invoiceNo").html(`${data.start_inv} to ${data.end_inv}`);
                $("#dateNo").html(`${data.start_date} to ${data.end_date}`);
                $.post(
                    "maintain/getInvoiceWhere",
                    { invoice: data.start_inv },
                    function (data) {
                        $("#operator").html(data.operator);
                    }
                );
                $(".cardEfaktur").html(data.ef_text);
            }
        );
    }
});

//editItems
tBodyInvoice.addEventListener("click", function (e) {
    if (e.target.classList.contains("editItem")) {
        console.log(e.target.parentElement.dataset.ef);
        const ef_no = e.target.parentElement.dataset.ef;
        $.post("maintain/getEf_noWhere", { ef_no: ef_no }, function (data) {
            const element = /*html*/ `
        <div class="form-floating mb-2 ">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px"></textarea>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary escBtn" data-ef="${data.ef_no}" type="button" id="escBtn">ESC</button>
            <button class="btn btn-primary okBtn" data-ef="${data.ef_no}" type="button" id="okBtn">OK</button>
        </div>

    `;
            eFakturCollapse.innerHTML = element;
            const floatingTextarea2 =
                document.querySelector("#floatingTextarea2");
            $("#printedDate").html(data.printed);
            $("#invoiceNo").html(`${data.start_inv} to ${data.end_inv}`);
            $("#dateNo").html(`${data.start_date} to ${data.end_date}`);
            $.post(
                "maintain/getInvoiceWhere",
                { invoice: data.start_inv },
                function (data) {
                    $("#operator").html(data.operator);
                }
            );
            floatingTextarea2.value = data.ef_text;
        });
    }
});

//deleteItems
tBodyInvoice.addEventListener('click', function (e) {
    if (!e.target.classList.contains('deleteItem')) return;
    console.log(e.target);
    let confincing = confirm("Anda Yakin Ingin Menghapus ?");
    while (confincing) {
        const ef_no = e.target.parentElement.dataset.ef;
        ajaxSetup;
        $.post("maintain/deleteEfPrint", { ef_no }, function (datas) {
            const tableInvoice = datas
                .map((data) => {
                    return /*html*/ `
                    <tr class="tableInvoice" data-ef="${data.ef_no}">
                      <td class="noUrut">${data.ef_no}</td>
                      <td class="printed">${data.printed}</td>
                      <td class="date">${data.start_date}</td>
                      <td class="invNo">${data.start_inv}</td>
                      <td class="action">
                          <a href="#" class="link-primary" data-ef="${data.ef_no}"><i class="ti-write editItem"></i></a>
                          <a href="#" class="link-danger" data-ef="${data.ef_no}"><i class="ti-trash deleteItem"></i></a>
                      </td>
                    </tr>
                    `;
                })
                .join("");
            tBodyInvoice.innerHTML = tableInvoice;
        });
        confincing = false;
    }
});

eFakturCollapse.addEventListener("click", function (e) {
    if (!e.target.classList.contains("okBtn")) return;
    const ef_no = e.target.dataset.ef;
    console.log(ef_no);
    const floatingTextarea2 =
        e.target.parentElement.previousSibling.previousSibling.children[0]
            .value;
    const element = /*html*/ `
        <div class="card card-body card-bordered cardEfaktur"></div>
    `;
    eFakturCollapse.innerHTML = element;
    $.post(
        "maintain/updateEfPrint",
        {
            ef_no,
            ef_text: floatingTextarea2,
        },
        function (data) {
            $(".cardEfaktur").html(data.ef_text);
        }
    );
});

eFakturCollapse.addEventListener("click", function (e) {
    if (!e.target.classList.contains("escBtn")) return;
    const ef_no = e.target.dataset.ef;
    const element = /*html*/ `
        <div class="card card-body card-bordered cardEfaktur"></div>
    `;
    eFakturCollapse.innerHTML = element;
    ajaxSetup;
    $.post("maintain/getEf_noWhere", { ef_no }, function (data) {
        $(".cardEfaktur").html(data.ef_text);
    });
});

addBtn.addEventListener("click", function (e) {
    const startInvoiceNoValue = startInvoiceNo.value;
    const endInvoiceNoValue = endInvoiceNo.value;
    const startDate = $("#startDate").val();
    const endDate = $("#endDate").val();
    const noUrut = [...document.querySelectorAll(".noUrut")];
    const cardEfaktur = $(".cardEfaktur").html();
    ajaxSetup;
    $.post(
        "maintain/addInvoice",
        {
            start_inv: startInvoiceNoValue,
            printed: `${year}-${month.toString().padStart(2, 0)}-${day}`,
            end_inv: endInvoiceNoValue,
            start_date: startDate,
            end_date: endDate,
            ef_text: cardEfaktur,
        },
        function (datas) {
            const tableInvoice = datas
                .map((data) => {
                    return /*html*/ `
                    <tr class="tableInvoice" data-ef="${data.ef_no}">
                      <td class="noUrut">${data.ef_no}</td>
                      <td class="printed">${data.printed}</td>
                      <td class="date">${data.start_date}</td>
                      <td class="invNo">${data.start_inv}</td>
                      <td class="action">
                          <a href="#" class="link-primary" data-ef="${data.ef_no}"><i class="ti-write editItem"></i></a>
                          <a href="#" class="link-danger" data-ef="${data.ef_no}"><i class="ti-trash deleteItem"></i></a>
                      </td>
                    </tr>
                    `;
                })
                .join("");
            tBodyInvoice.innerHTML = tableInvoice;
            console.log(noUrut[noUrut.length - 1].innerHTML);
            $("#printedDate").html(datas[datas.length - 1].printed);
            $("#invoiceNo").html(
                `${datas[datas.length - 1].start_inv} to ${
                    datas[datas.length - 1].end_inv
                }`
            );
            $("#dateNo").html(
                `${datas[datas.length - 1].start_date} to ${
                    datas[datas.length - 1].end_date
                }`
            );
            $(".cardEfaktur").html(cardEfaktur);
            $.post(
                "maintain/getInvoiceWhere",
                { invoice: startInvoiceNoValue },
                function (data) {
                    $("#operator").html(data.operator);
                }
            );
        }
    );
});

startInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
        $("#exampleModal1").modal("hide");
        ajaxSetup;
        $.post("maintain/getInvoice", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-invoice="${dat.invoice}">
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

endInvoiceNo.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal3").modal("show");
        $("#exampleModal1").modal("hide");
        ajaxSetup;
        $.post("maintain/getInvoice", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-invoice="${dat.invoice}">
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
            tBodyInvoice3.innerHTML = data;
        });
    }
});

tBodyInvoice2.addEventListener("click", function (e) {
    if (e.target.parentElement) {
        $("#exampleModal1").modal("show");
        $("#exampleModal2").modal("hide");
        const invoice = e.target.parentElement.dataset.invoice;
        ajaxSetup;
        $.post("maintain/getInvoiceWhere", { invoice }, function (data) {
            startInvoiceNo.value = data.invoice;
            $("#startDate").val(data.written);
        });
    }
});

tBodyInvoice3.addEventListener("click", function (e) {
    if (e.target.parentElement) {
        $("#exampleModal1").modal("show");
        $("#exampleModal3").modal("hide");
        const invoice = e.target.parentElement.dataset.invoice;
        ajaxSetup;
        $.post("maintain/getInvoiceWhere", { invoice }, function (data) {
            endInvoiceNo.value = data.invoice;
            $("#endDate").val(data.written);
        });
    }
});

eFakturBtn.onclick = (e) => $("#collapseExample2").collapse("hide");

note.onclick = (e) => $("#collapseExample1").collapse("hide");
