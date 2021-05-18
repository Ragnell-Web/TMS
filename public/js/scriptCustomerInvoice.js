$(".invoice").on("click", function (e) {
    let dataId = $(this).data("id");
    function showData(data) {
        $("input[name='noinvoice']").val(data[0]["invoice"]);
        $("input[name='inv_type']").val(data[0]["inv_type"]);
        $("input[name='source']").val(data[0]["source"]);
        $("input[name='custcode']").val(data[0]["custcode"]);

        $("input[name='period']").val(data[0]["period"]);
        $("input[name='written']").val(data[0]["written"]);
        $("input[name='company']").val(data[0]["company"]);

        $("input[name='reff_no']").val(data[0]["reff_no"]);
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
            const addBtn = document.querySelectorAll(".btn.btn-info");
            addBtn.forEach(btn => {
                btn.addEventListener("click", function (e) {
                    let dataInvoice = data[0]["invoice"];
                    let company = data[0]["company"];
                    let custcode = data[0]["custcode"];
                    $('input[name="custcode"]').val(custcode);
                    $('input[name="company"]').val(company);
                    $('input[name="invoice"]').val(dataInvoice);
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    $.post("acc/sj", { cust_id: custcode }, function (dataSJ) {
                        let i = 1;
                        let datas = dataSJ
                            .map((SJ) => {
                                return /*html*/ `
                      <tr style="text-align:center">
                        <td>${i++}</td>
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
                                <input class="form-check-input" type="checkbox" value="${
                                    SJ["do_no"]
                                }" id="yesorno">
                                <label class="form-check-label" for="yesorno">
                                    Yes
                                </label>
                            </div>
                        </td>
                      </tr>
                    `;
                            })
                            .join("");
                        if (dataSJ == null) {
                            let isiTabelKosong = /*html*/ `
                            <tr style="text-align:center">
                                                <td colspan="10">Silahkan Ditambahkan</td>
                                            </tr>
                        `;
                            $("#bodyCustomers").html(isiTabelKosong);
                        } else {
                            $("#bodyCustomers").html(datas);
                        }
                        const saveBtn = document.querySelector('#saveBtn');
                        saveBtn.addEventListener('click', function (e) {
                            const checkBoxs = document.querySelectorAll(".form-check-input");
                            checkBoxs.forEach(checkBox => {
                                console.log(checkBox);
                            })
                         })
                    });
                });
            })

        }
    );
});
