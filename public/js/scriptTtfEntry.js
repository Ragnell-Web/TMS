// const addRow = document.querySelector('#addRow');
const trLama = document.querySelector('.tableTtf');
const tBody = document.querySelector("#ttfArlBody");
const saveBtn = document.querySelector('#saveBtn');
const editBtn = document.querySelector('#editBtn')

window.addEventListener('load', function (e) {
  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });
  $.post('ttf_entry', function (data) {
    $("input[name='ttfNo']").val(Number(data[0]["ttf_no"]));
   })
 })

$('.invoice').on('click', function (e) {
  let dataId = $(this).data('id');
  console.log(dataId);
  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });
  $.post("ttf_entry/customer", { id: dataId }, function (data) {
    $('input[name="custcode"]').val(data[0]['custcode']);
    $('input[name="company"]').val(data[0]["company"]);
  });
})

saveBtn.addEventListener("click", function (e) {
  const ttf_no = $('#ttfNo').val();
  const date = $('#date').val();
  const valas = $('#valas').val();
  const invoice = $('#invNo').val();
  const ref_no = $('#refNo').val();
  const tax_no = $('#taxNo').val();
  const kw_no = $('#kwNo').val();
  const inv_due = $('#due').val();
  const amount_tot = $("#totAmount").val();
  const custcode = $('input[name="custcode"]').val();
  const company = $('input[name="company"]').val();
  const remark = $('#remark').val();
  const operator = $("#staff_create_stin").val();
  const dollar = $("#dollar").val();
  $("input[name='ttfNo']").val(Number(ttf_no) + 1);
  if (!$('input[name="custcode"]').val() && !$('input[name="company"]').val()) {
      $("#exampleModal2").modal("show");
  } else {
    // this.dataset.bsDismiss = "modal";
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post(
        "ttf_entry/add",
        {
            ttf_no,
            received: date,
            valas,
            invoice,
            ref_no,
            tax_no,
            kw_no,
            inv_date: date,
            inv_due,
            amount_tot,
            custcode,
            company,
            remark,
            operator,
            dollar
        },
      function (data) {

        const element = /*html*/ `
                            <td></td>
                            <td>${data[0]["invoice"]}</td>
                            <td>${data[0]["ref_no"]}</td>
                            <td>${data[0]["tax_no"]}</td>
                            <td>${data[0]["kw_no"]}</td>
                            <td>${data[0]["inv_date"]}</td>
                            <td>${data[0]["inv_due"]}</td>
                            <td>${data[0]["valas"]}</td>
                            <td>${data[0]["amount_tot"]}</td>

    `;
        const trBaru = document.createElement("tr");
        trBaru.style.textAlign = 'center';
            trBaru.innerHTML = element;
            tBody.appendChild(trBaru);
        }
    );
  }
});

editBtn.addEventListener('click', function (param) {
  const ttf_no = $("#ttfNo").val();
  const date = $("#date").val();
  const valas = $("#valas").val();
  const invoice = $("#invNo").val();
  const ref_no = $("#refNo").val();
  const tax_no = $("#taxNo").val();
  const kw_no = $("#kwNo").val();
  const inv_due = $("#due").val();
  const amount_tot = $("#totAmount").val();
  const custcode = $('input[name="custcode"]').val();
  const company = $('input[name="company"]').val();
  const remark = $("#remark").val();
  const operator = $("#staff_create_stin").val();
  const dollar = $("#dollar").val();
  if (!$('input[name="custcode"]').val() && !$('input[name="company"]').val()) {
      $("#exampleModal2").modal("show");
  } else {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.post(
        "ttf_entry/update",
        {
            ttf_no,
            received: date,
            valas,
            invoice,
            ref_no,
            tax_no,
            kw_no,
            inv_date: date,
            inv_due,
            amount_tot,
            custcode,
            remark,
            operator,
            dollar,
        },
        function (data) {
    //         const element = /*html*/ `
    //                         <td></td>
    //                         <td>${data[0]["invoice"]}</td>
    //                         <td>${data[0]["ref_no"]}</td>
    //                         <td>${data[0]["tax_no"]}</td>
    //                         <td>${data[0]["kw_no"]}</td>
    //                         <td>${data[0]["inv_date"]}</td>
    //                         <td>${data[0]["inv_due"]}</td>
    //                         <td>${data[0]["valas"]}</td>
    //                         <td>${data[0]["amount_tot"]}</td>

    // `;
    //         const trBaru = document.createElement("tr");
    //         trBaru.style.textAlign = "center";
    //         trBaru.innerHTML = element;
    //         tBody.appendChild(trBaru);
        }
    );
  }
 })

// addRow.addEventListener('click', function (e) {
  // if (
  //     !$('input[name="custcode"]').val() &&
  //     !$('input[name="company"]').val()
  // ) {
  //   $("#exampleModal2").modal("show");
  //   this.dataset.bsDismiss = "";
  //     console.log("hai");
  // } else {
//     const valDate = $('input[name="date"]').val();
    // const element = /*html*/ `

    //                         <td><input type="text" style="width:50px;" class="form-control form-control-sm" disabled></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm"></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm"></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm"></td>
    //                         <td><input type="text" style="width:200px;" class="form-control form-control-sm"></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm" value="${valDate}"></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm"></td>
    //                         <td><input type="text" style="width:50px;" class="form-control form-control-sm" disabled></td>
    //                         <td><input type="text" style="width:150px;" class="form-control form-control-sm"></td>

    // `;
    // const trBaru = document.createElement('tr');
    // trBaru.innerHTML = element;
    // tBody.appendChild(trBaru)
//   }
// })



