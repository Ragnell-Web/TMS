const addRow = document.querySelector('#addRow');

$('.invoice').on('click', function (e) {
  let dataId = $(this).data('id');
  console.log(dataId);
})

addRow.addEventListener('click', function (e) {
  if (!$('input[name="custcode"]').val()) {
    console.log('hai');

    $(".modal.fade.satu").hide();
    $(".modal.fade.dua").show();
  }
 })

