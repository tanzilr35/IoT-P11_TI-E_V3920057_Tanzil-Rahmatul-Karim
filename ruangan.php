<?php include('db_connect.php'); ?>

<div class="container-fluid">

	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
				<form action="" id="manage-ruangan">
					<div class="card">
						<div class="card-header">
							Form Ruangan
						</div>
						<div class="card-body">
							<div class="form-group" id="msg"></div>
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Nomor</label>
								<input type="text" class="form-control" name="no_ruangan" required="">
							</div>
							<div class="form-group">
								<label class="control-label">Kategori</label>
								<select name="ruangan_id" id="" class="custom-select" required>
									<?php
									$kategori = $conn->query("SELECT * FROM kategori order by nama asc");
									if ($kategori->num_rows > 0) :
										while ($row = $kategori->fetch_assoc()) :
									?>
											<option value="<?php echo $row['id'] ?>"><?php echo $row['nama'] ?></option>
										<?php endwhile; ?>
									<?php else : ?>
										<option selected="" value="" disabled="">Please check the category list.</option>
									<?php endif; ?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Suhu</label>
								<input type="text" class="form-control" name="suhu" required="">
							</div>
							<div class="form-group">
								<label class="control-label">Kelembaban</label>
								<input type="text" class="form-control" name="kelembaban" required="">
							</div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
									<button class="btn btn-sm btn-default col-sm-3" type="reset"> Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<b>List Ruangan</b>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">No.</th>
									<th class="text-center">Suhu & Kelembaban</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$ruangann = $conn->query("SELECT r.*,c.nama as cnama FROM ruangan r inner join kategori c on c.id = r.ruangan_id order by id asc");
								while ($row = $ruangann->fetch_assoc()) :
								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>
										<td class="">
											<p>Ruang ke-<b><?php echo $row['no_ruangan'] ?></b></p>
											<p><small>Kategori: <b><?php echo $row['cnama'] ?></b></small></p>
											<p><small>Suhu: <b><?php echo $row['suhu'] ?></b></small></p>
											<p><small>Kelembaban: <b><?php echo $row['kelembaban'] ?></b></small></p>
										</td>
										<td class="text-center">
											<button class="btn btn-sm btn-primary edit_ruangan" type="button" data-id="<?php echo $row['id'] ?>" data-no_ruangan="<?php echo $row['no_ruangan'] ?>" data-ruangan_id="<?php echo $row['ruangan_id'] ?>" data-waktu="<?php echo $row['waktu'] ?>" data-suhu="<?php echo $row['suhu'] ?>">Edit</button>
											<button class="btn btn-sm btn-danger delete_ruangan" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset;
		padding: unset;
		line-height: 1em;
	}
</style>
<script>
	$('#manage-ruangan').on('reset', function(e) {
		$('#msg').html('')
	})
	$('#manage-ruangan').submit(function(e) {
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url: 'ajax.php?action=save_ruangan',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully saved", 'success')
					setTimeout(function() {
						location.reload()
					}, 5)

				} else if (resp == 2) {
					$('#msg').html('<div class="alert alert-danger">Room number already exist.</div>')
					end_load()
				}
			}
		})
	})
	$('.edit_ruangan').click(function() {
		start_load()
		var cat = $('#manage-ruangan')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='no_ruangan']").val($(this).attr('data-no_ruangan'))
		cat.find("[name='ruangan_id']").val($(this).attr('data-ruangan_id'))
		cat.find("[name='waktu']").val($(this).attr('data-waktu'))
		cat.find("[name='suhu']").val($(this).attr('data-suhu'))
		cat.find("[name='kelembaban']").val($(this).attr('data-kelembaban'))
		end_load()
	})
	$('.delete_ruangan').click(function() {
		_conf("Are you sure to delete this room?", "delete_ruangan", [$(this).attr('data-id')])
	})

	function delete_ruangan($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_ruangan',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>