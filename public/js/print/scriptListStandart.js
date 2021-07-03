setInterval(function () {
    const p = document.querySelector(".dateNow");
    const tgl = new Date().format("M d, Y h:i:s");
    p.innerHTML = tgl;
}, 1000);

$("#downloadBtn").click(function () {
    window.print();
});
