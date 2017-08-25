$("#btngotocashier").click(function(){
    window.location.href = "/receipts/index";
});
$("#btnprint").click(function(){
    window.location = "/receipts/kwitansi/"+receiptid;
});