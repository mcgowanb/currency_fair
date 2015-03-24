/**
 * Created by brian.mcgowan on 20/11/2014.
 */
function renderTime() {
    currentTime = new Date();
    var month=new Array();
    month[0]="Jan";
    month[1]="Feb";
    month[2]="Mar";
    month[3]="Apr";
    month[4]="May";
    month[5]="Jun";
    month[6]="Jul";
    month[7]="Aug";
    month[8]="Sept";
    month[9]="Oct";
    month[10]="Nov";
    month[11]="Dec";

    var day = new Array();
    day[0] = "Mon";
    day[1] = "Tue";
    day[2] = "Wed";
    day[3] = "Thu";
    day[4] = "Fri";
    day[5] = "Sat";
    day[6] = "Sun";

    var h,m,s;
    setTimeout('renderTime()',1000);
    h=currentTime.getHours();
    m=currentTime.getMinutes();
    s=currentTime.getSeconds();
    if(s<=9) s="0"+s;
    if(m<=9) m="0"+m;
    if(h<=9) h="0"+h;

    var myClock = document.getElementById('systemClock');
    myClock.textContent = day[currentTime.getDay()]+" "+currentTime.getDate()+" "+month[currentTime.getMonth()]+" " + currentTime.getFullYear()+" "+h + ":" + m + ":" + s;
}
