<!-- BEGIN: Header -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top isMobile text-white" style="background: #37add5;">
      <a class="navbar-brand" href="{{ route('home')}}">PP ELECTRIC</a>
      <a href="javascript:void(0);" class="navbar-toggler" id="showCatemenu" >
        <span class="navbar-toggler-icon"></span>
      </a>
</nav>

<header class="container-fluid">
    <div class="row">
        <div class="pt-5 left-side " style="background:#37add5;">
            <h3 class="mb-0 text-white font-weight-normal pl-4"><i class="fas fa-cog"></i> เมนูหลัก </h3>
        </div>
        <div class="right-side d-inline-flex" style="background:#dcdddf;">
        <div class="col-6 pt-2 pt-md-5"> <h4 class="mb-0 welcome-title font-weight-normal">ยินดีต้อนรับคุณ {{ auth()->user()->name }}</h4><h6 class="mb-0 font-weight-normal">ระดับคลาสของท่าน {{ auth()->user()->type }}</h6> </div>
            <div class="col-6"> <div class="logo-radius"><span class="helper"></span><img src="{{ asset('images/logo/logo-2.png')}}" alt="" class="img-fluid"></div></div>

        </div>
    </div>
    <div class="row">
        <div class="px-5 py-3 left-side" style="background:#5fbddd;">
            <input type="text" name="" id="" placeholder="Search">
        </div>
        <div class="right-side" style="background:#f2f2f2;">

        </div>
    </div>
</header>
<!-- END: Header -->