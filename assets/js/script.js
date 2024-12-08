
$(document).ready(function () {
    const base_url = window.location.origin + "/";


    // if (window.location.href == 'https://garnshi.com/') {
    // Seleksi semua elemen gambar yang ingin diubah path-nya
    $('img[src*="assets/images/product/"]').each(function () {
        var img = $(this);
        var src = img.attr('src');

        // Cek apakah layar berukuran mobile
        if ($(window).width() > 768) { // Sesuaikan breakpoint sesuai kebutuhan
            // Ganti bagian "window" dengan "mobile"
            var newSrc = src.replace('assets/images/product/', 'assets/images/desktop/');
            img.attr('src', newSrc);
        }
    });
    // }



    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {

            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
            trailingZeroDisplay: 'stripIfInteger'
        }).format(number);
    }

    lightbox.option({
        'resizeDuration': 600,
        'wrapAround': true
    })
    // $('.select2').select2({
    //     dropdownParent: $('#myModal')
    // });

    $('body').on('keyup change', '#search-form', function (e) {
        e.preventDefault()
        let search = $(this).val();
        if (search.length > 3) {
            $.ajax({
                url: base_url + 'home/search',
                type: 'post',
                dataType: 'json',
                data: {
                    search
                },
                success: function (data) {
                    let isiData = '';
                    data.forEach(d => {

                        isiData += `   <div class="col">
                                    <div class="col-auto my-3">
                                        <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 3">
                                            <div class="product-item image-zoom-effect link-effect">
                                                <div class="image-holder">
                                                    <a href="`+ base_url + 'home/detail/' + d['id'] + `" style="height: 350px;">
                                                        <img src="`+ base_url + 'assets/images/desktop/' + d['image'] + `" alt="product" class="product-image img-fluid" width="250">
                                                    </a>
                                                    
                                                    <div class="product-content">
                                                        <h5 class="text-uppercase fs-5 mt-3">
                                                            <a href="`+ base_url + 'assets/images/desktop/' + d['image'] + `">` + d['product_name'] + `</a>
                                                        </h5>
                                                        <a href="`+ base_url + 'home/detail/' + d['id'] + `" class="text-decoration-none" data-id_product="` + d['id'] + `" data-after="">
                                                            <span><del>Rp. `+ rupiah(d['price']) + `</del></span>
                                                            <span><b>Rp. `+ rupiah(d['price_diskon']) + `</b></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;



                    });
                    $('.hasilSearch').html('');
                    $('.hasilSearch').html(isiData);

                }
            })
        } else {
            $('.hasilSearch').html(`    <div class="alert alert-danger text-center" role="alert">
                                        Tidak Ada Data
                                        </div>`);
        }

    })

    $('.variant').on('click', function () {

        // Menghapus kelas 'selected' dari semua varian
        $('.variant').removeClass('selected');

        // Menambahkan kelas 'selected' ke varian yang diklik
        $(this).addClass('selected');

        // Memperbarui nilai input tersembunyi dengan data varian yang dipilih
        let selectedValue = $(this).data('value');
        let selectedImage = $(this).data('image');
        $('#selectedVariant').val(selectedValue);
        $('.img-poster').attr('src', base_url + '/assets/images/product/' + selectedImage)



        // Opsional: Menampilkan varian terpilih di konsol
        console.log('Varian terpilih:', selectedValue);
    });
    $('.variantSize').on('click', function () {

        // Menghapus kelas 'selected' dari semua varian
        $('.variantSize').removeClass('selected');
        // Menambahkan kelas 'selected' ke varian yang diklik
        $(this).addClass('selected');
        let id = $(this).data('id');
        // Memperbarui nilai input tersembunyi dengan data varian yang dipilih
        let selectedValue = $(this).data('value');
        let selectedImage = $(this).data('image');
        $('#selectedVariant').val(selectedValue);
        $('.img-poster').attr('src', base_url + '/assets/images/product/' + selectedImage)
        $.ajax({
            url: base_url + '/home/changeSize',
            type: 'post',
            dataType: 'json',
            data: {
                id
            },
            success: function (data) {
                let originPrice = data['price'];
                let diskonPrice = data['price_diskon'];
                if (originPrice != diskonPrice) {
                    $('.hargaNormal').show();
                    $('.harga-satuan').html('');
                    $('.harga-satuan').html(rupiah(originPrice));
                } else {
                    $('.hargaNormal').hide();
                }
                $('.harga-diskon').html('');
                $('.harga-diskon').html(rupiah(data['price_diskon']));
            }
        })


        // Opsional: Menampilkan varian terpilih di konsol
        console.log('Varian terpilih:', selectedValue);
    });


    // carousel swipe



    $('body').on('click', 'button', function () {
        let target = $(this).data('target');
        $(target).modal('show');



    })
    tinymce.init({
        selector: '.editor'
    });

    $('body').on('click', '.close', function () {
        let target = $(this).data('target');
        $(target).modal('hide');

    })

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




    // (function () {
    //     const quantityContainer = document.querySelector(".quantity");
    //     // const id = document.querySelector(".box-qty").data('id');
    //     // const quantityContainer = document.querySelector(".quantity_" + id);
    //     const minusBtn = quantityContainer.querySelector(".minus");
    //     // const minusBtn = quantityContainer.querySelector(".minus_" + id);
    //     const plusBtn = quantityContainer.querySelector(".plus");
    //     // const plusBtn = quantityContainer.querySelector(".plus_" + id);
    //     const inputBox = quantityContainer.querySelector(".input-box");
    //     // const inputBox = quantityContainer.querySelector(".qty_" + id);

    //     updateButtonStates();

    //     quantityContainer.addEventListener("click", handleButtonClick);
    //     inputBox.addEventListener("input", handleQuantityChange);

    //     function updateButtonStates() {
    //         const value = parseInt(inputBox.value);
    //         minusBtn.disabled = value <= 1;
    //         plusBtn.disabled = value >= parseInt(inputBox.max);
    //     }

    //     function handleButtonClick(event) {
    //         if (event.target.classList.contains("minus")) {
    //             decreaseValue();
    //         } else if (event.target.classList.contains("plus")) {
    //             increaseValue();
    //         }
    //     }

    //     function decreaseValue() {
    //         let value = parseInt(inputBox.value);
    //         value = isNaN(value) ? 1 : Math.max(value - 1, 1);
    //         inputBox.value = value;
    //         updateButtonStates();
    //         handleQuantityChange();
    //     }

    //     function increaseValue() {
    //         let value = parseInt(inputBox.value);
    //         value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
    //         inputBox.value = value;
    //         updateButtonStates();
    //         handleQuantityChange();
    //     }

    //     function handleQuantityChange() {
    //         let value = parseInt(inputBox.value);
    //         value = isNaN(value) ? 1 : value;

    //         // Execute your code here based on the updated quantity value
    //         console.log("Quantity changed:", value);
    //         console.log(id)
    //     }
    // })();



    // $('.btn-number').click(function (e) {
    $('body').on('click', '.btn-number', function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        id_product = $(this).attr('data-id_product');
        dataStatus = $(this).attr('data-status');
        var satuan = $(".satuan[name='" + fieldName + "']").html();
        satuan = parseInt(satuan.replaceAll(',', ''));
        let jumlah = 0;
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                    jumlah = (currentVal - 1) * satuan;
                    $('.jumlah[name="' + fieldName + '"]').html('Rp. ' + rupiah(jumlah));
                    if (dataStatus == 'update') {
                        updateQtyCart(id_product, currentVal - 1)
                        updateCart();
                        loadTotalSelected()
                    }

                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                    jumlah = (currentVal + 1) * satuan;
                    $('.jumlah[name="' + fieldName + '"]').html("Rp. " + rupiah(jumlah));
                    if (dataStatus == 'update') {
                        updateQtyCart(id_product, currentVal + 1)
                        updateCart();
                        loadTotalSelected()
                    }
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }

        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function () {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $('body').on('change', '#prov_kurir', function () {
        let prov_id = $(this).val();
        $.ajax({
            url: base_url + 'home/prov',
            type: 'post',
            dataType: 'json',
            data: {
                id: prov_id
            },
            beforeSend: function () {

            },
            success: function (data) {

                let isi = ``;
                isi = `    <option value="">Select Regency/City</option>`;
                data.forEach(e => {
                    isi += `   <option data-id="` + e.define_kabkot + `" value="` + e.city_id + `">` + (e.type.toUpperCase()) + ' ' + e.city_name.toUpperCase(); + `</option>`;
                });
                $('#kab_kurir').html(isi)
            }
        })
    })
    $('body').on('change', '#kab_kurir', function () {
        let kabkot = $('option:selected', this).attr('data-id');
        console.log(kabkot)
        $.ajax({
            url: base_url + 'home/kabkot',
            type: 'post',
            dataType: 'json',
            data: {
                kabkot: kabkot
            },
            beforeSend: function () {

            },
            success: function (data) {

                let isi = ``;
                isi = `    <option value="">Select Subdistrict</option>`;
                data.forEach(e => {
                    isi += `   <option data-kec"` + e.KEC + `" value="` + e.KEC + `">` + e.KEC.toUpperCase(); + `</option>`;
                });
                $('#kec_kurir').html(isi)
            }
        })
    })
    $('body').on('change', '#kec_kurir', function () {
        let kec = $(this).val()
        console.log(kec)
        $.ajax({
            url: base_url + 'home/kec',
            type: 'post',
            dataType: 'json',
            data: {
                kec: kec
            },
            beforeSend: function () {

            },
            success: function (data) {

                let isi = ``;
                isi = `   <option value="">Select Village</option>`;
                data.forEach(e => {
                    isi += `   <option value="` + e.KEL + `">` + e.KEL.toUpperCase(); + `</option>`;
                });
                $('#kel_kurir').html(isi)
            }
        })
    })
    $('.detail-cost').hide();
    $('.kurir').change(function () {
        $('.detail-cost').slideDown();
        $('.tb-cost').html(`<div class="spinner-border text-center text-secondary" role="status">
                                    <span class="visually-hidden ">Loading...</span>
                                    </div>`);
        let prov = $('#prov_kurir').val();
        let kab = $('#kab_kurir').val();
        let weight = 1000;
        let kurir = $('#kurir_kurir').val();
        $.ajax({
            url: base_url + 'home/cost',
            type: 'post',
            dataType: 'json',
            data: {
                destination: kab,
                weight: weight,
                courier: kurir
            },
            beforeSend: function () {
                $('.tb-cost').html(`<div class="spinner-border text-center text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                    </div>`);
                $('.detail-cost').slideUp();
            },
            success: function (data) {


                let res = data.rajaongkir.results[0]['costs'];
                let isi = '';
                console.log(res);
                res.forEach(r => {
                    isi += ` <tr>
                                <td>`+ r['service'] + `</td>
                                <td>`+ r['description'] + `</td>
                                <td>`+ r['cost'][0]['etd'] + `</td>
                                <td>`+ rupiah(r['cost'][0]['value']) + `</td>
                            </tr>`;
                });
                $('.tb-cost').html(isi);
                $('.detail-cost').slideDown();
            }
        })
    })
    $('.pilihKurir').change(function () {
        $('.detail-cost').slideDown();
        $('.tb-cost').html(`<div class="spinner-border text-center text-secondary" role="status">
                                    <span class="visually-hidden ">Loading...</span>
                                    </div>`);

        let kurir = $('#kurir_kurir').val();
        $.ajax({
            url: base_url + '/product/Selectcost',
            type: 'post',
            dataType: 'json',
            data: {

                courier: kurir
            },
            beforeSend: function () {
                $('.tb-cost').html(`<div class="spinner-border text-center text-secondary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                    </div>`);
                $('.detail-cost').slideUp();
            },
            error: function (xhr, ajaxOptions, thrownError) {

            },
            success: function (data) {
                console.log(data)
                if (data == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Alamat Tidak Ditemukan, Harap mengisi alamat terlebih dahulu"

                    });

                }


                let res = data.rajaongkir.results[0]['costs'];
                let isi = '';
                let tempID = 1;
                // console.log(res);
                res.forEach(r => {
                    isi += ` <tr class="selectRow" data-id="` + tempID + `" data-price="` + rupiah(r['cost'][0]['value']) + `" data-service="` + r['service'] + `" data-desc="` + r['description'] + `" data-etd="` + r['cost'][0]['etd'] + `">
                                 <td class="text-center">
                                   
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="selectRow`+ tempID + `">
                                  
                                 </td>
                                <td>`+ r['service'] + `</td>
                                <td>`+ r['description'] + `</td>
                                <td>`+ r['cost'][0]['etd'] + `</td>
                                <td>`+ rupiah(r['cost'][0]['value']) + `</td>
                            </tr>`;
                    tempID++;
                });
                $('.tb-cost').html(isi);
                $('.detail-cost').slideDown();
                $('.totalAll').html('')
                $('.btn-order').attr('disabled', true)

            }
        })
    })

    $('.img-varian').hover(function () {
        let src = $(this).attr('href');
        $('.img-poster').attr('src', src)
        $('.img-poster-popup').attr('href', src)
    })

    $('body').on('click', '.selectRow', function () {

        let id = $(this).data('id');
        $('.selectRow').removeClass('active');
        let priceCost = $(this).data('price');
        let totalPrice = $('.totalPrice').html();
        $('#selectRow' + id).prop("checked", true);
        $('.costPrice').html("Rp " + priceCost)
        let totalOngkir = parseInt(priceCost.replaceAll("Rp ", "").replaceAll("Rp&nbsp;", "").replaceAll(".", "").replaceAll(",00", ""));
        let totalBelanja = parseInt(totalPrice.replaceAll("Rp ", "").replaceAll(".", "").replaceAll(",00", ""))
        let semuaTotal = totalBelanja + totalOngkir + 4000;

        $('.totalAll').html("Rp. " + rupiah(semuaTotal))
        $('.btn-order').attr('disabled', false)
        $(this).addClass('active')


    })


    $('.body').on('click', '.bank-list', function () {
        let metode = $(this).attr('href');
        console.log(motode)
    })

    $('body').on('click', '.btn-order', function () {
        let kurir = $('.pilihKurir').val();
        let kurirService = $('.selectRow.active').data('service');
        let kurirDesc = $('.selectRow.active').data('desc');
        let kurirEtd = $('.selectRow.active').data('etd');
        let kurirPrice = $('.selectRow.active').data('price');

        $.ajax({
            url: base_url + '/payment/makeOrder',
            type: 'post',
            // dataType: 'json',
            data: {
                kurir,
                kurirService,
                kurirDesc,
                kurirEtd,
                kurirPrice
            },
            beforeSend: function () {

            },
            success: function (data) {
                // console.log(data)
                window.snap.pay(data);
            }
        })

    })
    $('.toProduct').click(function () {
        let id_varian = $(this).data('product');
        window.open(id_varian, '_blank');
    })
    $('.addCart').click(function (e) {
        e.preventDefault();
        // let id_user = $(this).data('id_user');
        let id_product = $(this).data('id_product');
        let qty = $('.qty-product').val();
        let color = $('.variant.selected').data('value');
        let size = $('.variantSize.selected').data('value');
        if (id_product == null || qty == null || color == null || size == null) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: 'Pastikan variasi warna dan ukuran sudah dipilih'
            });
        } else {
            addQtyCart(id_product, qty, color, size);
        }




    })
    $('.buyNow').click(function (e) {
        e.preventDefault();
        // let id_user = $(this).data('id_user');
        let id_product = $(this).data('id_product');
        let qty = $('.qty-product').val();
        let color = $('.variant.selected').data('value');
        let size = $('.variantSize.selected').data('value');
        console.log(qty, color, size);
        addQtyCart(id_product, qty, color, size)
        window.location.replace(base_url + '/product/shipping_cart');
    })

    function updateQtyCart(id_product, qty) {
        $.ajax({
            url: base_url + '/home/UpdateQtyCart',
            type: 'post',
            dataType: 'json',
            data: {
                // id_user,
                id_product,
                qty
            },
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data)
                updateCart();
                if (data == 1) {

                } else if (data == 'login') {
                    window.location.replace(base_url + '/auth?url=' + window.location.href);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",

                    });
                }

            }
        })
    }
    function addQtyCart(id_product, qty, color, size) {
        $.ajax({
            url: base_url + '/home/AddCart',
            type: 'post',
            dataType: 'json',
            data: {
                // id_user,
                id_product,
                qty,
                color,
                size
            },
            beforeSend: function () {

            },
            success: function (data) {
                console.log(data)
                updateCart();
                if (data == 1) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Add Cart Success",
                        showConfirmButton: false

                    });
                } else if (data == 'login') {
                    window.location.replace(base_url + '/auth?url=' + window.location.href);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",

                    });
                }

            }
        })
    }

    function updateCart() {
        $.ajax({
            url: base_url + '/product/updateCart',
            type: 'post',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {
                let countProduct = data.length;
                let isi = '';
                let tableCart = '';
                let jumlah = 0;
                let total = 0;
                let i = 0;
                data.forEach(e => {
                    jumlah = e.price * e.qty;
                    isi += `  <li class="list-group-item d-flex justify-content-between lh-sm p-3 list-cart my-3">
                                <div>
                                    <img src="`+ base_url + '/assets/images/product/' + e.image + `" alt="` + e.image + `" width="50">
                                    <h6 class="my-0">`+ e.product_name + `</h6>
                                    <small class="text-body-secondary">`+ e.qty + `</small>
                                </div>
                                <span class="text-body-secondary">`+ rupiah(jumlah) + `</span>
                            </li>`;

                    total += jumlah;
                    i++;
                });

                isi += `   <span>Total </span>
                            <strong>`+ rupiah(total) + `</strong>`;
                $('.data-cart').html(isi);
                $('.cart-count').html('(' + countProduct + ')');
                loadTotalSelected()
            }
        })
    }






    $('.checkAll').click(function (event) {

        let qty = $('.input-box').val();

        if (this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function () {
                let cek = this.checked = true;
                let id_product = $(this).data('id');
                console.log(cek, qty, id_product)
                checkSelected(cek, qty, id_product)
            });
        } else {
            $(':checkbox').each(function () {
                let cek = this.checked = false;
                let id_product = $(this).data('id');
                console.log(cek, qty, id_product)
                checkSelected(cek, qty, id_product)
            });
        }
    });

    $('.delete_cart').click(function () {
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
                $.ajax({
                    url: base_url + '/product/delete_cart',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data == 1) {
                            updateCart();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            // updateCart()
                            location.reload();
                        }
                    }
                })

            }
        });
    })

    $('.largerCheckbox').click(function () {
        let cek = $(this)[0].checked;
        let qty = $('.input-box').val();
        let id_product = $(this).data('id');
        checkSelected(cek, qty, id_product);
        console.log(cek, qty, id_product)
    })

    function checkSelected(cek, qty, id_product) {
        $.ajax({
            url: base_url + '/product/selectCart',
            type: 'post',
            dataType: 'json',
            data: {
                cek,
                id_product
            },
            beforeSend: function () {

            },
            success: function (data) {
                loadTotalSelected()
            }
        })
    }




    $('body').on('click', '.checkout', function () {
        let totalHarga = $('.totalPrice').html();
        if (totalHarga == '0') {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please Select the product",
            });
        } else {
            window.location.href = base_url + '/product/checkout'
        }
    })




    const ANIMATION_DURATION = 300;

    const SIDEBAR_EL = document.getElementById("sidebar");

    const SUB_MENU_ELS = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu"
    );

    const FIRST_SUB_MENUS_BTN = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu > a"
    );

    const INNER_SUB_MENUS_BTN = document.querySelectorAll(
        ".menu > ul > .menu-item.sub-menu .menu-item.sub-menu > a"
    );

    class PopperObject {
        instance = null;
        reference = null;
        popperTarget = null;

        constructor(reference, popperTarget) {
            this.init(reference, popperTarget);
        }

        init(reference, popperTarget) {
            this.reference = reference;
            this.popperTarget = popperTarget;
            this.instance = Popper.createPopper(this.reference, this.popperTarget, {
                placement: "right",
                strategy: "fixed",
                resize: true,
                modifiers: [
                    {
                        name: "computeStyles",
                        options: {
                            adaptive: false
                        }
                    },
                    {
                        name: "flip",
                        options: {
                            fallbackPlacements: ["left", "right"]
                        }
                    }
                ]
            });

            document.addEventListener(
                "click",
                (e) => this.clicker(e, this.popperTarget, this.reference),
                false
            );

            const ro = new ResizeObserver(() => {
                this.instance.update();
            });

            ro.observe(this.popperTarget);
            ro.observe(this.reference);
        }

        clicker(event, popperTarget, reference) {
            if (
                SIDEBAR_EL.classList.contains("collapsed") &&
                !popperTarget.contains(event.target) &&
                !reference.contains(event.target)
            ) {
                this.hide();
            }
        }

        hide() {
            this.instance.state.elements.popper.style.visibility = "hidden";
        }
    }

    // class Poppers {
    //     subMenuPoppers = [];

    //     constructor() {
    //         this.init();
    //     }

    //     init() {
    //         SUB_MENU_ELS.forEach((element) => {
    //             this.subMenuPoppers.push(
    //                 new PopperObject(element, element.lastElementChild)
    //             );
    //             this.closePoppers();
    //         });
    //     }

    //     togglePopper(target) {
    //         if (window.getComputedStyle(target).visibility === "hidden")
    //             target.style.visibility = "visible";
    //         else target.style.visibility = "hidden";
    //     }

    //     updatePoppers() {
    //         this.subMenuPoppers.forEach((element) => {
    //             element.instance.state.elements.popper.style.display = "none";
    //             element.instance.update();
    //         });
    //     }

    //     closePoppers() {
    //         this.subMenuPoppers.forEach((element) => {
    //             element.hide();
    //         });
    //     }
    // }

    // const slideUp = (target, duration = ANIMATION_DURATION) => {
    //     const { parentElement } = target;
    //     parentElement.classList.remove("open");
    //     target.style.transitionProperty = "height, margin, padding";
    //     target.style.transitionDuration = `${duration}ms`;
    //     target.style.boxSizing = "border-box";
    //     target.style.height = `${target.offsetHeight}px`;
    //     target.offsetHeight;
    //     target.style.overflow = "hidden";
    //     target.style.height = 0;
    //     target.style.paddingTop = 0;
    //     target.style.paddingBottom = 0;
    //     target.style.marginTop = 0;
    //     target.style.marginBottom = 0;
    //     window.setTimeout(() => {
    //         target.style.display = "none";
    //         target.style.removeProperty("height");
    //         target.style.removeProperty("padding-top");
    //         target.style.removeProperty("padding-bottom");
    //         target.style.removeProperty("margin-top");
    //         target.style.removeProperty("margin-bottom");
    //         target.style.removeProperty("overflow");
    //         target.style.removeProperty("transition-duration");
    //         target.style.removeProperty("transition-property");
    //     }, duration);
    // };
    // const slideDown = (target, duration = ANIMATION_DURATION) => {
    //     const { parentElement } = target;
    //     parentElement.classList.add("open");
    //     target.style.removeProperty("display");
    //     let { display } = window.getComputedStyle(target);
    //     if (display === "none") display = "block";
    //     target.style.display = display;
    //     const height = target.offsetHeight;
    //     target.style.overflow = "hidden";
    //     target.style.height = 0;
    //     target.style.paddingTop = 0;
    //     target.style.paddingBottom = 0;
    //     target.style.marginTop = 0;
    //     target.style.marginBottom = 0;
    //     target.offsetHeight;
    //     target.style.boxSizing = "border-box";
    //     target.style.transitionProperty = "height, margin, padding";
    //     target.style.transitionDuration = `${duration}ms`;
    //     target.style.height = `${height}px`;
    //     target.style.removeProperty("padding-top");
    //     target.style.removeProperty("padding-bottom");
    //     target.style.removeProperty("margin-top");
    //     target.style.removeProperty("margin-bottom");
    //     window.setTimeout(() => {
    //         target.style.removeProperty("height");
    //         target.style.removeProperty("overflow");
    //         target.style.removeProperty("transition-duration");
    //         target.style.removeProperty("transition-property");
    //     }, duration);
    // };

    // const slideToggle = (target, duration = ANIMATION_DURATION) => {
    //     if (window.getComputedStyle(target).display === "none")
    //         return slideDown(target, duration);
    //     return slideUp(target, duration);
    // };

    // const PoppersInstance = new Poppers();

    /**
     * wait for the current animation to finish and update poppers position
     */
    // const updatePoppersTimeout = () => {
    //     setTimeout(() => {
    //         PoppersInstance.updatePoppers();
    //     }, ANIMATION_DURATION);
    // };

    /**
     * sidebar collapse handler
     */
    // document.getElementById("btn-collapse").addEventListener("click", () => {
    //     SIDEBAR_EL.classList.toggle("collapsed");
    //     PoppersInstance.closePoppers();
    //     if (SIDEBAR_EL.classList.contains("collapsed"))
    //         FIRST_SUB_MENUS_BTN.forEach((element) => {
    //             element.parentElement.classList.remove("open");
    //         });

    //     updatePoppersTimeout();
    // });

    /**
     * sidebar toggle handler (on break point )
     */
    // document.getElementById("btn-toggle").addEventListener("click", () => {
    //     SIDEBAR_EL.classList.toggle("toggled");

    //     updatePoppersTimeout();
    // });

    /**
     * toggle sidebar on overlay click
     */
    // document.getElementById("overlay").addEventListener("click", () => {
    //     SIDEBAR_EL.classList.toggle("toggled");
    // });

    // const defaultOpenMenus = document.querySelectorAll(".menu-item.sub-menu.open");

    // defaultOpenMenus.forEach((element) => {
    //     element.lastElementChild.style.display = "block";
    // });

    /**
     * handle top level submenu click
     */
    // FIRST_SUB_MENUS_BTN.forEach((element) => {
    //     element.addEventListener("click", () => {
    //         if (SIDEBAR_EL.classList.contains("collapsed"))
    //             PoppersInstance.togglePopper(element.nextElementSibling);
    //         else {
    //             const parentMenu = element.closest(".menu.open-current-submenu");
    //             if (parentMenu)
    //                 parentMenu
    //                     .querySelectorAll(":scope > ul > .menu-item.sub-menu > a")
    //                     .forEach(
    //                         (el) =>
    //                             window.getComputedStyle(el.nextElementSibling).display !==
    //                             "none" && slideUp(el.nextElementSibling)
    //                     );
    //             slideToggle(element.nextElementSibling);
    //         }
    //     });
    // });

    /**
     * handle inner submenu click
     */
    // INNER_SUB_MENUS_BTN.forEach((element) => {
    //     element.addEventListener("click", () => {
    //         slideToggle(element.nextElementSibling);
    //     });
    // });

    $('.btn-wishlist').click(function () {
        let id = $(this).data('id');

        console.log(id)
        $.ajax({
            url: base_url + '/home/whiteList',
            type: 'post',
            dataType: 'json',
            data: {
                id
            },
            beforeSend: function () {

            },
            success: function (data) {
                // console.log(data)

                if (data == 'login') {
                    window.location.replace(base_url + '/auth?url=' + window.location.href);
                }


            }
        })
        $(this).toggleClass('text-danger')


    })

    // whatsapp
    popupWhatsApp = () => {

        let btnClosePopup = document.querySelector('.closePopup');
        let btnOpenPopup = document.querySelector('.whatsapp-button');
        let popup = document.querySelector('.popup-whatsapp');
        let sendBtn = document.getElementById('send-btn');

        btnClosePopup.addEventListener("click", () => {
            popup.classList.toggle('is-active-whatsapp-popup')
        })

        btnOpenPopup.addEventListener("click", () => {
            popup.classList.toggle('is-active-whatsapp-popup')
            popup.style.animation = "fadeIn .6s 0.0s both";
        })

        sendBtn.addEventListener("click", () => {
            let msg = document.getElementById('whats-in').value;
            let relmsg = msg.replace(/ /g, "%20");
            //just change the numbers "1515551234567" for your number. Don't use +001-(555)1234567     
            window.open('https://wa.me/+6282114179247?text=' + relmsg, '_blank');

        });

        // setTimeout(() => {
        //     popup.classList.toggle('is-active-whatsapp-popup');
        // }, 3000);
    }

    popupWhatsApp();
    // whatsapp


    loadTotalSelected()
    function loadTotalSelected() {
        $.ajax({
            url: base_url + '/product/loadTotalSelected',
            type: 'post',
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (data) {
                $('.totalQty').html('0');
                $('.totalPrice').html('0');
                $('.totalQty').html(data.qty);
                $('.totalPrice').html("Rp " + rupiah(data.total));
            }
        })
    }












})


