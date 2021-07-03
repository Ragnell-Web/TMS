const newDN = document.querySelector("#newDN");
const oldDN = document.querySelector("#oldDN");
const okBtn = document.querySelector("#okBtn");
//ajaxSetup
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

oldDN.addEventListener("keyup", function (e) {
    if (e.keyCode == 13) {
        const dn_no = this.value;
        ajaxSetup;
        $.get("modify_dn/getDN", function (datas) {
            const dnFilter = datas.filter((data) => data.dn_no === dn_no);
            if (dnFilter.length <= 1) {
                alert("Data tidak ada!");
            } else {
                $.post("modify_dn", { dn_no }, function (data) {
                    newDN.disabled = false;
                    newDN.dataset.dn = data.dn_no;
                    console.log(data);
                });
            }
        });
    }
});

okBtn.addEventListener("click", function (e) {
    const dn_no = newDN.value;
    const datadn = newDN.dataset.dn;
    if (dn_no.length >= 16) {
        ajaxSetup;
        $.post("modify_dn/updateDN", {dn_no,dn_no2: datadn }, function (data) {
            console.log(data);
            alert('Data telah di update');
         });
    } else {
        alert('panjang karakter kurang')
    }
});
