 <header class="header">
     <nav id="sidebarMenu" class="collapse sidebar bg-white">
         <div class="position-sticky">
             <div class="list-group list-group-flush mt-4 main">
                 <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true">
                     <i class="fa fa-user" aria-hidden="true"></i><span>Personal</span>
                 </a>
                 <a href="#" class="list-group-item list-group-item-action py-2">
                     <i class="fa fa-heart" aria-hidden="true"></i><span>Health</span>
                 </a>
                 <a href="{{route('frontend.user.health.card')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.health.card') ? 'active' : '' }}">
                     <i class="fa fa-id-card-o" aria-hidden="true"></i><span>Health Card</span>
                 </a>
                 <a href="#" class="list-group-item list-group-item-action py-2">
                     <i class="fa fa-credit-card" aria-hidden="true"></i><span>Payments</span>
                 </a>
                 <a href="#" class="list-group-item list-group-item-action py-2">
                     <i class="fa fa-home" aria-hidden="true"></i><span>Address</span>
                 </a>
                 <a href="{{route('frontend.user.insurance')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.insurance') ? 'active' : '' }}">
                     <i class="fa fa-shield" aria-hidden="true"></i><span>Insurance</span>
                 </a>
             </div>
             <div class="list-group list-group-flush mt-4">
                 <p class="txt"><strong>Medications and Prescriptions</strong></p>
                 <a href="{{route('frontend.user.medications')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.medications') ? 'active' : '' }}">
                     <i class="fa fa-medkit" aria-hidden="true"></i><span class="mx-3">Medications</span>
                 </a>
                 <a href="{{route('frontend.user.orders')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.orders') ? 'active' : '' }}">
                     <i class="fa fa-ambulance" aria-hidden="true"></i><span class="mx-3">Orders</span>
                 </a>
                 <a href="{{route('frontend.user.prescription')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.prescription') ? 'active' : '' }}">
                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="mx-3">Prescriptions</span>
                 </a>
                 <div class="acc-info">
                     <p class="txt mt-5"><strong>Other Accounts</strong></p>
                     <a href="#">
                         <div class="left">
                             <p class="user-ins">DT</p>
                             <p class="user-name">Demo Test</p>
                             <p class="info">Other</p>
                         </div>
                         <div class="right">
                             <span class="info">Switch</span>
                         </div>
                     </a>

                 </div>
                 <div class="sidebar-footer">
                     <div class="left">
                         <a href="#">
                             <img src="{{ asset('step/assets/images/logo.png') }}" alt="logo" />
                         </a>
                     </div>
                     <div class="right">
                         <a href="#">Need help?</a>
                         @if(Auth::check())
             <a href="{{ route('frontend.auth.logout') }}" class="text-danger"> Logout</a>
             @endif
                         

                     </div>


                 </div>
             </div>
         </div>
     </nav>
     <div class="row dashboard">
         <div class="col-md-6">
             <button class="user-ins">AM</button>
             <p class="info">Viewing as</p>
             <p class="user-name">Alexandre <i class="fa fa-sort-desc" aria-hidden="true"></i></p>
         </div>
         <div class="col-md-6 text-end">
             
             <a href="#" class="profile-btn"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</a>
         </div>
     </div>
     <div class="row menu">
         <ul>
             <li><a href="{{route('frontend.user.dashboard')}}" class="{{ (Route::currentRouteName() == 'frontend.user.dashboard') ? 'active' : '' }}"><i class="fa fa-home" aria-hidden="true"></i> @lang('Frontend/dashboard.header.home')</a></li>
             <li><a href="{{route('frontend.user.medications')}}" class="{{ (Route::currentRouteName() == 'frontend.user.medications') ? 'active' : '' }}" ><i class="fa fa-medkit" aria-hidden="true"></i> @lang('Frontend/dashboard.header.medication')</a></li>
             <li><a href="{{route('frontend.user.prescription')}}" class="{{ (Route::currentRouteName() == 'frontend.user.prescription') ? 'active' : '' }}"><i class="fa fa-list-alt" aria-hidden="true"></i> @lang('Frontend/dashboard.header.prescription') </a></li>
             <li><a href="{{route('frontend.user.orders')}}" class="{{ (Route::currentRouteName() == 'frontend.user.orders') ? 'active' : '' }}"><i class="fa fa-truck" aria-hidden="true"></i> @lang('Frontend/dashboard.header.orders')</a></li>
         </ul>

     </div>

 </header>