@extends('layouts.backend.master')

@section('title.page' , 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-4">
            <!--begin:: Widgets/Download Files-->
            <div class="row m-row--full-height">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-brand ">
                        <div class="m-portlet__body">
                            <div class="m-widget26">
                                <div class="m-widget26__number">                                    
                                    {{ $staticUser }}
                                    <small>All Users</small>
                                </div>
                                <div class="m-widget26__chart" style="height:90px; width: 220px;">
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m--space-30"></div>
                    <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-danger ">
                        <div class="m-portlet__body">
                            <div class="m-widget26">
                                <div class="m-widget26__number">
                                    {{ $staticOrder }}
                                    <small>All Orders</small>
                                </div>
                                <div class="m-widget26__chart" style="height:90px; width: 220px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-success ">
                        <div class="m-portlet__body">
                            <div class="m-widget26">
                                <div class="m-widget26__number">
                                    {{ $staticProduct }}
                                    <small>All Products</small>
                                </div>
                                <div class="m-widget26__chart" style="height:90px; width: 220px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m--space-30"></div>
                    {{-- <div class="m-portlet m-portlet--half-height m-portlet--border-bottom-accent ">
                        <div class="m-portlet__body">
                            <div class="m-widget26">
                                <div class="m-widget26__number">
                                    470
                                    <small>All Comissions</small>
                                </div>
                                <div class="m-widget26__chart" style="height:90px; width: 220px;"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!--end:: Widgets/Download Files-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/New Users-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Quick Action
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget4_tab1_content">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="m-nav-grid m-nav-grid--skin-light">
                                    <div class="m-nav-grid__row">
                                        <a href="{{ route('admin.catalogs.product.create')}}" class="m-nav-grid__item">
                                            <i class="m-nav-grid__icon flaticon-file"></i>
                                            <span class="m-nav-grid__text">
                                                Create New Product
                                            </span>
                                        </a>
                                        <a href="{{ route('admin.article.create')}}" class="m-nav-grid__item">
                                            <i class="m-nav-grid__icon flaticon-time"></i>
                                            <span class="m-nav-grid__text">
                                                Create New Knowledge
                                            </span>
                                        </a>
                                    </div>
                                    <div class="m-nav-grid__row">
                                        <a href="{{ route('admin.contents.promotion.create')}}" class="m-nav-grid__item">
                                            <i class="m-nav-grid__icon flaticon-folder"></i>
                                            <span class="m-nav-grid__text">
                                                Create New Promotion
                                            </span>
                                        </a>
                                       
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                        <div class="tab-pane" id="m_widget4_tab2_content">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="./assets/app/media/img/users/100_2.jpg" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Kristika Bold
                                        </span><br>
                                        <span class="m-widget4__sub">
                                            Product Designer,Apple Inc
                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Follow</a>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="./assets/app/media/img/users/100_13.jpg" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Ron Silk
                                        </span><br>
                                        <span class="m-widget4__sub">
                                            Release Manager, Loop Inc
                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Follow</a>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="./assets/app/media/img/users/100_9.jpg" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Nick Bold
                                        </span><br>
                                        <span class="m-widget4__sub">
                                            Web Developer, Facebook Inc
                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Follow</a>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="./assets/app/media/img/users/100_2.jpg" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Wiltor Delton
                                        </span><br>
                                        <span class="m-widget4__sub">
                                            Project Manager, Amazon Inc
                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Follow</a>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                                <!--end::Widget 14 Item-->
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__img m-widget4__img--pic">
                                        <img src="./assets/app/media/img/users/100_8.jpg" alt="">
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Nick Bold
                                        </span><br>
                                        <span class="m-widget4__sub">
                                            Web Developer, Facebook Inc
                                        </span>
                                    </div>
                                    <div class="m-widget4__ext">
                                        <a href="#" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">Follow</a>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/New Users-->
        </div>
        <div class="col-xl-4">
            <!--begin:: Widgets/Last Updates-->
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Latest Products
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::widget 12-->
                    <div class="m-widget4">
                        @foreach ($lastestProduct as $product)                            
                       
                        <div class="m-widget4__item">
                            <div class="m-widget4__ext">
                                <span class="m-widget4__icon m--font-brand">
                                    <i class="fab fa-product-hunt"></i>
                                </span>
                            </div>
                            <div class="m-widget4__info">
                                <span class="m-widget4__text">
                                    {{ $product->name }}
                                </span>
                            </div>
                            <div class="m-widget4__ext">
                                <span class="m-widget4__number m--font-info">
                                    {{ $product->price }}.-
                                </span>
                            </div>
                        </div>   
                        @endforeach                     
                    </div>
                    <!--end::Widget 12-->
                </div>
            </div>
            <!--end:: Widgets/Last Updates-->
        </div>
    </div>
@stop
