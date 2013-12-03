var vwPasswd = {
    init: function(){
       $("table#passtable tr").hover(function(){
           var id=parseInt($(this).attr('rel'));
           $(this).find("td #passhide-"+id).hide();
           $(this).find("td #passshow-"+id).show();
       },function(){
           var id=parseInt($(this).attr('rel'));
           $(this).find("td #passhide-"+id).show();
           $(this).find("td #passshow-"+id).hide();
       });
    }
}

var allPasswd = {
    init: function(){
        $("#btnPassword").click(function(){
            //document.getElementById("btnPassword").innerHTML ="bienvenue";
            $(".passShow").show();
            $(".passHide").hide();
        });
    }
}

$(document).ready(function(){ vwPasswd.init(); });
$(document).ready(function(){ allPasswd.init(); });