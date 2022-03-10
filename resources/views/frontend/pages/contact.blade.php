@extends('frontend.master')
@section('content')
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <div>
      <div class="top-bn">
        <div class="overlay">
          <h2 style="color: #fff; text-align: center; font-size: 4rem; line-height: 300px ">Liên hệ</h2>
        </div>
      </div>
    </div>
  </section>

  </section>
  <!-- / product category -->
  <!-- start contact section -->
 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="aa-contact-area">
           <div class="aa-contact-top">
             <h2 style="font:30px tahoma, sans-serif; color:green;">Hãy để lại thắc mắc của bạn cho Organic</h2>
             <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, quos.</p> -->
           </div>
           <!-- contact map -->
           <!-- Contact address -->
           <div class="aa-contact-address">
             <div class="row">
               <div class="col-md-8">
                 <div class="aa-contact-address-left">
                   <form class="comments-form contact-form" action="{!! url('/lien-he-test') !!}" method="POST">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="text" name="txtName" placeholder="Your Name" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">                        
                          <input type="email" name="txtMail" placeholder="Email" class="form-control">
                        </div>
                      </div>
                    </div>                  
                     
                    <div class="form-group">                        
                      <textarea class="form-control" name="txtContent" rows="3" placeholder="Message"></textarea>
                    </div>
                    <button class="aa-secondary-btn">Gửi</button>
                  </form>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="aa-contact-address-right" style="font: tahoma, sans-serif;">
                   <address>
                    <a href="{!! URL('/') !!}" class="aa-logo">
                      <p style="font-weight: bold;"> <strong class="text-success">Organic</strong>Shop</p>
                    </a>
                     <p>Vì một cuộc sống xanh!</p>
                     <p><span class="fa fa-phone"></span>0123.456.888</p>
                     <p><span class="fa fa-envelope"></span>Email: cskh@organicshop.com</p>
                   </address>
                 </div>
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