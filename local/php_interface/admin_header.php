<?php CJSCore::Init( 'jquery' ); ?>

<script>
	function analysis_links(id) {
		$.ajax({
			type: 'POST',
			url: '/local/tools/links_analysis.php',
			data: { id: id },
			success: function(data) {
				alert(data);
			},
			error: function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
		});
	}

	function set_links(id) {
		$.ajax({
			type: 'POST',
			url: '/local/tools/links.php',
			data: { id: id },
			success: function(data) {
				alert(data);
			},
			error: function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
		});
	}

	function delete_links(id) {
		$.ajax({
			type: 'POST',
			url: '/local/tools/links_delete.php',
			data: { id: id },
			success: function(data) {
				alert(data);
			},
			error: function(xhr, str){
				alert('Возникла ошибка: ' + xhr.responseCode);
			}
		});
	}
</script>

