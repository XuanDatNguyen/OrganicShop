<div class="aa-sidebar-widget">
  <h3>Bài viết mới</h3>
  <div class="aa-recently-views">
  <?php $article = DB::table('articles')->orderBy('id','desc')->take(3)->get(); ?>
    <ul>
    @foreach ($article as $item)
      <li>
        <a href="{!! url('bai-viet',$item->slug) !!}"><img src="{!! asset('images/article/'.$item->image) !!}" alt="img"  style="width: 80px; height: 80px;"></a>
        <div class="aa-cartbox-info">
          <h4><a href="{!! url('bai-viet',$item->slug) !!}">{!! $item->title !!}</a></h4>
          <p>{{date("d-m-Y", strtotime("$item->created_at"))}}</p>
        </div>                    
      </li>
    @endforeach                                         
    </ul>
  </div>                            
</div>