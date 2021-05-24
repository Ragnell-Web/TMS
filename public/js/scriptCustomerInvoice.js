$(".invoice").on("click", function (e) {
    // console.log(e.target.innerHTML);
    let dataId = $(this).data("id");
    function showData(data) {
        $("input[name='noinvoice']").val(data[0]["invoice"]);
        $("input[name='inv_type']").val(data[0]["inv_type"]);
        $("input[name='source']").val(data[0]["source"]);
        $("input[name='custcode1']").val(data[0]["custcode"]);

        $("input[name='period']").val(data[0]["period"]);
        $("input[name='written']").val(data[0]["written"]);
        $("input[name='company1']").val(data[0]["company"]);

        $("input[name='ref_no']").val(data[0]["ref_no"]);
        $("input[name='contact']").val(data[0]["contact"]);
        $("input[name='taxrate']").val(data[0]["taxrate"]);
        $("input[name='address1']").val(data[0]["address1"]);
        $("input[name='address3']").val(data[0]["address3"]);
        $("input[name='valas']").val(data[0]["valas"]);
        $("input[name='rate']").val(data[0]["rate"]);
        $("input[name='due']").val(data[0]["due"]);
        $("input[name='glar']").val(data[0]["glar"]);
    }
    // $(".modal.fade.satu").remove();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.post(
        "acc/customer",
        {
            id: dataId,
        },
        function (data) {
            showData(data);
        }
    );
});

function addSaveRow() {
    let dataInvoice = $("input[name='noinvoice']").val();
    let company = $("input[name='company1']").val();
    let custcode = $("input[name='custcode1']").val();
    let contact = $("input[name='contact']").val();
    let source = $("input[name='source']").val();
    let taxrate = $("input[name='taxrate']").val();
    let period = $("input[name='period']").val();
    let written = $("input[name='written']").val();
    let ref_no = $("input[name='ref_no']").val();
    let address1 = $("input[name='address1']").val();
    let address3 = $("input[name='address3']").val();
    let valas = $("input[name='valas']").val();
    let rate = $("input[name='rate']").val();
    let due = $("input[name='due']").val();
    let glar = $("input[name='glar']").val();
    return $.post(
        "acc",
        {
            cust_id: custcode,
            company,
            contact,
            source,
            taxrate,
            period,
            written,
            ref_no,
            address1,
            address3,
            valas,
            rate,
            due,
            glar,
        },
        function (datas) {
            // const isiInput = /*html*/ `
            //     <div class="col">
            //             <div class="form-row">
            //                 <div class="col-1 mb-2">
            //                     <label>Invoice No</label>
            //                 </div>
            //                 <div class="col-1 mb-2">
            //                     <input type="text" name="noinvoice" class="form-control form-control-sm" id="noinvoice"
            //                         aria-describedby="" value="${datas[1]['invoice']}" placeholder="No Invoice" disabled>
            //                 </div>
            //                 <div class="col-1 mb-2">
            //                     <input type="text" name="inv_type" class="form-control form-control-sm" id="inv_type"
            //                         placeholder="SJ" disabled>
            //                 </div>

            //                 <div class="col-2 mb-2">
            //                     <input type="text" placeholder="HO" id="source" name="source" value="${datas[1]['source']}"
            //                         class="form-control form-control-sm" disabled>
            //                 </div>
            //                 <div class="col-md-1 mb-2 align-center">
            //                     <label>Customer Id</label>
            //                 </div>
            //                 <div class="col-md-1 mb-2">
            //                     <input type="text" name="custcode1" class="form-control form-control-sm" id="custcode" value="${datas[0]['custcode']}"
            //                         placeholder="Cust Code" disabled>
            //                 </div>
            //                 <div class="col-md-1 mb-2">
            //                     <input type="text" name="" class="form-control form-control-sm" placeholder="" disabled>
            //                 </div>
            //                 <div class="col-md-1 mb-2">
            //                     <input type="number" name="" class="form-control form-control-sm" placeholder="0"
            //                         disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-2 align-right">
            //                     <label>Staff</label>
            //                 </div>
            //                 <div class="col-1 mb-2">
            //                     <input class="form-control form-control-sm" value="GALIH"
            //                         name="staff" type="text" id="staff_create_stin" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Per/Date</label>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="period" autocomplete="off" class="form-control form-control-sm" value="${datas[1]['period']}"
            //                         id="period" placeholder="YYYY/MM" disabled>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="written" autocomplete="off"
            //                         class="form-control form-control-sm" id="written" value="${datas[1]['written']}" placeholder="YYYY-MM-DD" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="company1" autocomplete="off"
            //                         class="form-control form-control-sm" id="company" value="${datas[0]['company']}" placeholder="Name of your pt"
            //                         disabled>
            //                 </div>
            //                 <div class="col-md-1 mb-1 align-right">
            //                     <label>Prn/Post</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="post" type="text" id="post" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Refs.No</label>
            //                 </div>
            //                 <div class="col-4 mb-1">
            //                     <input type="text" name="ref_no" autocomplete="off" class="form-control form-control-sm"
            //                         id="ref_no" value="${datas[1]['ref_no']}" placeholder="Ref No" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="contact" autocomplete="off"
            //                         class="form-control form-control-sm" id="contact" value="${datas[0]['contact']}" placeholder="Nama Orang di sana" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>Voided</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="voided" type="text" id="voided"
            //                         disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>VAT No</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input type="text" name="taxrate" autocomplete="off"
            //                         class="form-control form-control-sm" id="taxrate" value="${datas[0]['taxrate']} %" placeholder="Tax Rate %" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="address1" autocomplete="off"
            //                         class="form-control form-control-sm" id="address1" value="${datas[1]['address1']}" placeholder="Address" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>Sub Total</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Sales / PIC</label>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="address3" autocomplete="off"
            //                         class="form-control form-control-sm" id="address3" value="${datas[1]['address3']}" placeholder="Pos code" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>CN / Disc</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Currency</label>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="valas" autocomplete="off" class="form-control form-control-sm"
            //                         id="valas" value="${datas[1]['valas']}" placeholder="IDR" disabled>
            //                 </div>
            //                 <div class="col-2 mb-1">
            //                     <input type="text" name="rate" autocomplete="off" class="form-control form-control-sm"
            //                         id="rate" value="${datas[1]['rate']}" placeholder="1000" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>V.A.T</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Terms</label>
            //                 </div>
            //                 <div class="col-4 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="0 Days" disabled>
            //                 </div>
            //                 <div class="col-md-4 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>Total</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Due Date</label>
            //                 </div>
            //                 <div class="col-4 mb-1">
            //                     <input type="text" name="due" autocomplete="off" class="form-control form-control-sm" value="${datas[1]['due']}"
            //                         id="due" placeholder="Date" disabled>
            //                 </div>
            //                 <div class="col-1 mb-2 align-center">
            //                     <label>Gl Ar</label>
            //                 </div>
            //                 <div class="col-md-1 mb-1">
            //                     <input type="text" name="glar" autocomplete="off" class="form-control form-control-sm" value="${datas[1]['glar']}"
            //                         id="glar" placeholder="Gl Ar" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         placeholder="Trade receiveables - Third Parties" disabled>
            //                 </div>
            //                 <div class="col-md-2 mb-1 align-right">
            //                     <label>Payment</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" disabled>
            //                 </div>
            //             </div>
            //             <div class="form-row">
            //                 <div class="col-1 mb-1">
            //                     <label>Remark</label>
            //                 </div>
            //                 <div class="col-4 mb-1">
            //                     <input type="text" name="" autocomplete="off" class="form-control form-control-sm"
            //                         id="refs_no_create_stin" placeholder="" disabled>
            //                 </div>
            //                 <div class="col-md-6 mb-1 align-right">
            //                     <label>Balance</label>
            //                 </div>
            //                 <div class="col-1 mb-1">
            //                     <input class="form-control form-control-sm" name="" type="text" id="printed_create_stin"
            //                         disabled>
            //                 </div>
            //             </div>
            //         </div>
            // `;
            // $('#isiInput').html(isiInput);
        }
    );
}

function addDoHdr(datas) {
    return datas.map((SJ,i) => {
        return /*html*/ `
                      <tr style="text-align:center">
                        <td>${i+1}</td>
                        <td>${SJ["custcode"]}</td>
                        <td>${SJ["do_no"]}</td>
                        <td>${SJ["dn_no"]}</td>
                        <td>${SJ["po_no"]}</td>
                        <td>${SJ["ref_no"]}</td>
                        <td>${SJ["sso_no"]}</td>
                        <td>${SJ["written"]}</td>
                        <td>${SJ["tot_amt"]}</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input isCheck" type="checkbox" value="${
                                    SJ["do_no"]
                                }" id="yesorno${i}">
                                <label class="form-check-label" for="yesorno${i}">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input isRadio" type="radio" name="delete" data-no="${i++}" value="${
            SJ["do_no"]
        }" id="delete">
                                <label class="form-check-label" for="delete">
                                    Delete
                                </label>
                            </div>
                        </td>
                      </tr>
                    `;
    });
}

const addBtn = document.querySelector("#addRow");
addBtn.addEventListener("click", function (e) {
    let dataInvoice = $("input[name='noinvoice']").val();
    let company = $("input[name='company1']").val();
    let custcode = $("input[name='custcode1']").val();

    $('input[name="custcode2"]').val(custcode);
    $('input[name="company2"]').val(company);
    $('input[name="invoice"]').val(dataInvoice);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.post("acc/sj", { cust_id: custcode }, function (dataSJ) {
        let i = 1;
        let datas = addDoHdr(dataSJ).join('');
        if (dataSJ.length < 1) {
            let isiTabelKosong = /*html*/ `
                            <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                        `;
            $("#bodyCustomers").html(isiTabelKosong);
        } else {
            $("#bodyCustomers").html(datas);
        }
    });
    addSaveRow();
});
const saveBtn = document.querySelector('#saveRow');
saveBtn.addEventListener('click', function (e) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    addSaveRow();
})

function showCheckBoxChecked() {
    const checkBoxs = [...document.querySelectorAll(".isCheck")];

    let checklist = checkBoxs
        .map((checkBox) => {
            if (checkBox.checked) {
                return checkBox.value;
            }
        })
        .filter((checkFill) => checkFill > "21020000")
        .join(" ");
    let checkListArray = checklist.split(" ");

    return checkListArray;
}

function showRadioChecked() {
    const deleteRadio = [...document.querySelectorAll(".isRadio")];
    let radioList = deleteRadio
        .map((dltRdio) => {
            if (dltRdio.checked) {
                return [dltRdio.value,dltRdio.dataset.no];
            }
        })
        .filter((checkFill) => checkFill > "21020000")
    console.log(radioList);
    return radioList;
}

const items = JSON.parse(localStorage.getItem("items")) || [];

function saveToLocalStorage() {
    items.push(showCheckBoxChecked());
    localStorage.setItem("items", JSON.stringify(items));
    let lastItems = items.pop();
    console.log(lastItems);
}

function getDoDtl(arrayOfPost = []) {
    return $.post(
        "acc/doDtl",
        {
            do_no: arrayOfPost[0],
            do_no2: arrayOfPost[1],
            do_no3: arrayOfPost[2],
            do_no4: arrayOfPost[3],
            do_no5: arrayOfPost[4],
        },
        function (data) {
            let i = 1;
            let dats;
            function showHtml(dataDo) {
                return /*html*/ `
                <tr style="text-align:center;" >
                    <td>${i++}</td>
                    <td>${dataDo["part_no"]}</td>
                    <td>${dataDo["itemcode"]}</td>
                    <td>${dataDo["descript"]}</td>
                    <td>${dataDo["unit"]}</td>
                    <td>${dataDo["quantity"]}</td>
                    <td>${dataDo["price"]}</td>
                    <td>${dataDo["cost"]}</td>
                    <td>${dataDo["do_no"]}</td>
                    <td>${dataDo["sso_no"]}</td>
                </tr>
            `;
            }
            let datasDoDtl = data.map((dataDo) => {
                return showHtml(dataDo);
            });

            datasDoDtl.forEach((dataDo) => {
                dats += dataDo;
            });
            if (data.length < 1) {
                let isiTabelKosong = /*html*/ `
                            <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                        `;
                $("#body").html(isiTabelKosong);
                $("#suratJalanBody").html(isiTabelKosong);
            } else {
                $("#body").html(dats);
                $("#suratJalanBody").html(dats);
            }
        }
    );
}

const saveBtnRow = document.querySelector("#saveBtn");
saveBtnRow.addEventListener("click", function (e) {
    saveToLocalStorage();

    console.log(showCheckBoxChecked());
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    });
    getDoDtl(showCheckBoxChecked());
});

const delBtnRow = document.querySelector('#deleteBtn');
delBtnRow.addEventListener('click', function (e) {
    showRadioChecked()
    let do_no = showRadioChecked()[0][0];
    let custcode = $("input[name='custcode1']").val();
    let dataNo = showRadioChecked()[0][1]
    console.log(dataNo);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.post("/tms/acc/delete", { do_no, custcode }, function (dataSJ) {
        let i = 1;
        let datas = addDoHdr(dataSJ);
        datas.splice(dataNo, 1);
        if (dataSJ.length < 1) {
            let isiTabelKosong = /*html*/ `
                            <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                        `;
            $("#bodyCustomers").html(isiTabelKosong);
        } else {
            $("#bodyCustomers").html(datas);
        }
    });
});

window.addEventListener('load', function (e) {
    let lastItems = items.pop();
    console.log(lastItems);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    getDoDtl(lastItems);
 })