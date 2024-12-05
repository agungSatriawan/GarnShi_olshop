// $('.tabledata').DataTable();
const base_url = window.location.origin + "/";
// Do this before you initialize any of your modals

const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {

        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        trailingZeroDisplay: 'stripIfInteger'
    }).format(number);
}
// $('.carousel').carousel('cycle')
tinymce.init({
    selector: '.editor'
});




$('body').find('.tabledata').dataTable({
    sort: true,
    lengthMenu: [
        [10, 25, 50, 100, 999999],
        [10, 25, 50, 100, 'All']
    ],
    dom: 'lBfrtip',
    deferRender: true,
    buttons: [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
});
loadListProduct();
loadListProductVarian();
function loadListProduct() {
    $('#t_list_produk').dataTable({

        destroy: true,
        dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5',
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ],
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + '/admin/loadListProduct',
            type: 'post',
            async: false,

        },
        columns: [
            {
                className: 'text-center align-middle',
                orderable: false,
                data: null, "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                defaultContent: '',
            },
            {
                data: 'image'
            },
            {
                data: 'product_name'
            },
            {
                className: 'text-right',
                data: 'uom'
            },
            // {
            //     className: 'text-center',
            //     data: 'size'
            // },

            // {
            //     className: 'text-right',
            //     data: 'color'
            // },
            // {
            //     className: 'text-center',
            //     data: 'price'
            // },
            {
                className: 'text-center',
                data: 'category'
            },
            {
                className: 'text-wrap',
                data: 'description'
            },
        ],
        createdRow: function (row, data, dataIndex) {
            // console.log(data)
            $(row).addClass('updateProduct');
            $(row).attr('data-id', data.id);
            $(row).attr('data-id_product', data.id_product);
            $(row).attr('data-toggle', 'modal');
            $(row).attr('data-target', '#addProduct');

        },
        columnDefs: [
            {
                targets: 1,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    console.log(row)
                    let res = '';
                    if (data != '') {
                        res = ` <a href="` + base_url + `/assets/images/product/` + data + `" data-lightbox="image-1" multiple data-title="` + data + `">
                                    <img src="` + base_url + `/assets/images/product/` + data + `" class="img-thumbnail" alt="">
                                </a>`;
                    } else {
                        res = `<i class="fa-solid fa-eye-slash"> </i>  <small class="d-block">No Image Available</small>`;
                    }

                    return res;
                }
            },
            // {
            //     targets: 6,
            //     className: 'text-center',
            //     render: function (data, type, row, meta) {
            //         let res = 'Rp. ' + rupiah(data)

            //         return res;
            //     }
            // },
            {
                targets: 5,
                className: 'text-center',
                render: function (data, type, row, meta) {
                    let res = `<div class="overflowTableProduct">
                    `+ data + `
                    </div>`

                    return res;
                }
            },

        ]

    })
}
function loadListProductVarian() {

    var URL = window.location.href;


    var arr = URL.split('/');//arr[0]='example.com'
    let id_product = arr[6];
    if (id_product != null) {
        $('#t_list_produk_varian').dataTable({

            destroy: true,
            dom: 'Bfrtip',
            // buttons: [
            //     'copyHtml5',
            //     'excelHtml5',
            //     'csvHtml5',
            //     'pdfHtml5'
            // ],
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + '/admin/loadListProductVarian',
                type: 'post',
                async: false,
                data: {
                    id_product
                },

            },
            columns: [
                {
                    className: 'text-center align-middle',
                    orderable: false,
                    data: null, "sortable": false,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    defaultContent: '',
                },
                {
                    data: 'image_varian'
                },
                {
                    data: 'product_name'
                },
                {
                    className: 'text-right',
                    data: 'uom'
                },
                {
                    className: 'text-center',
                    data: 'size'
                },

                {
                    className: 'text-right',
                    data: 'color'
                },
                {
                    className: 'text-center',
                    data: 'price'
                },
                // {
                //     className: 'text-center',
                //     data: 'category'
                // },
                // {
                //     className: 'text-wrap',
                //     data: 'description'
                // },
            ],
            createdRow: function (row, data, dataIndex) {
                // console.log(data)
                $(row).addClass('updateProductVarian');
                $(row).attr('data-id', data.id);
                $(row).attr('data-id_product', data.id_product);
                $(row).attr('data-toggle', 'modal');
                $(row).attr('data-target', '#addProduct');

            },
            columnDefs: [
                {
                    targets: 1,
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        let res = '';
                        if (data != '') {
                            res = ` <a href="` + base_url + `/assets/images/product/` + data + `" data-lightbox="image-1" multiple data-title="` + data + `"><img src="` + base_url + `/assets/images/product/` + data + `" class="img-thumbnail" alt=""></a>`;
                        } else {
                            res = `<i class="fa-solid fa-eye-slash"> </i>  <small class="d-block">No Image Available</small>`;
                        }

                        return res;
                    }
                },
                {
                    targets: 6,
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        let res = 'Rp. ' + rupiah(data)

                        return res;
                    }
                },
                // {
                //     targets: 8,
                //     className: 'text-center',
                //     render: function (data, type, row, meta) {
                //         let res = `<div class="overflowTableProduct">
                //     `+ data + `
                //     </div>`

                //         return res;
                //     }
                // },

            ]

        })
    }

}

$('body').on('click', '.addProduct', function () {
    $('button[name="deleteProduct"]').hide();
    $('input[name="product_name"]').val('');
    $('.modal-title').html('Add Product');
    $('button[type="submit"]').html('Add Product');
    $('select[name="size"]').val('');
    $('select[name="color"]').val('');
    $('select[name="color"]').attr('multiple');
    $('select[name="size"]').attr('multiple');
    $('input[name="price"]').val('');
    $('.priceUpdate').hide();
    $('.box-variasi').show();
    $('.title-varian').html('Variance')
    $('textarea[name="desc"]').html('');
    $('form[name="addProduct"]').attr('action', base_url + 'admin/data_product')
    $('option').removeAttr("selected");
    $('select[name="category"]').removeAttr("selected");
    $('img[name="preview"]').attr('src', '')
    $('.select2').select2({
        dropdownParent: $('.sizecolor'),
        tags: true
    });

})

$('body').on('click', '.updateProduct', function () {
    let id = $(this).data('id');
    let id_product = $(this).data('id_product');
    $.ajax({
        url: base_url + '/admin/updateProduct',
        type: 'post',
        dataType: 'json',
        data: {
            id: id,
            id_product: id_product
        },
        beforeSend: function () {

        },
        success: function (data) {
            let pose = '';
            $('.select2').select2({
                dropdownParent: $('.sizecolor'),
                tags: true
            });
            $('button[name="deleteProduct"]').show();
            $('.title-varian').html(' <a class="btn btn-success" href="/GarnShi/admin/detailVarian/' + data.res.id_product + '"><i class="fa-solid fa-pencil"></i> variation details</a>');
            $('.modal-title').html('Upadate Product');
            $('button[type="submit"]').html('<i class="fa-regular fa-pen-to-square"></i> Update Product');
            $('input[name="product_name"]').val(data.res.product_name);
            $('input[name="size"]').val(data.res.size);
            $('input[name="color"]').val(data.res.color);
            $('.box-variasi').hide();
            $('input[name="price[]"]').val('Rp. ' + rupiah(data.res.price));
            $('textarea[name="desc"]').html(data.res.description);
            $('form[name="addProduct"]').attr('action', base_url + '/admin/submitUpdateProduct/' + data.res.id_product)
            $('select[name="uom"] option[value=' + data.res.id_uom + ']').attr("selected", "selected");
            $('select[name="color[]"]').select2('destroy');
            $('select[name="size[]"]').select2('destroy');
            $('select[name="color[]"]').removeAttr('multiple');
            $('select[name="size[]"]').removeAttr('multiple');
            $('select[name="color"] option[value=' + data.res.id_color + ']').attr("selected", "selected");
            $('select[name="size[]"] option[value=' + data.res.id_size + ']').attr("selected", "selected");
            $('img[name="preview"]').attr('src', base_url + '/assets/images/product/' + data.res.image);
            $('button[name="deleteProduct"]').attr('data-id', data.res.id);
            $('button[name="deleteProduct"]').addClass('deleteProduct');
            $('.listVarian').hide();
            data.category.forEach(c => {
                $('input[value="' + c['id_category'] + '"]').attr('checked', 'checked');
            });
            data.dataImage.forEach(dd => {
                pose += ` <div class="col p-3">
                            <a href="`+ base_url + `assets/images/product/` + dd['image'] + `" data-lightbox="roadtrip">
                                <img src="`+ base_url + `assets/images/product/` + dd['image'] + `" alt="" width="100">
                            </a>
                        </div>`;
            });
            $('.pose-image').html(pose);




        }
    })
})
$('body').on('click', '.updateProductVarian', function () {
    let id = $(this).data('id');
    let id_product = $(this).data('id_product');
    $.ajax({
        url: base_url + '/admin/updateProductVarian',
        type: 'post',
        dataType: 'json',
        data: {
            id: id,
            id_product: id_product
        },
        beforeSend: function () {

        },
        success: function (data) {
            let pose = '';
            $('.select2').select2({
                dropdownParent: $('.sizecolor'),
                tags: true
            });
            $('button[name="deleteProduct"]').show();
            $('.title-varian').html('Variasi');
            $('.modal-title').html('Upadate Product Varian');
            $('button[type="submit"]').html('<i class="fa-regular fa-pen-to-square"></i> Update Product Varian');
            $('input[name="product_name"]').val(data.res.product_name);
            $('input[name="size"]').val(data.res.size);
            $('input[name="color"]').val(data.res.color);
            $('.box-variasi').show();
            $('input[name="price[]"]').val('Rp. ' + rupiah(data.res.price));
            $('input[name="priceDiskon[]"]').val('Rp. ' + rupiah(data.res.price_diskon));
            $('input[name="keterangan[]"]').val(data.res.keterangan);
            $('input[name="stock[]"]').val(data.res.stock);
            $('textarea[name="desc"]').html(data.res.description);
            $('form[name="addProduct"]').attr('action', base_url + 'admin/submitUpdateProductVarian/' + data.res.id)
            $('select[name="uom"] option[value=' + data.res.id_uom + ']').attr("selected", "selected");
            $('select[name="color[]"]').select2('destroy');
            $('select[name="size[]"]').select2('destroy');
            $('select[name="color[]"]').removeAttr('multiple');
            $('select[name="size[]"]').removeAttr('multiple');
            $('select[name="color[]"] option[value=' + data.res.id_color + ']').attr("selected", "selected");
            $('select[name="size[]"] option[value=' + data.res.id_size + ']').attr("selected", "selected");
            $('img[name="preview"]').attr('src', base_url + '/assets/images/product/' + data.res.image_varian);
            $('button[name="deleteProduct"]').attr('data-id', data.res.id);
            $('button[name="deleteProduct"]').addClass('deleteProductVarian');
            $('.listVarian').hide();





        }
    })
})
// function untuk menghapus produk
function deleteProduct(id) {
    $.ajax({
        url: base_url + '/admin/deleteProduct',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        beforeSend: function () {

        },
        success: function (data) {
            return data;
        }
    })
}
function deleteProductVarian(id) {
    $.ajax({
        url: base_url + '/admin/deleteProductVarian',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },
        beforeSend: function () {

        },
        success: function (data) {
            return data;
        }
    })
}

// handle delete product
$('body').on('click', '.deleteProduct', function () {
    let id = $(this).data('id');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            deleteProduct(id);
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
            $('body').find('.modal.fade').modal('hide')
            loadListProduct();
            location.reload();

        }
    });

})
$('body').on('click', '.deleteProductVarian', function () {
    let id = $(this).data('id');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            deleteProductVarian(id);
            Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
            });
            $('body').find('.modal.fade').modal('hide')
            loadListProduct();
            location.reload();

        }
    });

})

// preview image login system
function readURL(input, ket) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview_' + ket).attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
    }
}



// $(".images_file").change(function () {
$('body').on('change', '.images_file', function () {
    let kode = $(this).data('kode');
    $('.preview_' + kode).val('');
    readURL(this, kode);
});


$('body').on('click', '.modal, .fade, .show', function () {

    $('.modal-backdrop.fade').addClass('hide')
})



$('.select2').select2({
    dropdownParent: $('.sizecolor'),
    tags: true
});

$('.getImagesFileId').change(function () {
    $.ajax({
        url: base_url + '/admin/getIdProduct',
        type: 'post',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (res) {
            $('.varian').attr('data-id', res);

        }
    })
})

$('.varian').change(function () {
    let id = $(this).data('id');
    let color = $('.varian_warna').val();
    let size = $('.varian_ukuran').val();

    // let pose = $('.varian_pose').val();
    $.ajax({
        url: base_url + 'admin/addVarian',
        type: 'post',
        dataType: 'json',
        data: {
            id,
            color,
            size
            // pose
        },
        beforeSend: function () {

        },
        success: function (res) {
            if (res.data != 0) {
                let isi = '';
                console.log(res.row_size.length)
                res.row_color.forEach(rc => {
                    let randomId = Math.floor(Math.random() * 90000) + 10000;
                    isi += `<tr>
                                <td class="text-center align-middle" rowspan="`+ (parseInt(res.row_size.length) + 1) + `">
                                `+ rc.color + `
                                <a href="" target="_blank">
                                    <img name="preview" multiple class="preview_image_varian`+ randomId + `" src="" alt="" id="" width="100">
                                </a>
                                <input type="file" name="image_varian[]" multiple class="form-control images images_file" data-kode="image_varian`+ randomId + `" accept="image/*">
                                </td>
                            </tr>`;
                    res.row_size.forEach(rs => {


                        isi += ` </tr>
                                        <tr>
                                        <td class="text-center align-middle">
                                            `+ rs.size + `
                                        </td>
                                        <td class="text-center align-middle"> 
                                            <input type="text" name="price[]" class="form-control">
                                        </td>
                                        <td class="text-center align-middle"> 
                                            <input type="text" name="priceDiskon[]" class="form-control">
                                        </td>
                                        <td class="text-center align-middle">
                                            <input type="text" name="stock[]" class="form-control">
                                        </td>
                                        <td class="text-center align-middle">
                                            <input type="text" name="keterangan[]" class="form-control">
                                        </td>
                                    </tr>`;
                    });

                });
                $('.table_body_varian').html(isi);
            } else {
                $('.table_body_varian').html('');
            }

        }
    })

})


function loadSize() {
    let isi = '';
    $.ajax({
        url: base_url + 'admin/loadSize',
        type: 'post',
        dataType: 'json',
        success: function (data) {
            data.forEach(d => {
                isi += `<option value="` + d['id'] + `">` + d['size'] + `</option>`;
            });
            $('.varian_ukuran').html(isi);
        }
    })
}

function addVariance() {
    let randomId = Math.floor(Math.random() * 90000) + 10000;
    $.ajax({
        url: base_url + '/admin/variance',
        type: 'post',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (res) {
            let size = '';
            let color = '';
            let price = '';
            res.size.forEach(s => {
                size += `<option value="` + s['id'] + `">` + s['size'] + `</option>`;
            });
            res.color.forEach(s => {
                color += `<option value="` + s['id'] + `">` + s['color'] + `</option>`;
            });


            // var addrow = `<div class="row baru-variance mt-3">
            //             <div class="col-sm-10">
            //               <div class="row">
            //                   <div class="col p-3">
            //                       <a href="" target="_blank">
            //                           <img name="preview" class="preview_image_varian`+ randomId + `" src="" alt="" id="" width="100">
            //                       </a>
            //                   </div>
            //                   <div class="col">
            //                       <label class="form-label">Image</label>
            //                       <input type="file" name="image_varian[]" class="form-control images images_file" data-kode="image_varian`+ randomId + `" accept="image/*">
            //                   </div>

            //                   <div class="col">
            //                       <div class="mb-3">
            //                           <label class="form-label">Size</label>
            //                           <select name="size[]" id="" class="select2 form-control">
            //                           `+ size + `
            //                           </select>


            //                       </div>
            //                   </div>
            //               </div>
            //               <div class="row">
            //                   <div class="col">
            //                       <div class="mb-3">
            //                           <label class="form-label">Color</label>

            //                           <select name="color[]" id="" class="select2 form-control">
            //                             `+ color + `
            //                           </select>


            //                       </div>
            //                   </div>
            //                   <div class="col">
            //                       <div class="mb-3">
            //                           <label class="form-label">Price</label>
            //                           <input type="text" name="price[]" class="form-control">

            //                       </div>
            //                   </div>
            //                   <div class="col">
            //                       <div class="mb-3">
            //                           <label class="form-label">Stock</label>
            //                           <input type="text" name="stock[]" class="form-control">

            //                       </div>
            //                   </div>
            //               </div>
            //           </div>
            //           <div class="col-sm-2 mt-5">

            //               <button type="button" class="btn btn-primary btn-tambahVariance mt-4" data-toggle="modal" data-target=""><i class="fa-solid fa-plus"></i> Add Row</button>

            //                  <button type="button" class="btn btn-danger btn-hapusVariance mt-4" style="display:none;" data-toggle="modal" data-target=""><i class="fa-solid fa-trash-can"></i> Delete Row</button>
            //           </div>

            //         </div>`
            $(".dynamic_variance").append(addrow);
            $('.select2').select2({
                dropdownParent: $('.sizecolor'),
                tags: true
            });

        }
    })

}


$('.loadDetailOrder').click(function (e) {
    e.preventDefault();
    let invoice = $(this).data('invoice');
    $('.no-invoice').html(invoice)
})
// $("body").on("click", ".btn-tambahVariance", function () {
//     addVariance()
//     $(this).css("display", "none")
//     console.log($(this).parent())
//     var valtes = $(this).parent().parent().find(".btn-hapusVariance").css("display", "");
//     var valtes = $(this).parent().parent().find(".label-hapusVariance").css("display", "");
// })

// $("body").on("click", ".btn-hapusVariance", function () {

//     $(this).parent().parent('.baru-variance').remove();

//     var bykrow = $(".baru-variance").length;
//     console.log(bykrow)
//     if (bykrow == 1) {
//         $(".btn-hapusVariance").css("display", "none")
//         $(".btn-tambahVariance").css("display", "");
//     } else {
//         $('.baru-variance').last().find('.btn-tambah').css("display", "");
//     }
// });



