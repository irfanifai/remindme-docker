const flashData = $(".flash-data").data("flashdata");

// info success
if (flashData) {
    Swal.fire({
        type: "success",
        title: "Data",
        text: flashData
    });
}

// tombol-hapus (belum bisa)
$(".tombol-hapus").on("click", function(e) {
    e.preventDefault();
    var postId = $(this).data("id");

    Swal.fire(
        {
            title: "Apakah anda yakin?",
            text: "Data akan dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus Data!"
        },
        function() {
            window.location.href =
                "{{ route('admin.users.destroy' )}}" + postId;
        }
    );
});

// SELECT2
// $("#categories").select2({
//     ajax: {
//         url: "http://arrival.test:8080/admin/ajax/categories/search",
//         processResults: function(data) {
//             return {
//                 results: data.map(function(item) {
//                     return { id: item.id, text: item.title };
//                 })
//             };
//         }
//     }
// });

// upload foto user
function showMyImage(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById("thumbnail");
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function(aImg) {
            return function(e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}

$("#paid").keyup(function() {
    var bayar = $("#paid").val();
    console.log(bayar);
    var total = $("#total").val();
    console.log(total);
    var change = bayar - total;
    console.log(change);
    $("#change").val(change);
});

