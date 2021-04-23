/**
 * Created by   :  Muhammad Yasir
 * Project Name : shalmi
 * Product Name : PhpStorm
 * Date         : 10-May-16 1:05 PM
 * File Name    :
 */
$(document).ready(function() {
    var from = $('#from');
    var to = $('#to');
    from.daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3",
        format: 'YYYY/MM/DD'
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
    from.on('hide.daterangepicker', function(ev, picker) {
        //do something, like clearing an input

        to.data('daterangepicker').setStartDate(from.val());
        to.data('daterangepicker').setMinDate(from.val());
    });

    to.daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3",
        format: 'YYYY/MM/DD'
    }, function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
    });
    to.on('hide.daterangepicker', function(ev, picker) {
        //do something, like clearing an input
        from.data('daterangepicker').setStartDate(from.val());
        from.data('daterangepicker').setMinDate(from.val());
    });

    $('[data-toggle="confirmation"]').confirmation()
});
