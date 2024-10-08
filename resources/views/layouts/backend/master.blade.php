<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.backend.partials.head')
    </head>
    <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-light m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- BEGIN: Topbarhead -->
            @include('layouts.backend.partials.topbar')

            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
                @include('layouts.backend.partials.leftbar')

                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <div class="m-subheader ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="m-subheader__title m-subheader__title--separator">@yield('title.page')</h3>
                                @yield('breadcrumb')
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <div class="m-content">
                        @yield('content')
                    </div>
                </div>
			</div>
            <!-- end:: Body -->
            <!-- begin::Footer -->
            <footer class="m-grid__item	m-footer ">
                @include('layouts.backend.partials.footer')
            </footer>
			<!-- end::Footer -->
        </div>
        <!-- end:: Page -->
        <!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
							Messages
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
							Settings
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">
							Logs
						</a>
					</li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
                        <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                            <div class="m-messenger__messages m-scrollable m-scroller ps ps--active-y" style="height: 542px; overflow: hidden;">
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="./assets/app/media/img//users/user3.jpg" alt="">
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Hi Bob. What time will be the meeting ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Hi Megan. It's at 2.30PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="./assets/app/media/img//users/user3.jpg" alt="">
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Will the development team be joining ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes sure. I invited them as well
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">2:30PM</div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="./assets/app/media/img//users/user3.jpg" alt="">
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. For the Coca-Cola Mobile App project as well ?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Yes, sure.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Please also prepare the quotation for the Loop CRM project as well.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__datetime">3:15PM</div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-no-pic m--bg-fill-danger">
                                            <span>M</span>
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Noted. I will prepare it.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--out">
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-text">
                                                    Thanks Megan. I will see you later.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-messenger__wrapper">
                                    <div class="m-messenger__message m-messenger__message--in">
                                        <div class="m-messenger__message-pic">
                                            <img src="./assets/app/media/img//users/user3.jpg" alt="">
                                        </div>
                                        <div class="m-messenger__message-body">
                                            <div class="m-messenger__message-arrow"></div>
                                            <div class="m-messenger__message-content">
                                                <div class="m-messenger__message-username">
                                                    Megan wrote
                                                </div>
                                                <div class="m-messenger__message-text">
                                                    Sure. See you in the meeting soon.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 542px; right: 4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 299px;"></div></div></div>
                            
                            <div class="m-messenger__seperator"></div>

                            <div class="m-messenger__form">
                                <div class="m-messenger__form-controls">
                                    <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
                                </div>
                                <div class="m-messenger__form-tools">
                                    <a href="" class="m-messenger__form-attachment">
                                        <i class="la la-paperclip"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane active show" id="m_quick_sidebar_tabs_settings" role="tabpanel">
                        <div class="m-list-settings m-scrollable m-scroller ps ps--active-y" style="height: 652px; overflow: hidden;">
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">General Settings</div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Email Notifications</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" checked="checked" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Site Tracking</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">SMS Alerts</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Backup Storage</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Audit Logs</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" checked="checked" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                            </div>
                            <div class="m-list-settings__group">
                                <div class="m-list-settings__heading">System Settings</div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">System Logs</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Error Reporting</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Applications Logs</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Backup Servers</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" checked="checked" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                                <div class="m-list-settings__item">
                                    <span class="m-list-settings__item-label">Audit Logs</span>
                                    <span class="m-list-settings__item-control">
                                    <span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
                                    <label>
                                    <input type="checkbox" name="">
                                    <span></span> 
                                    </label>
                                    </span>	 
                                    </span>
                                </div>
                            </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 4px; height: 652px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 612px;"></div></div></div>
                    </div>
                    
                    <div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
                        <div class="m-list-timeline m-scrollable m-scroller ps" style="height: 652px; overflow: hidden;">
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    System Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered <span class="m-badge m-badge--warning m-badge--wide">important</span></a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoice received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89% <span class="m-badge m-badge--success m-badge--wide">resolved</span></a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error</a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down <span class="m-badge m-badge--danger m-badge--wide">pending</span></a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Applications Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--info m-badge--wide">urgent</span></a>
                                        <span class="m-list-timeline__time">7 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered</a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoices received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error <span class="m-badge m-badge--info m-badge--wide">pending</span></a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down</a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-list-timeline__group">
                                <div class="m-list-timeline__heading">
                                    Server Logs
                                </div>
                                <div class="m-list-timeline__items">
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received</a>
                                        <span class="m-list-timeline__time">7 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">12 new users registered</a>
                                        <span class="m-list-timeline__time">Just now</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">System shutdown</a>
                                        <span class="m-list-timeline__time">11 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
                                        <a href="" class="m-list-timeline__text">New invoice received</a>
                                        <span class="m-list-timeline__time">20 mins</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
                                        <a href="" class="m-list-timeline__text">Database overloaded 89%</a>
                                        <span class="m-list-timeline__time">1 hr</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">System error</a>
                                        <span class="m-list-timeline__time">2 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">Production server down</a>
                                        <span class="m-list-timeline__time">3 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
                                        <a href="" class="m-list-timeline__text">Production server up</a>
                                        <span class="m-list-timeline__time">5 hrs</span>
                                    </div>
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
                                        <a href="" class="m-list-timeline__text">New order received</a>
                                        <span class="m-list-timeline__time">1117 hrs</span>
                                    </div>
                                </div>
                            </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
                <i class="la la-arrow-up"></i>
            </div>

        @include('layouts.backend.partials.script')
    </body>
</html>
