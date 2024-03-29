  <!-- Hero Section Begin -->
  <section class="hero">
      <div class="container">
          <div class="row">
              <?php
                $this->load->view('Pages/Template/Sidebar');
                ?>
          </div>
      </div>
  </section>
  <!-- Hero Section End -->

  <section class="featured spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title">
                      <h2>SẢN PHẨM XE HƠI BÁN CHẠY </h2>
                  </div>
              </div>
          </div>

          <div class="row featured__filter mt-4">
              <?php
                foreach ($ProductCarHot as $key => $productCarHot) {
                ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                      <form action="<?php echo base_url('them-gio-hang') ?>" method="post">
                          <div class="featured__item">
                              <input type="hidden" value="<?php echo $productCarHot->productCarID ?>" name="product_id">
                              <input type="hidden" value="1" name="quantity">
                              <div class="featured__item__pic set-bg rounded">
                                  <img src="<?php echo base_url('uploads/productCar/' . $productCarHot->thumnail) ?>" alt="" width="100%" height="100%">
                                  <ul class="featured__item__pic__hover">
                                      <li><button href="#" class="btn btn-primary"><i class="fa fa-heart"></i></button></li>
                                      <li><button href="#" class="btn btn-success"><i class="fa fa-retweet"></i></button></li>
                                      <?php
                                        if ($productCarHot->quantity > 0) {
                                        ?>
                                          <li><button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i></button></li>
                                      <?php
                                        }
                                        ?>
                                  </ul>
                              </div>
                              <div class="featured__item__text">
                                  <h6><a href="<?php echo base_url('san-pham/' . $productCarHot->productCarID . '/' . $productCarHot->slug) ?>" class="text-uppercase"><?php echo $productCarHot->productCarName ?></a></h6>
                                  <h5>Giá: <?php echo number_format($productCarHot->price) . 'VNĐ' ?> </h5>
                              </div>
                          </div>
                      </form>
                  </div>
              <?php
                }
                ?>
              <!-- <?php
                    // echo $links;
                    ?> -->
          </div>



      </div>
  </section>
  <!-- Featured Section End -->



  <!-- Featured Section Begin -->
  <section class="featured spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title">
                      <h2>SẢN PHẨM XE HƠI </h2>
                  </div>
              </div>
          </div>

          <div class="row">
              <h6>Lọc sản phẩm:</h6>
              <div class="col-md-5">
                  <div class="form-group">
                      <select class="form-control select-filter" name="" id="select-filter">
                          <option value="0">Lọc theo</option>
                          <option value="?kytu=asc">Ký tự A-Z</option>
                          <option value="?kytu=desc">Ký tự Z-A</option>
                          <option value="?gia=asc">Giá Tăng dần</option>
                          <option value="?gia=desc">Giá giảm dần</option>
                      </select>
                  </div>
              </div>

              <div class="col-md-5">
                  <form method="get">
                      <p>
                          <label for="amount">Lọc giá:</label>
                          <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold; width:80%;">
                      </p>
                      <div id="slider-range"></div>
                      <input type="hidden" class="price_from" name="from">
                      <input type="hidden" class="price_to" name="to">

                      <input type="submit" value="Lọc giá" class="btn btn-primary filter-price mt-3">
                  </form>
              </div>
          </div>

          <div class="row featured__filter mt-4">
              <?php
                foreach ($AllProductCar as $key => $productCar) {
                ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                      <form action="<?php echo base_url('them-gio-hang') ?>" method="post">
                          <div class="featured__item">
                              <input type="hidden" value="<?php echo $productCar->productCarID ?>" name="product_id">
                              <input type="hidden" value="1" name="quantity">
                              <div class="featured__item__pic set-bg rounded">
                                  <img src="<?php echo base_url('uploads/productCar/' . $productCar->thumnail) ?>" alt="" width="100%" height="100%">
                                  <ul class="featured__item__pic__hover">
                                      <li><button href="#" class="btn btn-primary"><i class="fa fa-heart"></i></button></li>
                                      <li><button href="#" class="btn btn-success"><i class="fa fa-retweet"></i></button></li>
                                      <?php
                                        if ($productCar->quantity > 0) {
                                        ?>
                                          <li><button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i></button></li>
                                      <?php
                                        }
                                        ?>
                                  </ul>
                              </div>
                              <div class="featured__item__text">
                                  <h6><a href="<?php echo base_url('san-pham/' . $productCar->productCarID . '/' . $productCar->slug) ?>" class="text-uppercase"><?php echo $productCar->productCarName ?></a></h6>
                                  <h5>Giá: <?php echo number_format($productCar->price) . 'VNĐ' ?> </h5>
                              </div>
                          </div>
                      </form>
                  </div>
              <?php
                }
                ?>
              <!-- <?php
                    // echo $links;
                    ?> -->
          </div>



      </div>
  </section>
  <!-- Featured Section End -->
  <!-- danh mục từng sản phẩm -->

  <section class="featured spad">
      <div class="container">
          <div class="row">

              <?php
                foreach ($itemsAutomaker as $key => $items) {


                ?>
                  <div class="col-lg-12">
                      <div class="section-title">
                          <h2 class="text-uppercase"><?php echo $key ?></h2>
                      </div>
                  </div>
          </div>


          <div class="row featured__filter mt-4">
              <?php
                    foreach ($items as $items_pro) {
                ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                      <form action="<?php echo base_url('them-gio-hang') ?>" method="post">
                          <div class="featured__item">
                              <input type="hidden" value="<?php echo $items_pro['productCarID'] ?>" name="product_id">
                              <input type="hidden" value="1" name="quantity">
                              <div class="featured__item__pic set-bg rounded">
                                  <img src="<?php echo base_url('uploads/productCar/' . $items_pro['thumnail']) ?>" alt="" width="100%" height="100%">
                                  <ul class="featured__item__pic__hover">
                                      <li><button href="#" class="btn btn-primary"><i class="fa fa-heart"></i></button></li>
                                      <li><button href="#" class="btn btn-success"><i class="fa fa-retweet"></i></button></li>
                                      <?php
                                        if ($items_pro['quantity'] > 0) {
                                        ?>
                                          <li><button type="submit" class="btn btn-warning"><i class="fa fa-shopping-cart"></i></button></li>
                                      <?php
                                        }
                                        ?>
                                  </ul>
                              </div>
                              <div class="featured__item__text">
                                  <h6><a href="<?php echo base_url('san-pham/' . $items_pro['productCarID'] . '/' . $items_pro['slug']) ?>" class="text-uppercase"><?php echo $items_pro['productCarName'] ?></a></h6>
                                  <h5>Giá: <?php echo number_format($items_pro['price']) . 'VNĐ' ?> </h5>
                              </div>
                          </div>
                      </form>
                  </div>
              <?php
                    }
                ?>


          <?php
                }
            ?>
          </div>


      </div>
  </section>


  <!-- end -->


  <!-- Blog Section Begin -->
  <section class="from-blog spad">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title from-blog__title">
                      <h2>Tin tức</h2>
                  </div>
              </div>
          </div>
          <div class="row">
              <?php
                foreach ($All_post as $key => $value) {
                ?>
                  <div class="col-lg-4 col-md-4 col-sm-6">
                      <div class="blog__item">
                          <div class="blog__item__pic">
                              <img src="<?php echo base_url('./frontend/img/blog/' . $value->image) ?>" alt="">
                          </div>
                          <div class="blog__item__text">

                              <h5><a href="<?php echo base_url('bai-viet/' . $value->id . '/' . $value->slug) ?>"><?php echo $value->title ?></a></h5>
                              <p><?php echo $value->description ?></p>
                          </div>
                      </div>
                  </div>
              <?php
                }
                ?>
          </div>
      </div>
  </section>
  <!-- Blog Section End -->