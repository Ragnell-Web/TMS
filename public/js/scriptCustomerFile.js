const custcode = document.querySelector("#custcode2");
const cus_group = document.querySelector("#cus_group2");
const date = document.querySelector("#date2");
const branch = document.querySelector("#branch2");
const addBtn = document.querySelector("#addBtn");
const editBtn = document.querySelector("#editBtn");
const addItem = document.querySelector("#addItem");
const editItem = document.querySelector("#editItem");
const deleteItem = document.querySelector("#deleteItem");
const divCusgroupAddModal = document.querySelector("#divCusgroup");
const divCusgroupEditModal = document.querySelector("#divCusgroup2");
const inputModals = [...document.querySelectorAll(".inputModal")];
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

//date
const tgl = new Date();
const day = tgl.getDate();
const month = tgl.getMonth();
const year = tgl.getFullYear();

addItem.addEventListener("click", function (e) {
    custcode.value = "";
    custcode.disabled = false;
    inputModals.forEach((inputModal) => (inputModal.disabled = true));
    date.value = "";
    branch.value = "";
    const element = /*html*/ `
            <input type="text" name="cus_group2" class="form-control form-control-sm inputModal cus_group2" id="cus_group2" disabled>
    `;
    $("#divCusgroup").html(element);
});

custcode.addEventListener("keyup", function (e) {
    if (this.value) {
        if (e.keyCode == 13) {
            ajaxSetup;
            $.post("customer_file/getCustomer", function (data) {
                for (let i = 0; i < data.length; i++) {
                    if (e.target.value.toUpperCase() == data[i].custcode) {
                        alert("Custcode sudah ada");
                        $("#exampleModal1").modal("hide");

                        $.post(
                            "customer_file/getCustomerWhereCustcode",
                            {
                                custcode: e.target.value.toUpperCase(),
                            },
                            function (data) {
                                $("#custcode").val(data.custcode);
                                $("#cus_group").val(data.cus_group);
                                $("#branch").val(data.branch);
                                $("#warehouse").val(data.warehouse);
                                $("#company").val(data.company);
                                $("#pt").val(data.industry);
                                $("#date").val(data.entered);
                                $("#contact").val(data.contact);
                                $("#address1").val(data.address1);
                                $("#do_addr1").val(data.do_addr1);
                                $("#address2").val(data.address2);
                                $("#do_addr2").val(data.do_addr2);
                                $("#address3").val(data.address3);
                                $("#do_addr3").val(data.do_addr3);
                                $("#address4").val(data.address4);
                                $("#do_addr4").val(data.do_addr4);
                                $("#phone").val(data.phone);
                                $("#fax").val(data.fax);
                                $("#glar").val(data.glar);
                                $("#hp").val(data.hp);
                                $("#npwp").val(data.npwp);
                                $("#pl_by").val(data.pl_by);
                                $("#email").val(data.email);
                                $("#termofpay").val(data.termofpay);
                                $("#term_dn").val(data.term_dn);
                            }
                        );
                    } else {
                        inputModals.forEach((inputModal) => {
                            inputModal.disabled = false;
                        });
                        custcode.disabled = true;
                        document.querySelector("#cus_group2").disabled = false;
                        date.value = `${year}-${month + 1}-${day}`;
                        branch.value = "HO";
                    }
                }
            });
        }
    }
});

divCusgroupAddModal.addEventListener("keyup", function (e) {
    if (!e.target.classList.contains("cus_group2")) return;
    const element = /*html*/ `
                <select class="form-select inputModal" id="cus_group2" aria-label="Default select example">
                    <option value="00" selected>00 OTOMATIF - ISI</option>
                    <option value="10">10 OTOMATIF - NON ISI</option>
                    <option value="90">90 LAIN - LAIN</option>
                    <option value="SC">SC - SUBCON SUPLIER</option>
                </select>
    `;
    $("#divCusgroup").html(element);
});

addBtn.addEventListener("click", function (e) {
    const custcode = $("#custcode2").val().toUpperCase();
    const cus_group =
        document.querySelector("#cus_group2").options[
            document.querySelector("#cus_group2").selectedIndex
        ].value;
    const branch = $("#branch2").val();
    const warehouse = $("#warehouse2").val();
    const company = $("#company2").val().toUpperCase();
    const pt = $("#pt2").val().toUpperCase();
    const date = $("#date2").val();
    const contact = $("#contact2").val().toUpperCase();
    const address1 = $("#address1_2").val();
    const do_addr1 = $("#do_addr1_2").val();
    const address2 = $("#address2_2").val();
    const do_addr2 = $("#do_addr2_2").val();
    const address3 = $("#address3_2").val();
    const do_addr3 = $("#do_addr3_2").val();
    const address4 = $("#address4_2").val();
    const do_addr4 = $("#do_addr4_2").val();
    const phone = $("#phone2").val();
    const fax = $("#fax2").val();
    const glar = $("#glar2").val();
    const hp = $("#hp2").val();
    const npwp = $("#npwp2").val();
    const price_by = document.querySelector("#pl_by2");
    const pl_by = price_by.options[price_by.selectedIndex].value;
    const email = $("#email2").val();
    const termofpay = $("#termofpay2").val();
    const term_dn = $("#term_dn2").val();
    ajaxSetup;
    $.post(
        "customer_file/create",
        {
            custcode,
            cus_group: cus_group,
            branch,
            warehouse,
            company,
            pt,
            entered: date,
            contact,
            address1,
            do_addr1,
            address2,
            do_addr2,
            address3,
            do_addr3,
            address4,
            do_addr4,
            phone,
            fax,
            glar,
            hp,
            npwp,
            pl_by,
            email,
            termofpay,
            term_dn,
        },
        function (data) {
            $("#custcode").val(data.custcode);
            $("#cus_group").val(data.cus_group);
            $("#branch").val(data.branch);
            $("#warehouse").val(data.warehouse);
            $("#company").val(data.company);
            $("#pt").val(data.industry);
            $("#date").val(data.entered);
            $("#contact").val(data.contact);
            $("#address1").val(data.address1);
            $("#do_addr1").val(data.do_addr1);
            $("#address2").val(data.address2);
            $("#do_addr2").val(data.do_addr2);
            $("#address3").val(data.address3);
            $("#do_addr3").val(data.do_addr3);
            $("#address4").val(data.address4);
            $("#do_addr4").val(data.do_addr4);
            $("#phone").val(data.phone);
            $("#fax").val(data.fax);
            $("#glar").val(data.glar);
            $("#hp").val(data.hp);
            $("#npwp").val(data.npwp);
            $("#pl_by").val(data.pl_by);
            $("#email").val(data.email);
            $("#termofpay").val(data.termofpay);
            $("#term_dn").val(data.term_dn);
        }
    );
});

editItem.addEventListener("click", function (e) {
    inputModals.forEach((inputModal) => {
        inputModal.disabled = false;
    });
    const custcode3 = document.querySelector("#custcode3");
    custcode3.disabled = true;
    const custcode = $("#custcode").val();
    const cus_group = document.querySelector("#cus_group");
    const branch = $("#branch").val();
    const warehouse = $("#warehouse").val();
    const company = $("#company").val();
    const pt = $("#pt").val();
    const date = $("#date").val();
    const contact = $("#contact").val();
    const address1 = $("#address1").val();
    const do_addr1 = $("#do_addr1").val();
    const address2 = $("#address2").val();
    const do_addr2 = $("#do_addr2").val();
    const address3 = $("#address3").val();
    const do_addr3 = $("#do_addr3").val();
    const address4 = $("#address4").val();
    const do_addr4 = $("#do_addr4").val();
    const phone = $("#phone").val();
    const fax = $("#fax").val();
    const glar = $("#glar").val();
    const hp = $("#hp").val();
    const npwp = $("#npwp").val();
    const price_by = document.querySelector("#pl_by");
    const pl_by = price_by.options[price_by.selectedIndex].value;
    const email = $("#email").val();
    const termofpay = $("#termofpay").val();
    const term_dn = $("#term_dn").val();

    $("#custcode3").val(custcode);
    const element = /*html*/ `
            <select class="form-select inputModal" id="cus_group3" aria-label="Default select example">
                <option value="00" ${
                    cus_group.value == "00" ? "selected='selected'" : ""
                }>00 OTOMATIF - ISI</option>
                <option value="10" ${
                    cus_group.value == "10" ? "selected='selected'" : ""
                }>10 OTOMATIF - NON ISI</option>
                <option value="90" ${
                    cus_group.value == "90" ? "selected='selected'" : ""
                }>90 LAIN - LAIN</option>
                <option value="SC" ${
                    cus_group.value == "SC" ? "selected='selected'" : ""
                }>SC - SUBCON SUPLIER</option>
            </select>
    `;
    $("#divCusgroup2").html(element);
    $("#branch3").val(branch);
    $("#warehouse3").val(warehouse);
    $("#company3").val(company);
    $("#pt3").val(pt);
    $("#date3").val(date);
    $("#contact3").val(contact);
    $("#address1_3").val(address1);
    $("#do_addr1_3").val(do_addr1);
    $("#address2_3").val(address2);
    $("#do_addr2_3").val(do_addr2);
    $("#address3_3").val(address3);
    $("#do_addr3_3").val(do_addr3);
    $("#address4_3").val(address4);
    $("#do_addr4_3").val(do_addr4);
    $("#phone3").val(phone);
    $("#fax3").val(fax);
    $("#glar3").val(glar);
    $("#hp3").val(hp);
    $("#npwp3").val(npwp);
    const element2 = /*html*/ `
        <select class="form-select inputModal" id="pl_by3" aria-label="Default select example">
            <option value="S" ${
                pl_by == "S" ? "selected='selected'" : ""
            }>SO</option>
            <option value="D" ${
                pl_by == "D" ? "selected='selected'" : ""
            }>DATE</option>
        </select>
    `;
    $("#divPlby").html(element2);
    $("#email3").val(email);
    $("#termofpay3").val(termofpay);
    $("#term_dn3").val(term_dn);
});

editBtn.addEventListener("click", function (e) {
    const custcode = $("#custcode3").val().toUpperCase();
    const cus_group = document.querySelector("#cus_group3");
    const cus_groupValue = cus_group.options[cus_group.selectedIndex].value;
    const branch = $("#branch3").val();
    const warehouse = $("#warehouse3").val();
    const company = $("#company3").val();
    const pt = $("#pt3").val();
    const date = $("#date3").val();
    const contact = $("#contact3").val();
    const address1 = $("#address1_3").val();
    const do_addr1 = $("#do_addr1_3").val();
    const address2 = $("#address2_3").val();
    const do_addr2 = $("#do_addr2_3").val();
    const address3 = $("#address3_3").val();
    const do_addr3 = $("#do_addr3_3").val();
    const address4 = $("#address4_3").val();
    const do_addr4 = $("#do_addr4_3").val();
    const phone = $("#phone3").val();
    const fax = $("#fax3").val();
    const glar = $("#glar3").val();
    const hp = $("#hp3").val();
    const npwp = $("#npwp3").val();
    const price_by = document.querySelector("#pl_by3");
    const pl_by = price_by.options[price_by.selectedIndex].value;
    const email = $("#email3").val();
    const termofpay = $("#termofpay3").val();
    const term_dn = $("#term_dn3").val();
    ajaxSetup;
    $.post(
        "customer_file/update",
        {
            custcode,
            cus_group: cus_groupValue,
            branch,
            warehouse,
            company,
            pt,
            entered: date,
            contact,
            address1,
            do_addr1,
            address2,
            do_addr2,
            address3,
            do_addr3,
            address4,
            do_addr4,
            phone,
            fax,
            glar,
            hp,
            npwp,
            pl_by,
            email,
            termofpay,
            term_dn,
        },
        function (data) {
            $("#custcode").val(data.custcode);
            $("#cus_group").val(data.cus_group);
            $("#branch").val(data.branch);
            $("#warehouse").val(data.warehouse);
            $("#company").val(data.company);
            $("#pt").val(data.industry);
            $("#date").val(data.entered);
            $("#contact").val(data.contact);
            $("#address1").val(data.address1);
            $("#do_addr1").val(data.do_addr1);
            $("#address2").val(data.address2);
            $("#do_addr2").val(data.do_addr2);
            $("#address3").val(data.address3);
            $("#do_addr3").val(data.do_addr3);
            $("#address4").val(data.address4);
            $("#do_addr4").val(data.do_addr4);
            $("#phone").val(data.phone);
            $("#fax").val(data.fax);
            $("#glar").val(data.glar);
            $("#hp").val(data.hp);
            $("#npwp").val(data.npwp);
            $("#pl_by").val(data.pl_by);
            $("#email").val(data.email);
            $("#termofpay").val(data.termofpay);
            $("#term_dn").val(data.term_dn);
        }
    );
});

deleteItem.addEventListener("click", function (e) {
    e.preventDefault();
    let convincing = confirm("Yakin ingin menghapus");
    while (convincing) {
        const custcode = $("#custcode").val();
        ajaxSetup;
        $.post("customer_file/delete", { custcode }, function (data) {
            $("#custcode").val(data.custcode);
            $("#cus_group").val(data.cus_group);
            $("#branch").val(data.branch);
            $("#warehouse").val(data.warehouse);
            $("#company").val(data.company);
            $("#pt").val(data.industry);
            $("#date").val(data.entered);
            $("#contact").val(data.contact);
            $("#address1").val(data.address1);
            $("#do_addr1").val(data.do_addr1);
            $("#address2").val(data.address2);
            $("#do_addr2").val(data.do_addr2);
            $("#address3").val(data.address3);
            $("#do_addr3").val(data.do_addr3);
            $("#address4").val(data.address4);
            $("#do_addr4").val(data.do_addr4);
            $("#phone").val(data.phone);
            $("#fax").val(data.fax);
            $("#glar").val(data.glar);
            $("#hp").val(data.hp);
            $("#npwp").val(data.npwp);
            $("#pl_by").val(data.pl_by);
            $("#email").val(data.email);
            $("#termofpay").val(data.termofpay);
            $("#term_dn").val(data.term_dn);
        });
        convincing = false;
    }
});
