<!-- Content Header (Page header) -->
<section class="content-header">
	<!-- page title -->
	<h1>
	Quản lý Map Location
	</h1>
	<!-- /.page title -->
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<?php echo $this->Flash->render(); ?>
	<div class="form-horizontal form-label-left">
		<?php echo $this->Form->create('Map', array(
			'url' =>'add',
			'class' => 'form-horizontal form-label-left', 
			'role' => 'form',
			'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control col-md-10'),
			'label' => array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label'),
			'between' => '<div class="col-md-4 col-sm-3 col-xs-12">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
			))); 
		?>
		<?php echo $this->Form->input('address');
			echo $this->Form->input('title_marker',
				 array('label' => array(
                   'text'=> 'Title marker','class' =>'col-md-2 col-sm-2 col-xs-12 control-label'))
				 );
		?>
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
				<?php echo $this->Form->submit('Thêm mới', array('class' => 'btn btn-success', 'title' => 'Cập nhật')); ?>
			</div>  
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
	<!-- datatable -->
	<table id="datatable" class="table table-bordered">
		<thead>
			<tr>
				<th>Location</th>
				<th>Title Marker</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($data as $key => $value) {
					//print_r($value);
					echo '<tr role="row" class="odd">
						<td>'.$value['Map']['address'].'</td>
						<td>'.$value['Map']['title_marker'].'</td>
						<td>'.$value['Map']['lat'].'</td>
						<td>'.$value['Map']['lng'].'</td>
						<td><a href="'.$this->Html->Url(array('controller' => 'maps', 'action' => 'edit')).'/'.$value['Map']['id'].'" class="btn btn-xs btn-success mr10"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a><a href="'.$this->Html->Url(array('controller' => 'maps', 'action' => 'delete')).'/'.$value['Map']['id'].'" onclick="return confirm(&quot;Bạn chắc chắn xóa user admin này?&quot;);" class="btn btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
						</td>
					</tr>';
				}
			?>
		</tbody>
	</table>
	<!-- /.datatable -->
</section>
<script>
	var placeSearch, autocomplete;
	var componentForm = {
	street_number: 'short_name',
	route: 'long_name',
	locality: 'long_name',
	administrative_area_level_1: 'short_name',
	country: 'long_name',
	postal_code: 'short_name'
	};

	function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical
	// location types.
	autocomplete = new google.maps.places.Autocomplete(
	    /** @type {!HTMLInputElement} */(document.getElementById('MapAddress')),
	    {types: ['geocode']});

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	}

	$(document).ready(function(){
		$('#MapAddress').on('focus', function(){
			geolocate();
		});
	}); 

	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
	    var geolocation = {
	      lat: position.coords.latitude,
	      lng: position.coords.longitude
	    };
	    var circle = new google.maps.Circle({
	      center: geolocation,
	      radius: position.coords.accuracy
	    });
	    autocomplete.setBounds(circle.getBounds());
	  });
	}
	}
</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2Riaht4lJlkTwPjoYAlCVbcvpGIEZgXA&libraries=places&callback=initAutocomplete"
	async defer>
</script>

