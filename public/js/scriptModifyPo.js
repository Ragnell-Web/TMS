const oldPO = document.querySelector("#oldPO");
const newPO = document.querySelector("#newPO");
const okBtn = document.querySelector("#okBtn");
//ajaxSetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

oldPO.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        const po_no = this.value;
        ajaxSetup;
        $.get("modify_po/getPO", function (datas) {
            const poFilter = datas.filter((data) => data.po_no === po_no);
            if (poFilter.length <= 1) {
                alert("Data tidak ada!");
            } else {
                $.post("modify_po", { po_no }, function (data) {
                    newPO.disabled = false;
                    newPO.dataset.po = data.po_no;
                    console.log(data);
                });
            }
        });
    }
});

okBtn.addEventListener("click", function (e) {
    const po_no = newPO.value;
    const dataPo = newPO.dataset.po;
    if (po_no.length >= 10) {
        ajaxSetup;
        $.post("modify_po/updatePO", {po_no,po_no2: dataPo }, function (data) {
            console.log(data);
            alert('Data telah di update');
         });
    } else {
        alert('panjang karakter kurang')
    }
});
