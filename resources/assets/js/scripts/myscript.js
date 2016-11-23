function logout() {
    window.location.href = "logout";
}


function goBack() {
    window.history.back();
}

function dom_counter_employee()
{
    $("#myTable tr").remove();
    var shift = $('#shift').val(),
        area = "domestic counter";
            $.ajax({
            type: 'POST',
            url: "domestic_counter/unassigned/2016-11-14",
            data: {selected_shift: shift},
            success: function(result){
                $('#myTable').append("<table id='myTable'><tr><td>Employee Name</td><td>Code</td></tr>" + result + "</table>" );
                //$('#myTable').after("<tr>"+result+"</tr>");
            //    item.append("<option value=''>Choose from list</option>" + result)
            }
        });
};


function add_counter_unassigned()
{

    var selected_counter = $('#counter').val();
            $.ajax({
             type: 'GET',
             url: "add_counter_unassigned",
             data: {selected_counter: selected_counter},
            success: function(result){
               alert(result);
            }
        });
}

//CLOCK

tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
    var d=new Date();
    var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
    if(nyear<1000) nyear+=1900;
    var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

    if(nhour==0){ap=" AM";nhour=12;}
    else if(nhour<12){ap=" AM";}
    else if(nhour==12){ap=" PM";}
    else if(nhour>12){ap=" PM";nhour-=12;}

    if(nmin<=9) nmin="0"+nmin;
    if(nsec<=9) nsec="0"+nsec;

    document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
    GetClock();
    setInterval(GetClock,1000);
}
