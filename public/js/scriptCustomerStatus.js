const updateItem = document.querySelector("#updateItem");
const ar_update = document.querySelector("#ar_update");
const recalcItem = document.querySelector('#recalcItem');
const ajaxSetup = $.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

window.onload = () => { ar_update.value = '' };

updateItem.addEventListener("click", function (e) {
    ajaxSetup;
    $.post("customer_status/update", { ar_update: ar_update.value });
});

recalcItem.addEventListener('click', function (e) {
    let recalcNow = confirm('Recalc Customer Status Now ?');
    while (recalcNow) {
        
        recalcNow = false;
    }
 })
