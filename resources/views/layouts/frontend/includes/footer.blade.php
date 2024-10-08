<footer class=" hidden-print">
    <div id="store-policy">
        <div class="container">
            <div class="row text-center">
                <div class="col-xl-3 col-sm-6 col-6 policy-item">
                    <label for=""><i class="fas fa-truck"></i></label>
                    <p class="mb-0">ส่งฟรีทั่วประเทศ เมื่อซื้อของ </p>
                    <p class="mb-0">ตั้งแต่ 3000 บาทขึ้นไป</p>
                </div>
                <div class="col-xl-3 col-sm-6 col-6 policy-item">
                    <label for=""><i class="fas fa-clock"></i></label>
                    <p class="mb-0">ซื้อของออนไลน์ได้ </p>
                    <p class="mb-0"> ตลอด 24 ชั่วโมง</p>
                </div>
                <div class="col-xl-3 col-sm-6 col-6 policy-item">
                    <label for=""><i class="fas fa-shipping-fast"></i></label>
                    <p class="mb-0"> รับสินค้า รวดเร็ว </p>
                    <p class="mb-0"> ทันใจ</p>
                </div>
                <div class="col-xl-3 col-sm-6 col-6 policy-item">
                    <label for=""><i class="fas fa-phone-volume"></i></label>
                    <p class="mb-0">E-SHOPPING </p>
                    <p class="mb-0"> 02-222-222</p>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-subscribe-wrap" class="">
        <div class="layer d-flex">
            <div class="footer-subscribe-text col-xl-2 offset-xl-3 col-lg-3 offset-lg-2 col-xs-12  text-center">
                <p class="text-top">สมัครสมาชิกเพื่อรับข่าวสาร</p>
                <p class="text-middle">และโปรโมชั่นดีๆ จาก</p>
                <h1>PP Electric</h1>
            </div>
            <div class="footer-subscribe-form col-xl-7 col-lg-7 col-xs-12 d-flex align-items-center">
                <form action="" class="w-100">
                    <div class="form-row">
                        <div class="col-xl-5 mb-0">
                            <input type="text" class="form-control mx-xl-5" placeholder="สมัครสมาชิกรับข่าวสาร">
                        </div>
                        <div class="col-xl-3 mb-0">
                            <button class="btn btn-danger mx-xl-5" type="submit">รับข่าวสาร</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="footer-top" class="container-fluid  isDesktop">
        <div class="row inner">
            <div class="col-2">
                <h3 class="footer-top-title">{{ __('main.word.shoping_online')}}</h3>
                <ul class="footer-top-menu">
                    <li><a href="{{ route('promotion') }}">{{ __('main.word.promotions')}}</a></li>
                    <li><a href="{{ route('customer.index') }}">{{ __('main.word.my-profile')}}</a></li>
                    @foreach (row_footer('footer_column_one') as $row_help)
                        <li><a href="{{ route('help.show' , $row_help->slug) }}">{{ $row_help->title }}</a></li>
                    @endforeach
                    @foreach (row_footer('term') as $row_term)
                        <li><a href="{{ route('term' , $row_term->slug) }}">{{ $row_term->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-3">
                <h3 class="footer-top-title">{{ __('main.word.categories')}}</h3>
                <ul class="footer-top-menu">
                    @foreach ($cates_footer as $cate_footer)
                    <li><a href="{{ route('categories.show' , $cate_footer->slug)}}">{{ $cate_footer->name }}</a></li>
                    @endforeach
                </ul>
                {{-- <ul class="footer-top-menu">
                    <li><a href="">โปรโมชั่น</a></li>
                    <li><a href="">บัญชีของฉัน</a></li>
                    <li><a href="">วิธีการสั่งซื้อ</a></li>
                </ul> --}}
            </div>
            <div class="col-2">
                <h3 class="footer-top-title">{{ __('main.word.brands')}}</h3>
                <ul class="footer-top-menu">
                    @foreach ($brands_footer as $brand_footer)
                    <li><a href="{{ route('brands.show' , $brand_footer->slug) }}">{{ $brand_footer->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-2">
                <h3 class="footer-top-title">{{ __('main.word.about_company')}}</h3>
                <ul class="footer-top-menu mb-4">
                    
                    @foreach (row_footer('footer_column_three') as $row_footer_three)
                        <li><a href="{{ route('about' , $row_footer_three->slug) }}">{{ $row_footer_three->title }}</a></li>
                    @endforeach
                </ul>
                <div style="clear:both"></div>
                <h3 class="footer-top-title">{{ __('main.word.knowledges')}}</h3>
                <ul class="footer-top-menu">
                    @foreach ($knowledge_categories_footer as $knowledge_category)
                    <li><a href="{{ route('knowledge.category' , $knowledge_category->slug) }}">{{
                            $knowledge_category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-3 text-center">
                <div>
                    <h5><span>PP ELECTRIC</span> <span>E-SHOPPING</span> </h5>

                    <img src="{{ \Storage::url(getSetting($value = 'site_logo')) }}" class="mt-2 mb-2" height="100px" alt="">

                </div>
                <div class="footer-social">
                   
                    <a href="https://www.instagram.com/{{ getSetting($value = 'social_instagram') }}"><i class="fab fa-instagram" style="color:#38add5;font-size:30px"></i></a>
                    <a href="https://www.youtube.com/channel/{{ getSetting($value = 'social_youtube') }}"><i class="fab fa-youtube" style="color:#38add5;font-size:30px"></i></a>
                    <a href="https://www.facebook.com/{{ getSetting($value = 'social_faceook') }}"><i class="fab fa-facebook-square" style="color:#38add5;font-size:30px"></i></a>
                </div>

            </div>
        </div>
    </div>
    <div id="footer-bottom" class="d-flex align-items-center justify-content-center text-center">
        © {{ __('main.word.Copyright')}} 2561 l PP ELECTRIC เลขทะเบียนพาณิชย์อิเล็กทรอนิกส์ : {{ getSetting($value = 'shop_no') }}
    </div>
    <div class="footer-callto d-flex isMobile" style="position: fixed;bottom: 0;width: 100%;z-index:9999;"> 
        <a href="https://line.me/R/ti/p/{{ getSetting($value = 'social_line') }}" class="d-flex col-3 justify-content-center align-content-center" style="background-color:#00b900;">
            <div><i class="fab fa-line" style="padding: 7px;font-size: 20px;color:white;"></i></div>
        </a>
        <a href="mailto:{{ getSetting($value = 'site_email') }}" class="d-flex col-3 justify-content-center align-content-center"  style="background-color:#0092b3;">
            <div><i class="far fa-envelope" style="padding: 7px;font-size: 20px;color:white;"></i></div>
        </a>
        <a href="{{ getSetting($value = 'social_faceook') }}" target="_blank" class="d-flex col-3 justify-content-center align-content-center" style="background-color:#3C5A99;">              
            <div><i class="fab fa-facebook-f" style="padding: 7px;font-size: 20px;color:white;"></i></div>
        </a>
        <a href="tel:{{ getSetting($value = 'site_telephone') }}" class="d-flex col-3 justify-content-center align-content-center" style="background-color:#fc5345;">              
            <div><i class="fas fa-phone" style="padding: 7px;font-size: 20px;color:white;"></i></div>
        </a>        
    
    </div>
</footer>
<!-- Modal -->
<div class="modal fade" id="compareAjax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg-compare" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.word.compare_product')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body compare-modal-body">
            <div class="compareContent">
                <div class="content">
                    <div class="row no-gutters contentPop">
                        <div class="col-3 compareItemParent relPos">
                            <ul class="product">
                                <li class=" relPos compHeader">
                                    <p class="align-items-center">รูปภาพ</p>
                                </li>
                                <li>ชื่อสินค้า</li>
                                <li>ราคา</li>
                                <li>ค่าจัดส่ง</li>
                                <li class="cpu">ข้อมูล</li>
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
      </div>
     
    </div>
  </div>
</div>
<div class="content-compare">{{ __('main.word.compare_product')}} </div>


<!-- Modal -->
<div class="modal fade" id="WarningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('main.word.compare_product')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>{{ __('main.word.compare_product')}}ได้ไม่เกิน 3 รายการ</h4>
      </div>
    </div>
  </div>
</div>
    <!--  end of warning model  -->
