<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>

							<li class="{{ Route::is(['customer.index']) ? 'active':'' }}">
								<a href="{{ route('customer.index') }}">
                                    <i class="fa-solid fa-gauge"></i>
                                    <span>Dashboard</span>
                                </a>
							</li>
							<li class="{{ Route::is(['customer.truck.request'], ['customer.update.truck'], ['customer.request.detail']) ? 'active':'' }}">
								<a href="{{ route('customer.truck.request') }}">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                    <span>Truck Request</span>
                                </a>
							</li>
							<li class="{{ Route::is(['customer.requestbids']) ? 'active':'' }}">
								<a href="{{ route('customer.requestbids') }}">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                    <span>Request Bids</span>
                                </a>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
