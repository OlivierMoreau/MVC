$(document).ready(function () {
	$('#mainTable').DataTable();
	$('button.modifCol').click(function () {
		var id = $(this).data('id');
		$('#id').val(id);
	});
});
