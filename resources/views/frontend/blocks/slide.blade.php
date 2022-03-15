  <!-- Start slider -->
  <div class="row">
    <div class="col-12">
      <section id="aa-slider" class="container">
        <div class="aa-slider-area ">
          <div id="sequence" class="seq">
            <div class="seq-screen">
              <ul class="seq-canvas">
                <!-- single slide item -->
                <?php 
                $data = DB::table('banners')->where('status',1)->get();
                ?>
                @foreach ($data as $item)
                <li>
                  <div class="seq-model">
                    <img data-seq src="{!! asset('images/banner/' . $item->image) !!}" alt="slide" style="height: 320px;"/>
                  </div>
                </li>
                @endforeach              
              </ul>
            </div>
            <!-- slider navigation btn -->
            <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons" style="margin-top:-150px;">
              <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
              <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
            </fieldset>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- / slider -->