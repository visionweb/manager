/**
 * Created with JetBrains PhpStorm.
 * User: visionweb
 * Date: 08/07/13
 * Time: 15:26
 * To change this template use File | Settings | File Templates.
 */
var statutInv = {
    popupID : 'tmpPopup457',
    init: function(){
        $('body').append('<div id="'+statutInv.popupID+'" class="modal hide fade" style="width:200px; padding-left:5px"></div>');
        $("#"+statutInv.popupID).hide();
        $(".btnStatut").click(function(){
            var url=$(this).attr('rel');
            manager.ajaxRequest(url,{},function(html){
                manager.popup(html,statutInv.popupID);
            });
        });
    }
}



$(document).ready(function(){ statutInv.init(); });