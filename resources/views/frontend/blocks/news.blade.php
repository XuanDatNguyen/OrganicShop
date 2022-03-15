
  <!-- Latest Blog -->
  <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>Bài viết gần đây</h2>
            <div class="row">
              <!-- single latest blog -->
              <?php $article = DB::table('articles')->orderBy('id','desc')->take(3)->get(); ?>
              @foreach ($article as $item)
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="{!! url('bai-viet',$item->slug) !!}"><img src="{!! asset('images/article/'.$item->image) !!}" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <br>
                      <span href="#"><i class="fa fa-clock-o"></i><p>{!!date("d-m-Y", strtotime("$item->created_at"))!!}</p></span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="{!! url('bai-viet',$item->slug) !!}">{!! $item->title !!}</a></h3>
                    <p>{!! $item->summary !!}</p> 
                    <a href="{!! url('bai-viet',$item->slug) !!}" class="aa-read-mor-btn">Xem tiếp <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              @endforeach 
              
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section>
  <!-- / Latest Blog -->