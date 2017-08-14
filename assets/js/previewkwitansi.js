$("#btngotocashier").click(function(){
    window.location.href = "/cashier/index";
});
$("#btnprint").click(function(){
    $.ajax({
        url:'/cashier/saveall',
        data:{
            "sppfrstmonth":$("#sppfrstmonth").val(),
            "sppfrstyear":$("#sppfrstyear").val(),
            "sppnextmonth":$("#sppnextmonth").val(),
            "sppnextyear":$("#sppnextyear").val(),
            "nis":$("#nis").val(),
            "spp":$("#spp").val(),
            "bimbel":$("#bimbel").val(),
            "bimbelfrstyear":$("#bimbelfrstyear").val(),
            "bimbelfrstmonth":$("#bimbelfrstmonth").val(),
            "bimbelnextmonth":$("#bimbelnextmonth").val(),
            "bimbelnextyear":$("#bimbelnextyear").val(),
            "psb":$("#psb").val(),
            "book":$("#book").val(),
            "orispp":$("#orispp").val(),
            "oribimbel":$("#oribimbel").val(),
        },
        type:'post'
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