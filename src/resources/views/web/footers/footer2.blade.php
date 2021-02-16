<!-- //footer style Two -->
 <footer id="footerTwo" class="footer-area footer-two footer-desktop d-none d-lg-block d-xl-block">
   <div class="container">
     <div class="row">
       <div class="col-12 col-lg-3">
         <div class="single-footer">
           <h5>@lang('website.About Store')</h5>
           <div class="row">
             <div class="col-12 col-lg-8">
               <hr>
             </div>
           </div>
           <ul class="contact-list  pl-0 mb-0">
             <li> <i class="fas fa-map-marker"></i><span>{{$result['commonContent']['setting'][4]->value}} {{$result['commonContent']['setting'][5]->value}} {{$result['commonContent']['setting'][6]->value}}, {{$result['commonContent']['setting'][7]->value}} {{$result['commonContent']['setting'][8]->value}}</span> </li>
             <li> <i class="fas fa-phone"></i><span>({{$result['commonContent']['setting'][11]->value}})</span> </li>
             <li> <i class="fas fa-envelope"></i><span> <a href="mailto:{{$result['commonContent']['setting'][3]->value}}">{{$result['commonContent']['setting'][3]->value}}</a> </span> </li>

           </ul>
         </div>
       </div>
       <div class="col-12 col-md-6 col-lg-3">
         <div class="footer-block">
             <div class="single-footer single-footer-left">
               <h5>@lang('website.Our Services')</h5>
               <div class="row">
                   <div class="col-12 col-lg-8">
                     <hr>
                   </div>
                 </div>
               <ul class="links-list pl-0 mb-0">
                 <li> <a href="{{ URL::to('/')}}"><i class="fa fa-angle-right"></i>Home</a> </li>
               <li> <a href="{{ URL::to('/shop')}}"><i class="fa fa-angle-right"></i>Shop</a> </li>
               <li> <a href="{{ URL::to('/orders')}}"><i class="fa fa-angle-right"></i>Orders</a> </li>
               <li> <a href="{{ URL::to('/viewcart')}}"><i class="fa fa-angle-right"></i>Shopping Cart</a> </li>
               <li> <a href="{{ URL::to('/wishlist')}}"><i class="fa fa-angle-right"></i>Wishlist</a> </li>
               </ul>
             </div>

         </div>
       </div>
       <div class="col-12 col-md-6 col-lg-3">
         <div class="single-footer single-footer-right">
           <h5>@lang('website.Information')</h5>
           <div class="row">
               <div class="col-12 col-lg-8">
                 <hr>
               </div>
             </div>
           <ul class="links-list pl-0 mb-0">
             @if(count($result['commonContent']['pages']))
                 @foreach($result['commonContent']['pages'] as $page)
                     <li> <a href="{{ URL::to('/page?name='.$page->slug)}}"><i class="fa fa-angle-right"></i>{{$page->name}}</a> </li>
                 @endforeach
             @endif
                 <li> <a href="{{ URL::to('/contact')}}"><i class="fa fa-angle-right"></i>@lang('website.Contact Us')</a> </li>
           </ul>
         </div>
       </div>

       <div class="col-12 col-lg-3">
         <div class="single-footer">
           @if(!empty($result['commonContent']['setting'][89]) and $result['commonContent']['setting'][89]->value==1)
             <div class="newsletter">
                 <h5>@lang('website.Subscribe for Newsletter')</h5>
                 <div class="row">
                     <div class="col-12 col-lg-8">
                       <hr>
                     </div>
                   </div>
                 <div class="block">
                     <form class="form-inline">
                         <div class="search">
                           <input type="email" name="email" id="email" placeholder="@lang('website.Your email address here')">
                           <button type="button" id="subscribe" class="btn btn-secondary">@lang('website.Subscribe')</button>
                             @lang('website.Subscribe')
                             </button>
                             <button class="btn-secondary fas fa-location-arrow" type="submit">
                             </button>
                             <div class="alert alert-success alert-dismissible success-subscribte" role="alert" style="opacity: 500; display: none;"></div>

                             <div class="alert alert-danger alert-dismissible error-subscribte" role="alert" style="opacity: 500; display: none;"></div>
                         </div>
                       </form>
                 </div>
             </div>
             @endif
             <div class="socials">
                 <h5>@lang('website.Follow Us')</h5>
                 <div class="row">
                     <div class="col-12 col-lg-8">
                       <hr>
                     </div>
                   </div>
                 <ul class="list">
                   <li>
                       @if(!empty($result['commonContent']['setting'][50]->value))
                         <a href="{{$result['commonContent']['setting'][50]->value}}" class="fab fa-facebook-f" target="_blank"></a>
                         @else
                           <a href="#" class="fab fa-facebook-f"></a>
                         @endif
                     </li>
                     <li>
                     @if(!empty($result['commonContent']['setting'][52]->value))
                         <a href="{{$result['commonContent']['setting'][52]->value}}" class="fab fa-twitter" target="_blank"></a>
                     @else
                         <a href="#" class="fab fa-twitter"></a>
                     @endif</li>
                     <li>
                     @if(!empty($result['commonContent']['setting'][51]->value))
                         <a href="{{$result['commonContent']['setting'][51]->value}}"  target="_blank"><i class="fab fa-google"></i></a>
                     @else
                         <a href="#"><i class="fab fa-google"></i></a>
                     @endif
                     </li>
                     <li>
                     @if(!empty($result['commonContent']['setting'][53]->value))
                         <a href="{{$result['commonContent']['setting'][53]->value}}" class="fab fa-linkedin-in" target="_blank"></a>
                     @else
                         <a href="#" class="fab fa-linkedin-in"></a>
                     @endif
                     </li>
                 </ul>
             </div>

         </div>
       </div>
     </div>
   </div>
   <div class="container-fluid p-0">
       <div class="copyright-content">
           <div class="container">
             <div class="row align-items-center">
                 <div class="col-12 col-md-6">
                   <div class="footer-image">
                       <img class="img-fluid" src="{{asset('web/images/miscellaneous/payments.png')}}">
                   </div>

                 </div>
                 <div class="col-12 col-md-6">
                   <div class="footer-info">
                       © 2020 Farm2Homebd.com.  <a href="{{url('/page?name=refund-policy')}}">@lang('website.Privacy')</a>&nbsp;&bull;&nbsp;<a href="{{url('/page?name=term-services')}}">@lang('website.Terms')</a>
                   </div>

                 </div>
             </div>
           </div>
         </div>
   </div>
</footer>
<style>
.registration-socials {
    display: none;
}
</style>
