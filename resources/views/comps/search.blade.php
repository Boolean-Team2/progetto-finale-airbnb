<script type="text/x-template" id="search-template">
	<div class="col-sm-12 col-md-10 col-lg-4 offset-md-1 bg-white p-3">
		<h1 class="mb-3">Apartment Search</h1>
		<form>
			<div class="form-row">
				<div class="col-sm-12 col-md-9">
					<input type="text" class="form-control" placeholder="Where do you want to go ?">
				</div>
				<div class="col-sm-12 col-md-3">
					<button type="submit" class="btn btn-primary w-100">Search</button>
				</div>
			</div>

			{{-- <div class="form-group">
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
			</div> --}}
			
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