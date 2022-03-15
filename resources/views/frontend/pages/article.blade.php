@extends('frontend.master')
@section('content')

<section id="aa-catg-head-banner">
    <div>
      <div class="top-bn">
        <div class="overlay">
        <h2 style="color: #fff; text-align: center; font-size: 4rem; line-height: 300px ">Bài viết nổi bật</h2>
        </div>
      </div>
    </div>
  </section>

  <section id="aa-blog-archive">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-blog-archive-area aa-blog-archive-2">
            <div class="row">             
        
                <div class="aa-blog-content">
                  <div class="row">
                  @foreach ($article as $item)
                  <div class="col-md-4 col-sm-4">
                      <article class="aa-latest-blog-single">
                        <figure class="aa-blog-img">                    
                          <a href="{!! url('bai-viet',$item->slug) !!}"><img src="{!! asset('images/article/'.$item->image) !!}"  style="width: 450px; height: 220px;"></a>  
                            <figcaption class="aa-blog-img-caption">
                            <span href="{!! url('bai-viet',$item->slug) !!}"><i class="fa fa-clock-o"></i>{!! $item->created_at !!}</span>
                          </figcaption>                          
                        </figure>
                        <div class="aa-blog-info">
                          <h3 class="aa-blog-title"><a href="{!! url('bai-viet',$item->slug) !!}">{!! $item->title !!}</a></h3>
                          <p>{!! cut($item->summary,100) !!}</p> 
                          <a class="aa-read-mor-btn" href="{!! url('bai-viet',$item->slug) !!}">Xem tiếp <span class="fa fa-long-arrow-right"></span></a>
                        </div>
                      </article>
                    </div>
                @endforeach            
                  </div>
                </div>
                <!-- Blog Pagination -->
                <div class="aa-blog-archive-pagination">
                  <nav>
                    <ul class="pagination">
                    @if ($article->currentPage() != 1)
                      <li>
                        <a href="{!! str_replace('/?','?',$article->url($article->currentPage() - 1)) !!}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                    @endif
                    @for ($i = 1; $i <=  $article->lastPage(); $i++)
                      <li class="{!! ($article->currentPage() == $i)? 'active':'' !!}"><a href="{!! str_replace('/?','?',$article->url($i)) !!}">{!! $i !!}</a></li>
                    @endfor
                    @if ($article->currentPage() != $article->lastPage())
                      <li>
                        <a href="{!! str_replace('/?','?',$article->url($article->currentPage() + 1)) !!}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    @endif
                      
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    </section>
<!-- Footer -->
@include('frontend.blocks.footer')
<!-- / Footer -->
@stop