$(".invoice").on("click", function (e) {
    // console.log(e.target.innerHTML);
    let dataId = $(this).data("id");
    function showData(data) {
        // $("input[name='noinvoice']").val(data[0]["invoice"]);
        $("input[name='inv_type']").val(data[0]["inv_type"]);
        $("input[name='source']").val(data[0]["source"]);
        $("input[name='custcode1']").val(data[0]["custcode"]);
        $("input[name='company1']").val(data[0]["company"]);
        $("input[name='contact']").val(data[0]["contact"]);
        $("input[name='address1']").val(data[0]["address1"]);
        $("input[name='address2']").val(data[0]["address2"]);
        $("input[name='valas']").val(data[0]["valas"]);
        $("input[name='rate']").val(data[0]["rate"]);
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
    let address2 = $("input[name='address2']").val();
    let valas = $("input[name='valas']").val();
    let rate = $("input[name='rate']").val();
    let due = $("input[name='due']").val();
    let glar = $("input[name='glar']").val();
    let inv_type = $("#inv_type").val();
    let operator = $("input[name='staff']").val();
    let remark = $("#remark").val();
    return $.post(
        "acc",
        {
            invoice: dataInvoice,
            cust_id: custcode,
            company,
            contact,
            source,
            taxrate,
            period,
            written,
            ref_no,
            address1,
            address2,
            valas,
            rate,
            due,
            glar,
            inv_type,
            operator,
            remark,
        },
        function (datas) {}
    );
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

        let datas = dataSJ[0].map((SJ,i) => {
        return /*html*/ `
                      <tr style="text-align:center">
                        <td>${i+1}</td>
                        <td>${SJ["cust_id"]}</td>
                        <td>${SJ["do_no"]}</td>
                        <td>${SJ["dn_no"]}</td>
                        <td>${SJ["po_no"]}</td>
                        <td>${SJ["ref_no"]}</td>
                        <td>${SJ["sso_no"]}</td>
                        <td>${SJ["delivery_date"]}</td>
                        <td>${SJ["PRICE"]}</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input isCheck" type="checkbox" value="${
                                    SJ["do_no"]
                                }" id="yesorno${i}">
                                <label class="form-check-label" for="yesorno${i}">
                                    Yes
                                </label>
                            </div>
                        </td>
                      </tr>
                    `;
        }).join('');
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
    let address2 = $("input[name='address2']").val();
    let valas = $("input[name='valas']").val();
    let rate = $("input[name='rate']").val();
    let due = $("input[name='due']").val();
    let glar = $("input[name='glar']").val();
    let inv_type = $("#inv_type").val();
    let operator = $("input[name='staff']").val();
    let remark = $("#remark").val();
    $("input[name='noinvoice']").val(Number(dataInvoice)+1)
    $.post(
        "acc/add",
        {
            invoice : dataInvoice,
            cust_id: custcode,
            company,
            contact,
            source,
            taxrate,
            period,
            written,
            ref_no,
            address1,
            address2,
            valas,
            rate,
            due,
            glar,
            inv_type,
            operator,
            remark
        },
        function (datas) {

        }
    );
})

function showCheckBoxChecked() {
    const checkBoxs = [...document.querySelectorAll(".isCheck")];

    let checklist = checkBoxs
        .map((checkBox) => {
            if (checkBox.checked) {
                return checkBox.value;
            }
        })
        .filter((checkFill) => checkFill > "11111111")
        .join(" ");
    let checkListArray = checklist.split(" ");

    return checkListArray;
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
            function showHtml(dataDo) {
                return /*html*/ `
                <tr style="text-align:center;" >
                    <td>${i++}</td>
                    <td>${dataDo["PART_NO"]}</td>
                    <td>${dataDo["item_code"]}</td>
                    <td>${dataDo["DESCRIPT"]}</td>
                    <td>${dataDo["unit"]}</td>
                    <td>${dataDo["quantity"]}</td>
                    <td>${dataDo["PRICE"]}</td>
                    <td>${dataDo["COST"]}</td>
                    <td>${dataDo["do_no"]}</td>
                    <td>${dataDo["sso_no"]}</td>
                </tr>
            `;
            }
            let datasDoDtl = data.map((dataDo) => {
                return showHtml(dataDo);
            }).join('');

            if (data.length < 1) {
                let isiTabelKosong = /*html*/ `
                            <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                        `;
                $("#body").html(isiTabelKosong);
                $("#suratJalanBody").html(isiTabelKosong);
            } else {
                $("#body").html(datasDoDtl);
                $("#suratJalanBody").html(datasDoDtl);
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

// const delBtnRow = document.querySelector('#deleteBtn');
// delBtnRow.addEventListener('click', function (e) {
//     showRadioChecked()
//     let do_no = showRadioChecked()[0][0];
//     let custcode = $("input[name='custcode1']").val();
//     let dataNo = showRadioChecked()[0][1]
//     console.log(dataNo);
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     $.post("/tms/acc/delete", { do_no, custcode }, function (dataSJ) {
//         let i = 1;
//         let datas = addDoHdr(dataSJ);
//         datas.splice(dataNo, 1);
//         if (dataSJ.length < 1) {
//             let isiTabelKosong = /*html*/ `
//                             <tr style="text-align:center">
//                                                 <td colspan="10">Silahkan Ditambahkan</td>
//                                             </tr>
//                         `;
//             $("#bodyCustomers").html(isiTabelKosong);
//         } else {
//             $("#bodyCustomers").html(datas);
//         }
//     });
// });

// window.addEventListener('load', function (e) {
//     let lastItems = items.pop();
//     console.log(lastItems);
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     getDoDtl(lastItems);
//  })