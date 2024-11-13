<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>

							<li class="{{ Route::is(['index']) ? 'active':'' }}">
								<a href="{{ route('index') }}">
                                    <i class="fa-solid fa-gauge"></i>
                                    <span>Dashboard</span>
                                </a>
							</li>
							{{-- <li class="{{ Route::is(['packages']) ? 'active':'' }}">
								<a href="{{ route('packages')}}">
                                    <i class="fa-solid fa-cubes"></i>
                                    <span>Packages</span>
                                </a>
							</li> --}}
							<li class="{{ Route::is(['customers']) ? 'active':'' }}">
								<a href="{{route('customers')}}">
                                    <i class="fe fe-users"></i>
                                    <span>Customers</span>
                                </a>
							</li>
							<li class="{{ Route::is(['transporters']) ? 'active':'' }}">
								<a href="{{route('transporters')}}">
                                    <i class="fa-solid fa-truck-front"></i>
                                    <span>Transporters</span>
                                </a>
							</li>
							<li class="{{ Route::is(['plans.index'], ['plans.create']) ? 'active':'' }}">
								<a href="{{route('plans.index')}}">
                                    <i class="fa-solid fa-cubes"></i>
                                    <span>Plans</span>
                                </a>
							</li>
                            <li class="">
                                <a href="{{route('admin.subscription.index')}}">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    <span>Subscription Management</span>
                                </a>
                            </li>
							<li class="{{ Route::is(['contact-management']) ? 'active':'' }}">
								<a href="{{ route('contact-management') }}">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                    <span>Contact Management</span>
                                </a>
							</li>
                            <li class="{{ Route::is(['website-setting']) ? 'active':'' }}">
                                <a href="{{ route('website-setting') }}">
                                    <i class="fa-solid fa-wrench"></i>
                                    <span>Website Settings</span>
                                </a>
                            </li>
							<li class="{{ Route::is(['faq']) ? 'active':'' }}">
								<a href="{{ route('faq') }}">
                                    <i class="fa-regular fa-circle-question"></i>
                                    <span>FAQs</span>
                                </a>
							</li>
							<li class="submenu">
								<a href="#">
                                    <i class="fa-solid fa-table"></i>
                                    <span> CMS</span> <span class="menu-arrow"></span>
                                </a>
								<ul style="display: none;">
									<li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
									<li><a href="{{ route('terms.conditions') }}">Terms And Conditions</a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
