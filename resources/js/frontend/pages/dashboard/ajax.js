// $(document).ready(function () {
//
//     $('.filter-product-by-category').on('click', function () {
//         let url = $(this).data('url');
//         let categories = $(this).data('slug-category');
//         let searchValue = $('input[name="search"]').val();
//
//         if (!categories) {
//             categories = 'all';
//         }
//
//         actions.ajaxCall({
//             url: url,
//             type: 'GET',
//             data: {
//                 categories: categories,
//                 search: searchValue,
//             },
//         }).done(function (response) {
//             $('.render-product-dashboard').html(response.data)
//         }).fail(function (error) {
//             Swal.fire({
//                 icon: 'error',
//                 title: "Không hợp lệ",
//             }).then(function () {
//                 location.reload();
//             });
//         })
//     });
//
//     $('#search-form').on('keypress', function (e) {
//         if (e.keyCode === 13) {
//             e.preventDefault();
//             let url = $(this).data('url');
//             let categories = $(this).data('slug-category');
//             let searchValue = $('input[name="search"]').val();
//
//             if (!categories) {
//                 categories = 'all';
//             }
//
//             actions.ajaxCall({
//                 url: url,
//                 type: 'GET',
//                 data: {
//                     categories: categories,
//                     search: searchValue,
//                 },
//             }).done(function (response) {
//                 $('.render-product-dashboard').html(response.data)
//             }).fail(function (error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: "Không hợp lệ",
//                 }).then(function () {
//                     location.reload();
//                 });
//             })
//         }
//     });
//
//     // $('input[name="search"]').on('input', function () {
//     //     let searchValue = $(this).val();
//     //     let category = $('.filter-product-by-category.active').data('slug-category');
//     //
//     //     if (searchValue === '') {
//     //         let urlParams = new URLSearchParams(window.location.search);
//     //         urlParams.set('categories', category);
//     //         urlParams.set('search', '');
//     //         let newUrl = window.location.pathname + '?' + urlParams.toString();
//     //         history.pushState({}, '', newUrl);
//     //     }
//     // });
//
// })