getmonthamount = function(firstmonth,firstyear,nextmonth,nextyear){
    var monthcount = 0;
    if(nextyear.val()===firstyear.val()){
        if(nextmonth.val()===firstmonth.val()){
            monthcount = 1;
        }else
        if(nextmonth.val()>firstmonth.val()){
            monthcount = nextmonth.val() - firstmonth.val() + 1;
            
        }else{
            alert("Bulan Kedua harus lebih besar dari bulan Pertama");
        }
    }else
    if(settings.nextyear.val()>settings.firstyear.val()){
        frsmonths = 12 - firstmonth.val();
        months = 12*(nextyear.val()-firstyear.val() - 1);
        nextmonths = nextmonth.val();
        monthcount = parseInt(frsmonths)+parseInt(months)+parseInt(nextmonths) + 1;
    }else{
        alert("Tahun kedua tidak boleh kurang tahun pertama");
    }

}