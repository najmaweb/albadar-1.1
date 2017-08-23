$("#btngotocashier").click(function(){
    window.location.href = "/simulator/";
});
$("#btnprint").click(function(){
    $.ajax({
        url:'/simulator/saveall',
    })
    .done(function(res){
        console.log("Success save transaction",res);
        window.location.href = "/simulator/kwitansi"
    })
    .fail(function(err){
        alert("Err saveall"+err);
        console.log("Error save transaction",err);
    });
});