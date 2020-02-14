<script type="text/x-template" id="search-template">
	<div class="col-sm-12 col-md-3 offset-md-1 bg-white p-3">
		<h1>Prenota alloggi e attività unici.</h1>
		<form>
			<div class="form-group">
				<label>Dove</label>
				<input type="text" class="form-control">
			</div>
			<div class="form-group">
				<div class="form-row">
					<div class="col-6">
						<label>Check-in</label>
						<input type="date" class="form-control">
					</div>
					<div class="col-6">
						<label>Check-out</label>
						<input type="date" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Ospiti</label>
				<select class="form-control">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Cerca</button>
			</div>
		</form>
	</div>
</script>

<script type="text/javascript">

	Vue.component('apartmentsearch', {

			template: "#search-template",
			data: function() {
					return {

					};
			},
			methods: {

			},
			computed: {

			}
	});

</script>