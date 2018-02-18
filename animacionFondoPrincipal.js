/*$(document).ready(function() {
	$("#video-background").animate({left: "500px"},5000);


});
*/
window.onload=function(){
    var div=document.getElementById("video-background");
    var pos=0;
    setInterval(function(){
        pos=(pos+3)%400;
        div.style.backgroundPosition=pos+"px 0px";
    },30);
}
