$("#btngotocashier").click(function(){
    window.location.href = "/cashier/";
});
$("#btnprint").click(function(){
    $.ajax({
        url:'/cashier/saveall',
    })
    .done(function(res){
        console.log("Success save transaction",res);
        window.location.href = "/cashier/kwitansi"
    })
    .fail(function(err){
        alert("Err saveall"+err);
        console.log("Error save transaction",err);
    });
});