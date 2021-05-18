'use strict';
$(document).ready(function () {

    $('#example1').DataTable({
        responsive: true,
		pagingType: "full_numbers",
		
		
    });

    $('#example2').DataTable({
        "scrollY": "400px",
        "scrollCollapse": true
    });

});