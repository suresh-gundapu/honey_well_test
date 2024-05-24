$(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#form-login").validate({
        rules: {
            name: "required",
        },
        messages: {
            name: "Please enter name",
        },

        errorPlacement: function (error, element) {
            if (element.attr("name") === "name") {
                $("#name_err").html(error);
            } else {
                error.insertAfter(element.parent());
            }
        },
    });
});
function assetChangeStatus(status_code, id) {
    Swal.fire({
        title: "Are you sure?",
        text: "",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, change it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: updateUrl,
                data: {
                    status: status_code,
                    id: id,
                },
                cache: false,
                type: "POST",
                success: function (result) {
                    console.log(result);
                    //  var obj = jQuery.parseJSON(result);
                    if (result.success == "1") {
                        Swal.fire({
                            icon: "success",
                            title: "Success...",
                            text: result.message,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error...",
                            text: result.message,
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // alert('Error at add data');
                },
            });
        }
    });
}
$(".delete_cost").on("click", function (event) {
    var id = $(this).data("id");
    var table = "state";
    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: deleteUrl,
                type: "POST",
                data: {
                    id: id,
                },
                error: function (request, response) {
                    console.log(request);
                },
                success: function (result) {
                    if (result.success == "1") {
                        Swal.fire({
                            icon: "success",
                            title: "Success...",
                            text: result.message,
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error...",
                            text: result.message,
                        });
                    }
                },
            });
        }
    });
});
