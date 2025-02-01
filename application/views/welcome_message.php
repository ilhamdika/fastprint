<h1>hi</h1>

<script>
	landing();

	function landing() {
		$.ajax({
			url: '<?= base_url('data/get_data'); ?>',
			type: 'GET',
			success: function (data) {
				console.log(data);
			}

		})
	}
</script>