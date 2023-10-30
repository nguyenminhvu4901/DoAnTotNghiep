(function (yourcode) {
    yourcode(window.jQuery, window, document);
}(function ($, window, document) {
    var imagePreview = $('#image-preview');

    $('#input_image_product').on('change', function () {
        var file = $(this).get(0).files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function () {
                // Hiển thị hình ảnh trong trình xem trước
                imagePreview.html('New Image <br /> <img src="' + reader.result +
                    '" alt="Preview Image" width="500">');
                addDeleteButton();
            }
            reader.readAsDataURL(file);
        } else {
            imagePreview.html('');
        }
    });

    function addDeleteButton() {
        var deleteButton = $('<button>').addClass('btn btn-danger btn-sm mt-2').text('X');
        deleteButton.on('click', function () {
            imagePreview.html('');
            $('#input_image_product').val('');
        });
        imagePreview.append(deleteButton);
    }
}))