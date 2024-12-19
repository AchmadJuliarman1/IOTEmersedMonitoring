<?php include_once 'header.php';
include_once 'api/Database.php'; 

$db = new Database("localhost", "root", "", "iot_emersed");

if(isset($_POST['submit'])){
	if($db->inputDataPerbandingan($_POST) == 1){
		echo '
		<script>
			window.location.href = "perbandingan.php"
		</script> ';
	}
}
 ?>
<div class="container" style="margin-left: 18vw;">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="mt-4">
			<label for="hari" class="form-label">Hari</label>
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="hari" required>
			<?php for ($i=1; $i<=30; $i++) : ?>
			<option value="<?= $i ?>" >Hari ke <?= $i ?></option>
			<?php endfor; ?>
			</select>
		</div>
		<div class="mt-4">
			<label for="tunas" class="form-label">Tunas Ke</label>
			<select class="form-select form-select-lg mb-3" aria-label="Large select example" name="batang" required>
			<?php for ($i=1; $i<=5; $i++) : ?>
			<option value="<?= $i ?>" >Batang ke <?= $i ?></option>
			<?php endfor; ?>
			</select>
		</div>
		<span class="badge text-bg-info">Data Konvensional</span>
		<div class="mt-4">
			<label for="panjang_k" class="form-label">Panjang Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control panjang_k input-number" name="panjang_k" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="lebar_k" class="form-label">Lebar Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control lebar_k input-number" name="lebar_k" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="tinggi_k" class="form-label">Tinggi Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control tinggi_k input-number" name="tinggi_k" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="jumlah_tunas_k" class="form-label">Jumlah Tunas</label>
			<input type="number" class="form-control jumlah_tunas_k input-number" name="jumlah_tunas_k" required>
		</div class="mt-4">
		<hr>
		<span class="badge text-bg-info">Data IOT</span>
		<div class="mt-4">
			<label for="panjang_i" class="form-label">Panjang Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control panjang_i input-number" name="panjang_i" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="lebar_i" class="form-label">Lebar Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control lebar_i input-number" name="lebar_i" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="tinggi_i" class="form-label">Tinggi Konvensional</label>
			<div class="input-group">
				<input type="number" class="form-control tinggi_i input-number" name="tinggi_i" required>
				<span class="input-group-text">CM</span>
			</div>
		</div>
		<div class="mt-4">
			<label for="jumlah_tunas_i" class="form-label">Jumlah Tunas</label>
			<input type="number" class="form-control jumlah_tunas_i input-number" name="jumlah_tunas_i" required>
		</div class="mt-4">
		<div class="container d-flex flex-row-reverse">
			<button type="submit" class="btn btn-primary mt-4 mb-4" name="submit">Submit</button>
		</div>
	</form>
</div>
<?php include_once 'footer.php' ?>