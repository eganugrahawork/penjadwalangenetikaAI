const flashData = $(".flash-data").data("flashdata");

if (flashData) {
	Swal.fire({
		title: "Successful",
		text: flashData,
		icon: "success",
	});
}



//tombol hapus

$(".button-delete").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Apakah anda yakin ?",
		text: "kamu ingin menghapus data ini ?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Ya, hapus data!",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".button-reset-password").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Apakah anda yakin ?",
		text: "Reset Password ke default ?",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Reset!",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

