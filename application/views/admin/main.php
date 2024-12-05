  <div class="app-main__outer">
      <div class="app-main__inner">
          <section id="fancyTabWidget" class="tabs t-tabs">
              <ul class="nav nav-tabs fancyTabs" role="tablist">
                  <li class="tab fancyTab active">
                      <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                      </div>
                      <a id="tab0" href="#tabBody0" role="tab" aria-controls="tabBody0" aria-selected="true" data-toggle="tab" tabindex="0">
                          <span class="fa fa-pills"></span>
                          <span class="hidden-xs">Obat Keluar</span>
                      </a>
                      <div class="whiteBlock"></div>
                  </li>

                  <li class="tab fancyTab">
                      <div class="arrow-down">
                          <div class="arrow-down-inner"></div>
                      </div>
                      <a id="tab1" href="#tabBody1" role="tab" aria-controls="tabBody1" aria-selected="true" data-toggle="tab" tabindex="0">
                          <!-- <span class="fas fa-sign-out-alt"></span> -->
                          <span class="fa fa-capsules"></span>
                          <span class="hidden-xs">Obat Masuk</span>
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
                                          <h3 class="card-title text-center">Form Obat Keluar Klinik Marturia</h3>
                                      </div>

                                      <div class="row">
                                          <div class="col-sm-6 p-5">
                                              <form>
                                                  <div class="form-group row">
                                                      <label for="staticEmail" class="col-sm-3 col-form-label">Kategori Obat</label>
                                                      <div class="col-sm-9">
                                                          <select name="" class="form-control" id="kategori">
                                                              <option value="">Pilih Kategori Obat</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label for="inputPassword" class="col-sm-3 col-form-label">Nama Obat</label>

                                                      <div class="col-sm-9">
                                                          <select name="" class="form-control" id="namaObat">
                                                              <option value="">Pilih Nama Obat</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label for="inputPassword" class="col-sm-3 col-form-label">Jumlah</label>

                                                      <div class="col-sm-9">
                                                          <input type="number" class="form-control jumlahObat" placeholder="Masukan Jumlah Obat" />
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label for="inputPassword" class="col-sm-3 col-form-label">Keterangan</label>

                                                      <div class="col-sm-9">
                                                          <textarea class="form-control keterangan" name="Keterangan" id="keterangan"></textarea>
                                                      </div>
                                                  </div>

                                                  <div class="row">
                                                      <div class="col text-right">
                                                          <button type="button" class="btn btn-primary submit">Submit</button>
                                                      </div>
                                                  </div>
                                              </form>
                                          </div>

                                          <div class="col-sm-4">
                                              <h3 class="d-block mt-5">
                                                  Sisa Stock :
                                                  <span class="stock"></span>
                                              </h3>
                                              <h3 class="d-block">
                                                  Status Stock :
                                                  <span class="status"></span>
                                              </h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tabBody1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0">
                      <div class="alert alert-danger">Not Available</div>
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