
<div class="navbar-collapse collapse">
<!-- Left nav -->
  <ul class="nav navbar-nav">
    <li><a href="{!! url('/') !!}" style="font: 20px roboto, sans-serif; font-weight: 600">Trang chủ</a></li>
    <?php 
      $nhom =  DB::table('nhom')->get();
     ?>
    @foreach ($nhom as $menu_1)
    <li><a href="{!! url('nhom-thuc-pham',$menu_1->nhom_url) !!}" style="font: 20px roboto, sans-serif; font-weight: 500">{!! $menu_1->nhom_ten !!}</a>
      <?php 
          $loaisp = DB::table('loaisanpham')->where('nhom_id',$menu_1->id)->get();
       ?>
      <ul class="dropdown-menu">
      @foreach ($loaisp as $menu_2)
         <li><a href="{!! url('loai-san-pham',$menu_2->loaisanpham_url) !!}" style="font: 20px roboto, sans-serif; ">{!! $menu_2->loaisanpham_ten !!}</a></li>             
      @endforeach                             
      </ul>
    </li>
    @endforeach
    <!-- <li><a href="{!! url('khuyen-mai') !!}" style="font: 20px roboto, sans-serif; font-weight: 500">Khuyến mãi</a></li> -->
    <li><a href="{!! url('bai-viet') !!}" style="font: 20px roboto, sans-serif; font-weight: 500">Bài viết</a></li>            
    <li><a href="{!! url('lien-he') !!}" style="font: 20px roboto, sans-serif; font-weight: 500">Liên hệ</a></li>
  </ul>
</div>