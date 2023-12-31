<div class="container">
  <div class="card">
    <div class="card-header text-uppercase text-center">
      danh sách Danh mục
    </div>
    <div class="card-body">
      <div class="">
        <a class="btn btn-success" href="<?php echo base_url('Category/create') ?>">Thêm danh mục</a>
        <hr>
      </div>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Slug</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Quản lý</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($Category as $key  => $value) {
          ?>
            <tr>
              <th scope="row"><?php echo $value->categoriesID ?></th>
              <td><?php echo $value->categoriesName ?></td>
              <td><?php echo $value->slug ?></td>
              <td>
                <?php
                if ($value->status == 1) {
                  echo "<span class='text text-primary'>Hiển thị</span>";
                } else {
                  echo "<span class='text text-warning'>Không hiển thị</span>";
                }
                ?>
              </td>


              <td>
                <a href="<?php echo base_url('Category/edit/' . $value->categoriesID) ?>" class="btn btn-warning">Sửa</a>
                <a onclick="return confirm('Bạn chắc chắn muốn xóa không?')" href="<?php echo base_url('Category/delete/' . $value->categoriesID) ?>" class="btn btn-danger">Xóa</a>

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