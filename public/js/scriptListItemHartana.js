const startWithItemCode = document.querySelector("#startWithItemCode");
const endWithItemCode = document.querySelector("#endWithItemCode");
const tBodyInvoice = document.querySelector("#tBodyInvoice");
const tBodyInvoice2 = document.querySelector("#tBodyInvoice2");
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
        $.post("list_item_standart/getItem", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowItem" data-item="${dat.ITEMCODE}">
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
            tBodyInvoice.innerHTML = data;
        });
    }
});

endWithItemCode.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        $("#exampleModal2").modal("show");
        ajaxSetup;
        $.post("list_item_hartana/getItem", function (datas) {
            let data = datas
                .map((dat) => {
                    return /*html*/ `
            <tr class="tableRowItem" data-item="${dat.ITEMCODE}">
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
            tBodyInvoice2.innerHTML = data;
        });
    }
});

tBodyInvoice.addEventListener("click", function (e) {
    console.log(e.target);
    if (e.target.parentElement) {
        $("#exampleModal1").modal("hide");
        const dataItem = e.target.parentElement.dataset.item;
        startWithItemCode.value = dataItem;
    }
});

tBodyInvoice2.addEventListener("click", function (e) {
    console.log(e.target);
    if (e.target.parentElement) {
        $("#exampleModal2").modal("hide");
        const dataItem = e.target.parentElement.dataset.item;
        endWithItemCode.value = dataItem;
    }
});

