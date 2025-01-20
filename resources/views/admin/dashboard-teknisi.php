<?php include 'header.php';
session_start();
include 'config.php';


$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role == "admin") {
	$sql = "SELECT * FROM administrators WHERE user_id='$user_id'";
} else if ($role == "pelanggan") {
	$sql = "SELECT * FROM customers WHERE user_id='$user_id'";
} else if ($role == "teknisi") {
	$sql = "SELECT * FROM technicians WHERE user_id='$user_id'";
}
$result = mysqli_query($conn, $sql);
$nama = '';
$capacity = '';
$location = '';
if ($result->num_rows > 0) {
	$row = mysqli_fetch_assoc($result);
	$nama = $row['name'];
	$capacity = $row['capacity'];
	$location = $row['location'];
	$registration_date = $row['registration_date'];
}
?>

<script type="text/javascript">
	<!--
	function showTime() {
		var a_p = "";
		var today = new Date();
		var curr_hour = today.getHours();
		var curr_minute = today.getMinutes();
		var curr_second = today.getSeconds();
		if (curr_hour < 12) {
			a_p = "AM";
		} else {
			a_p = "PM";
		}
		if (curr_hour == 0) {
			curr_hour = 12;
		}
		if (curr_hour > 12) {
			curr_hour = curr_hour - 12;
		}
		curr_hour = checkTime(curr_hour);
		curr_minute = checkTime(curr_minute);
		curr_second = checkTime(curr_second);
		document.getElementById('clock').innerHTML = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}
	setInterval(showTime, 500);
	//
	-->
</script>



<div class="container-fluid page-body-wrapper">
	<div class="main-panel">
		<div class="content-wrapper">

			<br>

			<div class="row">
				<div class="col-sm-4 flex-column d-flex stretch-card">
					<div class="row flex-grow">
						<div class="col-sm-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-8">

											<h2 class="font-weight-bold text-dark"><?php echo $location ?></h2>
											<script type='text/javascript'>
												<!--
												var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
												var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
												var date = new Date();
												var day = date.getDate();
												var month = date.getMonth();
												var thisDay = date.getDay(),
													thisDay = myDays[thisDay];
												var yy = date.getYear();
												var year = (yy < 1000) ? yy + 1900 : yy;
												document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
												//
												-->
											</script>
											<span id="clock" class="text-dark">Monday 3.00 PM</span>
											<div class="d-lg-flex align-items-baseline mb-3">
												<h1 class="text-dark font-weight-bold">23<sup class="font-weight-light"><small>o</small><small class="font-weight-medium">c</small></sup></h1>
												<p class="text-muted ms-3">Partly cloudy</p>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="position-relative">
												<img src="images/dashboard/live.png" class="w-100" alt="">
												<div class="live-info badge badge-success">Live</div>
											</div>
										</div>
									</div>
									<div class="row">
										<h4 class="card-title">Riwayat Pengiriman</h4>
										<p class="card-description">
										</p>
										<div class="table-responsive">
											<table class="table">
												<thead>
													<tr>
														<th>No</th>
														<th>Tanggal</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td>12 May 2017</td>
														<td><label class="badge badge-danger">Pending</label></td>
													</tr>
													<tr>
														<td>2</td>
														<td>15 May 2017</td>
														<td><label class="badge badge-warning">In progress</label></td>
													</tr>

												</tbody>
											</table>
										</div>
										<!--<div class="col-sm-12 mt-4 mt-lg-0">-->
										<!--	<div class="bg-primary text-white px-4 py-4 card">-->
										<!--		<div class="row">-->
										<!--			<div class="col-sm-6 pl-lg-5">-->
										<!--				<h2>$1635</h2>-->
										<!--				<p class="mb-0">Your Iincome</p>-->
										<!--			</div>-->
										<!--			<div class="col-sm-6 climate-info-border mt-lg-0 mt-2">-->
										<!--				<h2>$2650</h2>-->
										<!--				<p class="mb-0">Your Spending</p>-->
										<!--			</div>-->
										<!--		</div>-->
										<!--	</div>-->
										<!--</div>-->
									</div>
									<!--<div class="row pt-3 mt-md-1">-->
									<!--	<div class="col">-->
									<!--		<div class="d-flex purchase-detail-legend align-items-center">-->
									<!--			<div id="circleProgress1" class="p-2"></div>-->
									<!--			<div>-->
									<!--				<p class="font-weight-medium text-dark text-small">Sessions</p>-->
									<!--				<h3 class="font-weight-bold text-dark  mb-0">26.80%</h3>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--	<div class="col">-->
									<!--		<div class="d-flex purchase-detail-legend align-items-center">-->
									<!--			<div id="circleProgress2" class="p-2"></div>-->
									<!--			<div>-->
									<!--				<p class="font-weight-medium text-dark text-small">Users</p>-->
									<!--				<h3 class="font-weight-bold text-dark  mb-0">56.80%</h3>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="col-sm-8 flex-column d-flex stretch-card">
					<div class="row">

						<div class="col-lg-4 d-flex grid-margin stretch-card">
							<div class="card sale-diffrence-border">
								<div class="card-body">
									<h2 class="text-dark mb-2 font-weight-bold"><?php echo $capacity; ?></h2>
									</h2>
									<h4 class="card-title mb-2">Kapasitas Tabung</h4>
									<small class="text-muted"></small>
								</div>
							</div>
						</div>
						<div class="col-lg-4 d-flex grid-margin stretch-card">
							<div class="card sale-diffrence-border">
								<div class="card-body">
									<h2 class="text-dark mb-2 font-weight-bold">Aktif</h2>
									<h4 class="card-title mb-2">Status Device</h4>
									<small class="text-muted"></small>
								</div>
							</div>
						</div>
						<div class="col-lg-4 d-flex grid-margin stretch-card">
							<div class="card sale-diffrence-border">
								<div class="card-body">
									<h2 class="text-dark mb-2 font-weight-bold"><?php echo $registration_date ?></h2>
									<h4 class="card-title mb-2">Tanggal Bergabung</h4>
									<small class="text-muted"></small>
								</div>
							</div>
						</div>
						<div class="col-lg-4 d-flex grid-margin stretch-card">
							<div class="card bg-primary">
								<div class="card-body text-white">
									<h2 class="text-white mb-2 font-weight-bold"><?php echo "50 bar" ?></h2>
									<div class="progress mb-3">
										<div class="progress-bar  bg-warning" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<p class="pb-0 mb-0">Sisa Gas</p>
								</div>
							</div>
						</div>
						<div class="col-md-8 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">

									<h4 class="card-title">Set Auto</h4>



									<div class="form-group row">
										<div class="col">
											<p class="mb-2">Primary</p>
											<form class="forms-sample">
												<div class="form-group">
													<label for="exampleInputUsername1">Batas Atas</label>
													<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Batas Atas">
												</div>
												<div class="form-group">
													<label for="exampleInputUsername1">Batas Bawah</label>
													<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Batas Bawah">
												</div>

												<button type="submit" class="btn btn-primary me-2">Submit</button>
											</form>
										</div>
										<div class="col">
											<p class="mb-2">Success</p>
											<label class="toggle-switch toggle-switch-success">
												<input type="checkbox" checked>
												<span class="toggle-slider round"></span>
											</label>
										</div>
									</div>
									</form>
								</div>
							</div>
						</div>

					</div>

				</div>
				<div class="row">
					<div class="col-sm-6 mb-4 mb-xl-0">
						<div class="d-lg-flex align-items-center">
							<div>
								<!--<h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>-->
							</div>
							<!--<div class="ms-lg-5 d-lg-flex d-none">-->
							<!--		<button type="button" class="btn bg-white btn-icon">-->
							<!--			<i class="mdi mdi-view-grid text-success"></i>-->
							<!--	</button>-->
							<!--		<button type="button" class="btn bg-white btn-icon ms-2">-->
							<!--			<i class="mdi mdi-format-list-bulleted font-weight-bold text-primary"></i>-->
							<!--		</button>-->
							<!--</div>-->
						</div>
					</div>
					<div class="col-sm-6">
						<div class="d-flex align-items-center justify-content-md-end">
							<div class="pe-1 mb-3 mb-xl-0">
								<button type="button" class="btn btn-outline-inverse-info btn-icon-text">
									Feedback
									<i class="mdi mdi-message-outline btn-icon-append"></i>
								</button>
							</div>
							<div class="pe-1 mb-3 mb-xl-0">
								<button type="button" class="btn btn-outline-inverse-info btn-icon-text">
									Help
									<i class="mdi mdi-help-circle-outline btn-icon-append"></i>
								</button>
							</div>
							<!--<div class="pe-1 mb-3 mb-xl-0">-->
							<!--		<button type="button" class="btn btn-outline-inverse-info btn-icon-text">-->
							<!--			Print-->
							<!--			<i class="mdi mdi-printer btn-icon-append"></i>                          -->
							<!--		</button>-->
							<!--</div>-->
						</div>
					</div>
				</div>
				</br>
				</br>
				</br>

				<div class="row">
					<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Pressure Monitor</h4>
								<canvas id="lineChart"></canvas>
							</div>
						</div>
					</div>
					<div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Temperature Monitor</h4>
								<canvas id="areaChart"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>