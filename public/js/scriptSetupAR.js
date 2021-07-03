const btnCollection = document.querySelector(".btnCollection");
const editItem = document.querySelector("#editItem");
const printDiv = document.querySelector(".printDiv");
const editDiv = document.querySelector(".editDiv");
const receivableARValue = document.querySelector("#receivableAR").value;
const financeFINValue = document.querySelector("#financeFIN").value;
const salesOrderValue = document.querySelector("#salesOrder").value;
const salesForecastValue = document.querySelector("#salesForecast").value;
const suratJalanValue = document.querySelector("#suratJalan").value;

const setBtn = function (idBtn, parentElement, innerData) {
    const btn = /*html*/ `
    <a href="#" class="btn btn-primary btn-round" id="${idBtn}">${innerData}</a>
  `;
    parentElement.innerHTML = btn;
};

btnCollection.addEventListener('click', function (e) {
  if (!e.target.id === "editItem") return;
  const dateInput = document.querySelectorAll(".dateInput");
  dateInput.forEach((date) => (date.disabled = false));

  setBtn("okBtn", printDiv, "Ok");
  setBtn("cancelBtn", editDiv, "Cancel");
 })

btnCollection.addEventListener("click", function (e) {
    if (e.target.id === "okBtn") {
        const dateInput = document.querySelectorAll(".dateInput");
      dateInput.forEach((date) => (date.disabled = true));

      const receivableAR = document.querySelector("#receivableAR");
      const financeFIN = document.querySelector("#financeFIN");
      const salesOrder = document.querySelector("#salesOrder");
      const salesForecast = document.querySelector("#salesForecast");
      const suratJalan = document.querySelector("#suratJalan");

      $("#receivableAR").val(receivableAR.value);
      $("#financeFIN").val(financeFIN.value);
      $("#salesOrder").val(salesOrder.value);
      $("#salesForecast").val(salesForecast.value);
      $("#suratJalan").val(suratJalan.value);

      setBtn("printItem", printDiv, "Print Item");
      setBtn("editItem", editDiv, "Edit Item");
    }
});

btnCollection.addEventListener("click", function (e) {
    if (e.target.id === "cancelBtn") {
        const dateInput = document.querySelectorAll(".dateInput");
        dateInput.forEach((date) => (date.disabled = true));

        $("#receivableAR").val(receivableARValue);
        $("#financeFIN").val(financeFINValue);
        $("#salesOrder").val(salesOrderValue);
        $("#salesForecast").val(salesForecastValue);
        $("#suratJalan").val(suratJalanValue);

        setBtn("printItem", printDiv, "Print Item");
        setBtn("editItem", editDiv, "Edit Item");
    }
});
