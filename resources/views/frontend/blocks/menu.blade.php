
<div class="navbar-collapse collapse">
  <ul class="nav navbar-nav">
    <li><a href="{!! url('/') !!}" style="font: 20px roboto, sans-serif; font-weight: 600">Trang chủ</a></li>
    <?php 
      $group =  DB::table('groups')->get();
     ?>
    @foreach ($group as $menu_1)
    <li><a href="{!! url('nhom-thuc-pham',$menu_1->slug) !!}" style="font: 20px roboto, sans-serif; font-weight: 500">{!! $menu_1->name !!}</a>
      <?php 
          $category = DB::table('categories')->where('group_id',$menu_1->id)->get();
       ?>
      <ul class="dropdown-menu">
      @foreach ($category as $menu_2)
         <li><a href="{!! url('loai-san-pham',$menu_2->slug) !!}" style="font: 20px roboto, sans-serif; ">{!! $menu_2->name !!}</a></li>             
      @endforeach                             
      </ul>
    </li>
    @endforeach
    <li><a href="{!! url('bai-viet') !!}" style="font: 20px roboto, sans-serif; font-weight: 500">Bài viết</a></li>            
    <li><a href="{!! url('lien-he') !!}" style="font: 20px roboto, sans-serif; font-weight: 500">Liên hệ</a></li>
  </ul>
</div>