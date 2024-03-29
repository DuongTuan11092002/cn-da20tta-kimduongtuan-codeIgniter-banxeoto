<div class="container">
  <div class="card">
    <div class="card-header text-uppercase text-center">
      danh sách chi tiết Sản phẩm
    </div>

    <form method="GET" action="<?php echo base_url('search-productDetail') ?>" class="mt-4 pl-4 mb-4">
      <label for="">Tìm kiếm chi tiết sản phẩm xe</label>
      <input type="text" name="keyword" placeholder="Tìm kiếm">
      <button type="submit" class="btn btn-primary">TÌM KIẾM</button>
    </form>
    <div class="card-body">
      <div class="">
        <a href="<?php echo base_url('productCarDetail/create') ?>" class="btn btn-success">Thêm sản phẩm</a>
        <hr>
      </div>

      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên tiêu đề</th>
            <th scope="col">Mô tả về động cơ</th>
            <th scope="col">Mô tả về nội thất </th>
            <th scope="col">Mô tả về Công nghệ </th>
            <th scope="col">Sản phẩm xe</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Quản lý</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          foreach ($productDetail as $key  => $value) {
            $i++;
          ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>
              <td><?php echo $value->productCarDetailName ?></td>
              <td class="an"><?php echo $value->productCarDetailTextEngine ?></td>
              <td class="an"><?php echo $value->productCarDetailTextInterio ?></td>
              <td class="an"><?php echo $value->productCarDetailTextTechniques ?></td>
              <td><?php echo $value->tensanpham ?></td>

              <td>
                <img src="<?php echo base_url('/uploads/libraryDetail/' . $value->images) ?>" alt="" width="150" height="150">
              </td>

              <td>
                <a href="<?php echo base_url('productCarDetail/edit/' . $value->productCarDetailID) ?>" class="btn btn-warning">Sửa</a><br>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa không?')" href="<?php echo base_url('productCarDetail/delete/' . $value->productCarDetailID) ?>" class="btn btn-danger">Xóa</a>

              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>


    </div>
  </div>

</div>