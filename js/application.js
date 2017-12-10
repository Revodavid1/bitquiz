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
        var selectedstud = $('#studstoreg option:selected');
        if (selectedstud.length == 0) {
            alert("No student selected");
            e.preventDefault();
        }
        $('#studsreg').append($(selectedstud).clone());
        $(selectedstud).remove();
        e.preventDefault();
    });
    $('#unregLeft').click(function (e) {
        var selectedstud = $('#studsreg option:selected');
        if (selectedstud.length == 0) {
            alert("No student selected");
            e.preventDefault();
        }
        $('#studstoreg').append($(selectedstud).clone());
        $(selectedstud).remove();
        e.preventDefault();
    });
}(jQuery));
