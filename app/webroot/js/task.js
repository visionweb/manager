/**
 * Created with JetBrains PhpStorm.
 * User: visionweb
 * Date: 12/07/13
 * Time: 09:46
 * To change this template use File | Settings | File Templates.
 */
var statutTask = {
    popupID : 'tmpPopup458',
    init: function(){
        $('body').append('<div id="'+statutTask.popupID+'" class="modal hide fade" style="width:200px; padding-left:5px"></div>');
        $("#"+statutTask.popupID).hide();
        $(".btnStatut").click(function(){
            var url=$(this).attr('rel');
            manager.ajaxRequest(url,{},function(html){
                manager.popup(html,statutTask.popupID);
            });
        });
    }
}

$(document).ready(function(){ statutTask.init(); });