var test = false,originspp = 0;
numberWithCommas = function(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
removeCommas = function(myVar){
    myVar = myVar.replace(/[ ,]/g, "");
    return myVar;
}
validate = function(){
    if(!$("#psb").val()){
        $("#psb").val("0");
    }
    if(!$("#book").val()){
        $("#book").val("0");
    }
    if(!$("#bimbel").val()){
        $("#bimbel").val("0");
    }
    if(!$("#cashpay").val()){
        $("#cashpay").val("0");
    }
}
filltotal = function(){
    validate();
    var total = parseInt(removeCommas($("#spp_").val()))
        +parseInt(removeCommas($("#psb").val()))
        +parseInt(removeCommas($("#book").val()))
        +parseInt(removeCommas($("#bimbel").val()));
    $("#total").val(numberWithCommas(total));
}
fillreturnmoney = function(){
    validate();
    $("#returnmoney").val(numberWithCommas(parseInt(removeCommas($("#cashpay").val()))
        -parseInt(removeCommas($("#total").val()))));
}
togglespp = function(){
    if($("#sppcheckbox").prop("checked")){
        $("#sppmonthdiv").show();
        $("#spp_").val($("#orispp").val());
    }else{
        $("#sppmonthdiv").hide();
        $("#spp_").val(0);
    }
    filltotal();
    fillreturnmoney();
}
togglebimbel = function(){
    if($("#bimbelcheckbox").prop("checked")){
        $("#bimbelmonthdiv").show();
        $("#bimbel").val($("#oribimbel").val());
    }else{
        $("#bimbelmonthdiv").hide();
        $("#bimbel").val(0);
    }
    filltotal();
    fillreturnmoney();
}
$.fn.adjustval = function(options){
    $(this).change(function(){
        var settings = $.extend({
            firstmonth:$("#sppfrstmonth"),
            firstyear:$("#sppfrstyear"),
            nextmonth:$("#sppnextmonth"),
            nextyear:$("#sppnextyear"),
            hiddenval : $("#spp_"),
            shownval: $("#bimbel"),
            orival:$("#orival")
        },options);
        console.log("time changed");
        monthcount = 0;
        if(settings.nextyear.val()===settings.firstyear.val()){
            if(settings.nextmonth.val()===settings.firstmonth.val()){
                monthcount = 1;
            }else
            if(settings.nextmonth.val()>settings.firstmonth.val()){
                monthcount = settings.nextmonth.val() - settings.firstmonth.val() + 1;
                
            }else{
                settings.nextmonth.val(settings.firstmonth.val());
            }
        }else
        if(settings.nextyear.val()>settings.firstyear.val()){
            frsmonths = 12 - settings.firstmonth.val();
            months = 12*(settings.nextyear.val()-settings.firstyear.val() - 1);
            nextmonths = settings.nextmonth.val();
            monthcount = parseInt(frsmonths)+parseInt(months)+parseInt(nextmonths) + 1;
        }else{
            settings.nextyear.val(settings.firstyear.val());
        }
        _total = parseInt(settings.orival.val())*monthcount;
        settings.shownval.val(numberWithCommas(_total));
        settings.hiddenval.val(_total);
        filltotal();
        fillreturnmoney();
        if(test===true){
            alert(monthcount);
        };
    });
};
$.ajax({
    url:'/students/getjson',
    dataType:'json'
})
.done(function(res){
    $("#sname").focus(function(){
        $(this).select();
    });
    $('#sname').autocomplete({
        lookup: res.out,
        onSelect: function(suggestion) {
            console.log('suggestion-data',suggestion.data);
            console.log('suggestion',suggestion);
            console.log('cek status');
            $("#nis").val(suggestion.nis);
            $("#studentname").val(suggestion.name);
            $("#grade").val(suggestion.grade);
                $.ajax({
                    url:'/students/getproperties/'+suggestion.nis,
                    type:'get',
                    dataType:'Json'
                })
                .done(function(res){
                    originspp = res.spp;
                    $("#spp_").val(numberWithCommas(res.spp));
                    $("#spp").val(res.spp);
                    $("#orispp").val(res.spp);
                    $("#bimbel_").val(numberWithCommas(res.bimbel));
                    $("#bimbel").val(numberWithCommas(res.bimbel));
                    $("#oribimbel").val(res.bimbel);
                    $("#psb_").val(numberWithCommas(res.dupsbremain));
                    $("#psb").val(numberWithCommas(res.dupsbremain));
                    $("#book_").val(numberWithCommas(res.bookremain));
                    $("#book").val(numberWithCommas(res.bookremain));
                    $("#sppfrstmonth").val(res.sppmaxmonth);
                    $("#sppfrstyear").val(res.sppmaxyear);
                    $("#sppnextmonth").val(res.sppmaxmonth);
                    $("#sppnextyear").val(res.sppmaxyear);
                    $("#bimbelfrstmonth").val(res.bimbelmaxmonth);
                    $("#bimbelfrstyear").val(res.bimbelmaxyear);
                    $("#bimbelnextmonth").val(res.bimbelmaxmonth);
                    $("#bimbelnextyear").val(res.bimbelmaxyear);
                    filltotal();
                    fillreturnmoney();
                    $(".sppperiod").change();
                    $(".bimbelperiod").change();
                    console.log("SPPMAXMONTH",res.sppmaxmonth);
                    console.log("SPPMAXYEAR",res.sppmaxyear);
                });
        },
        onHint: function (hint) {
            console.log('hint',hint);
        },
        onInvalidateSelection: function() {
        }
    });
})
.fail(function(err){
    console.log("Error fetch json",err);
});
$("#cashpay").keyup(function(){
    fillreturnmoney()
});
$("#cashpay").focus(function(){
    $(this).select();
})
$("#cashpay").blur(function(){
    $(this).val(numberWithCommas($(this).val()));
})
$(".affect-total").focus(function(){
    $(this).val(removeCommas($(this).val().toString()));
    $(this).select();
})
$(".formatted").blur(function(){
    $(this).val(numberWithCommas($(this).val().toString()));
})
togglespp();
$("#sppcheckbox").change(function(){
    togglespp();
})
togglebimbel();
$("#bimbelcheckbox").change(function(){
    togglebimbel();
});
$(".affect-total").keyup(function(){
    filltotal();
    fillreturnmoney();
});
$(".affect-total").change(function(){
    filltotal();
    fillreturnmoney();
});
$(".bimbelperiod").adjustval({
    firstmonth:$("#bimbelfrstmonth"),
    firstyear:$("#bimbelfrstyear"),
    nextmonth:$("#bimbelnextmonth"),
    nextyear:$("#bimbelnextyear"),
    hiddenval : $("#bimbel"),
    shownval: $("#bimbel_"),
    orival: $("#oribimbel")
});
$(".sppperiod").adjustval({
    firstmonth:$("#sppfrstmonth"),
    firstyear:$("#sppfrstyear"),
    nextmonth:$("#sppnextmonth"),
    nextyear:$("#sppnextyear"),
    hiddenval : $("#spp"),
    shownval: $("#spp_"),
    orival: $("#orispp")
});