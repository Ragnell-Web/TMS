const startWithItemCode = document.querySelector("#startWithItemCode");
const endWithItemCode = document.querySelector("#endWithItemCode");
const tBodyItem = document.querySelector("#tBodyItem");
const tBodyItem2 = document.querySelector("#tBodyItem2");
//ajaxsetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


startWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal1").modal("show");
        ajaxSetup;
        $.post("rekapitulasi_i/getPartNo", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-part="${dat.ITEMCODE}" data-isi="${dat.ITEMCODE}">
              <td>${dat.ITEMCODE}</td>
              <td>${dat.PART_NO}</td>
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

endWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
        ajaxSetup;
        $.post("rekapitulasi_i/getPartNo", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowInvoice" data-part="${dat.ITEMCODE}" data-isi="${dat.ITEMCODE}">
              <td>${dat.ITEMCODE}</td>
              <td>${dat.PART_NO}</td>
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

const hideModal = function (e, modal, inputNode) {
    if (!e.target.parentElement) return;
    $(modal).modal("hide");
    const data = e.target.parentElement.dataset.isi;
    inputNode.value = data;
};

tBodyItem.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal1", startWithItemCode);
});

tBodyItem2.addEventListener("click", function (e) {
    hideModal(e, "#exampleModal2", endWithItemCode);
});
