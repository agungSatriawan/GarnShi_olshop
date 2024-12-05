  <div class="app-main__outer">
      <div class="app-main__inner">
          <section id="fancyTabWidget" class="tabs t-tabs">
              <div class="row">
                  <div class="col">
                      <small> <?= $this->session->flashdata('message'); ?></small>
                  </div>
              </div>
              <ul class="nav nav-tabs fancyTabs" role="tablist">
                  <li class="tab fancyTab active">
                      <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                      </div>
                      <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0">
                          <h1><i class="text-secondary fa-regular fa-rectangle-list d-block"></i></h1>
                          <span class="hidden-xs">List Product</span>
                      </a>
                      <div class="whiteBlock"></div>
                  </li>

                  <li class="tab fancyTab">
                      <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                      </div>
                      <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0">
                          <!-- <span class="fas fa-sign-out-alt"></span> -->
                          <h1><i class="text-secondary fa-regular fa-rectangle-list d-block"></i></h1>
                          <span class="hidden-xs">Master Management</span>
                      </a>
                      <div class="whiteBlock"></div>
                  </li>
              </ul>

              <div id="myTabContent" class="tab-content fancyTabContent" aria-live="polite">
                  <div class="tab-pane active in" id="tabBody0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                      <div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <!-- Default box -->
                                  <div class="card">
                                      <div class="card-header">
                                          <h3 class="card-title text-center">List Product Gar&Shi</h3>
                                      </div>
                                      <div class="row justify-content-end p-3">
                                          <div class="col-sm-2">
                                              <button type="button" class="btn btn-primary addProduct" data-toggle="modal" data-target="#addProduct"><i class="fa-solid fa-plus"></i> Add Product</button>

                                          </div>
                                      </div>

                                      <div class="row justify-content-center">
                                          <div class="col-sm-11 p-3 table-responsive">
                                              <table class="table table-bordered table-hover table-striped" id="t_list_produk">
                                                  <thead>
                                                      <tr>
                                                          <th class="text-center align-middle">No</th>
                                                          <th class="text-center align-middle">Image</th>
                                                          <th class="text-center align-middle">Product Name</th>
                                                          <th class="text-center align-middle">UoM</th>
                                                          <!-- <th class="text-center align-middle">Size</th>
                                                          <th class="text-center align-middle">Color</th>
                                                          <th class="text-center align-middle">Price</th> -->
                                                          <th class="text-center align-middle">Category</th>
                                                          <th class="text-center align-middle">Description</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>

                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>


                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                      <div class="row">
                          <div class="col">
                              <div class="row justify-content-around mb-3">
                                  <div class="col"></div>
                                  <div class="col">
                                      <h5 class="mb-3 text-center">Table Master Color</h5>
                                  </div>
                                  <div class="col text-end">

                                      <button class="btn btn-primary">Add Color</button>

                                  </div>
                              </div>

                              <table class="table table-sm table-hover table-striped tabledata">
                                  <thead>
                                      <tr>
                                          <th class="text-center align-middle">No</th>
                                          <th class="text-center align-middle">Color</th>
                                          <th class="text-center align-middle">Status</th>
                                          <th class="text-center align-middle">Date Created</th>
                                          <th class="text-center align-middle">Date Modified</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $no = 1; ?>
                                      <?php foreach ($color as $c) : ?>
                                          <tr>
                                              <td class="text-center align-middle"><?= $no ?></td>
                                              <td class="align-middle"><?= $c['color'] ?></td>
                                              <td class="text-center align-middle"><?= $c['status'] == 1 ? 'Active' : 'Not Active' ?></td>
                                              <td class="text-center align-middle"><?= $c['date_created'] ?></td>
                                              <td class="text-center align-middle"><?= $c['date_modified'] ?></td>
                                          </tr>
                                          <?php $no++; ?>
                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="row mt-3">

                          <div class="col">
                              <h5 class="mb-3 text-center">Table Master Size</h5>
                              <table class="table table-sm table-hover table-striped tabledata">
                                  <thead>
                                      <tr>
                                          <th class="text-center align-middle">No</th>
                                          <th class="text-center align-middle">Size</th>
                                          <th class="text-center align-middle">Status</th>
                                          <th class="text-center align-middle">Date Created</th>
                                          <th class="text-center align-middle">Date Modified</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $no = 1; ?>
                                      <?php foreach ($size as $c) : ?>
                                          <tr>
                                              <td class="text-center align-middle"><?= $no ?></td>
                                              <td class="align-middle"><?= $c['size'] ?></td>
                                              <td class="text-center align-middle"><?= $c['status'] == 1 ? 'Active' : 'Not Active' ?></td>
                                              <td class="text-center align-middle"><?= $c['date_created'] ?></td>
                                              <td class="text-center align-middle"><?= $c['date_modified'] ?></td>
                                          </tr>
                                          <?php $no++; ?>
                                      <?php endforeach; ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      <div class="app-wrapper-footer">
          <div class="app-footer">
              <div class="app-footer__inner">
                  <div class="app-footer-left">
                      <ul class="nav">
                          <li class="nav-item">
                              <!-- <a href="javascript:void(0);" class="nav-link">Footer Link 1</a> -->
                          </li>
                          <li class="nav-item">
                              <!-- <a href="javascript:void(0);" class="nav-link">Footer Link 2</a> -->
                          </li>
                      </ul>
                  </div>
                  <div class="app-footer-right">
                      <ul class="nav">
                          <li class="nav-item">
                              <!-- <a href="javascript:void(0);" class="nav-link">Footer Link 3</a> -->
                          </li>
                          <li class="nav-item">
                              <a href="javascript:void(0);" class="nav-link">
                                  <div class="badge badge-success mr-1 ml-0">
                                      <!-- <small>NEW</small> -->
                                  </div>
                                  <!-- Footer Link 4 -->
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <!-- <span aria-hidden="true">&times;</span> -->
                  </button>
              </div>
              <?= form_open_multipart('admin/addProduct', ['name' => 'addProduct']) ?>
              <div class="modal-body">

                  <div class="row justify-content-center">
                      <div class="col-sm-4">
                          <a href="" target="_blank">
                              <img name="preview" class="preview_product_image" src="" alt="" id="" width="250">
                          </a>
                      </div>


                      <div class="col-sm-12 ">
                          <div class="row pose-image">

                          </div>
                      </div>



                  </div>
                  <div class="row">
                      <div class="col">
                          <div class="mb-3">
                              <label class="form-label">Image</label>
                              <input type="file" name="product_image[]" multiple class="form-control images images_file getImagesFileId" data-kode="product_image" accept="image/*">
                          </div>
                      </div>
                      <div class="col">
                          <div class="mb-3">
                              <label class="form-label">Product Name</label>
                              <input type="text" name="product_name" class="form-control">
                              <?= form_error('product_name', '<small class="text-danger">', '</small>') ?>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-sm-6 overflow-auto box-category">
                          <div class="mb-3">
                              <label class="form-label">Category</label>
                              <?php foreach ($category as $c) : ?>

                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">
                                              <input type="checkbox" id="<?= $c['id'] ?>" aria-label="Checkbox for following text input" name="category[]" value="<?= $c['id'] ?>">
                                          </div>
                                      </div>
                                      <label class="form-control" aria-label="Text input with checkbox" for="<?= $c['id'] ?>"><?= $c['category'] ?></label>

                                  </div>


                              <?php endforeach; ?>


                              <?= form_error('category', '<small class="text-danger">', '</small>') ?>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                      <label class="form-label">UoM</label>
                                      <select class="form-control" name="uom" id="">
                                          <option value="">Pilih UoM</option>
                                          <?php foreach ($uom as $u) : ?>
                                              <option value="<?= $u['id'] ?>"><?= $u['uom'] ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                      <?= form_error('uom', '<small class="text-danger">', '</small>') ?>
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="mb-3">
                                      <label class="form-label">Description</label>
                                      <textarea class="form-control editor" name="desc" id="" rows="4"></textarea>
                                      <?= form_error('desc', '<small class="text-danger">', '</small>') ?>
                                  </div>
                              </div>

                          </div>
                      </div>



                  </div>

                  <div class="row my-3">
                      <div class="col">
                          <p class="text-center title-varian">Variance</p>
                      </div>
                  </div>
                  <div class="box-variasi">
                      <div class="row sizecolor">
                          <div class="col">
                              <div class="mb-3">
                                  <label class="form-label">Color</label>

                                  <select name="color[]" id="" multiple class="select2 form-control varian varian_warna">
                                      <?php foreach ($color as $c) : ?>
                                          <option value="<?= $c['id'] ?>"><?= $c['color'] ?></option>

                                      <?php endforeach; ?>
                                  </select>

                                  <?= form_error('color', '<small class="text-danger">', '</small>') ?>
                              </div>
                          </div>
                          <div class="col">
                              <div class="mb-3">
                                  <label class="form-label">Size</label>
                                  <select name="size[]" id="" class="select2 form-control varian varian_ukuran" multiple>
                                      <?php foreach ($size as $s) : ?>
                                          <option value="<?= $s['id'] ?>"><?= $s['size'] ?></option>
                                      <?php endforeach; ?>
                                  </select>

                                  <?= form_error('size', '<small class="text-danger">', '</small>') ?>
                              </div>
                          </div>
                      </div>

                      <div class="row listVarian">
                          <div class="col">
                              <table class="table table-sm table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th class="text-center align-middle">Color</th>
                                          <th class="text-center align-middle">Size</th>
                                          <th class="text-center align-middle">Price</th>
                                          <th class="text-center align-middle">Price Diskon</th>
                                          <th class="text-center align-middle">Stock</th>
                                          <th class="text-center align-middle">Keterangan</th>

                                      </tr>
                                  </thead>
                                  <tbody class="table_body_varian">



                                  </tbody>
                              </table>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <input type="text" name="price[]" class="form-control priceUpdate">
                          </div>
                      </div>
                  </div>


                  <!-- <div class=" sizecolor dynamic_variance">
                      <div class="row baru-variance mt-3">
                          <div class="col-sm-10">
                              <div class="row">
                                  <div class="col p-3">
                                      <a href="" target="_blank">
                                          <img name="preview" class="preview_image_varian" src="<?= base_url('assets/images/template.png') ?>" alt="" id="" width="100">
                                      </a>
                                  </div>
                                  <div class="col">
                                      <label class="form-label">Image</label>
                                      <input type="file" name="image_varian[]" class="form-control images images_file" data-kode="image_varian" accept="image/*">
                                  </div>

                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label">Size</label>
                                          <select name="size[]" id="" class="select2 form-control">
                                              <?php foreach ($size as $s) : ?>
                                                  <option value="<?= $s['id'] ?>"><?= $s['size'] ?></option>
                                              <?php endforeach; ?>
                                          </select>

                                          <?= form_error('size', '<small class="text-danger">', '</small>') ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label">Color</label>

                                          <select name="color[]" id="" class="select2 form-control">
                                              <?php foreach ($color as $c) : ?>
                                                  <option value="<?= $c['id'] ?>"><?= $c['color'] ?></option>

                                              <?php endforeach; ?>
                                          </select>

                                          <?= form_error('color', '<small class="text-danger">', '</small>') ?>
                                      </div>
                                  </div>
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label">Price</label>
                                          <input type="text" name="price[]" class="form-control">
                                          <?= form_error('price', '<small class="text-danger">', '</small>') ?>
                                      </div>
                                  </div>
                                  <div class="col">
                                      <div class="mb-3">
                                          <label class="form-label">Stock</label>
                                          <input type="text" name="stock[]" class="form-control">
                                          <?= form_error('stock', '<small class="text-danger">', '</small>') ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-2 mt-5">

                              <button type="button" class="btn btn-primary btn-tambah btn-tambahVariance mt-4" data-toggle="modal" data-target=""><i class="fa-solid fa-plus"></i> Add Row</button>

                              <button type="button" class="btn btn-danger btn-hapusVariance mt-4" style="display:none;" data-toggle="modal" data-target=""><i class="fa-solid fa-trash-can"></i> Delete Row</button>
                          </div>
                      </div>

                  </div> -->











              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" name="submitAddProduct" class="btn btn-primary varian">Add Product</button>
                  <button type="button" name="deleteProduct" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Delete Product</button>
              </div>
              <?= form_close() ?>
          </div>
      </div>
  </div>