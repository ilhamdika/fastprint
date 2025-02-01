<h1>hi</h1>

<script>
	landing();

	function landing() {
		$.ajax({
			url: '<?= base_url('index.php/Welcome/landing'); ?>',
			type: 'POST',
			data: {},
			success: function (data) {
				console.log(data);
			}

		})
	}
</script>