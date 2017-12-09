$(document).ready(function(){
	$('.editinstr').click(function(){
		var coursecode = $(this).attr('crs');
		var crsid = $(this).attr('crsid');
		$('#crsname-display').text(coursecode);
		$('#crsid-display').text(crsid);
		$('#chginstrModal').modal();
		return false;
	});
	
	$('.setquiz').click(function(){
		var course = $(this).attr('crsset');
		var courseid = $(this).attr('crssetid');
		$('#course-display').text(course);
		$('#courseid-display').text(courseid);
		$('#chgQuizno').modal();
		return false;
	});
	$('.setlockerbtn').click(function(){
		var lckid = $(this).attr('lckid');
		$('#lckid-display').text(lckid);
		$('#setLocker').modal();
		return false;
	});
});


(function () {
    $('#regRight').click(function (e) {
        var selectedOpts = $('#studstoreg option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#studsreg').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#unregLeft').click(function (e) {
        var selectedOpts = $('#studsreg option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#studstoreg').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
}(jQuery));
