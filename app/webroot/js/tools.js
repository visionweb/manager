/**
 * Created with JetBrains PhpStorm.
 * User: visionweb
 * Date: 12/07/13
 * Time: 09:19
 * To change this template use File | Settings | File Templates.
 */

var manager = {
    ajaxRequest: function(url, postVars, callback){
        if(postVars==undefined) postVars={};
        postVars.isAjax=1;
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: url,
            data: postVars,
            success: function(datas){
                if (callback != undefined)
                    callback(datas);
            }
        });
    },

    popup: function(html, id){
        $("#"+id).html(html);
        $("#"+id).modal({
            keyboard: true,
            backdrop: true,
            show: true
        })
    }
}
