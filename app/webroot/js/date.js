/**
 * Created with JetBrains PhpStorm.
 * User: visionweb
 * Date: 14/08/13
 * Time: 12:12
 * To change this template use File | Settings | File Templates.
 */

var dateInv={
    init: function(){
        $("#from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#to").datepicker("option","minDate",selectedDate );
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            onClose: function(selectedDate) {
                $("#from").datepicker("option","maxDate",selectedDate );
            }
        });
    }
}

$(document).ready(function(){ dateInv.init(); });