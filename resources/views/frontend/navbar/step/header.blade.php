 <header class="header">
     <nav id="sidebarMenu" class="collapse sidebar bg-white">
         <div class="position-sticky">
             <div class="list-group list-group-flush mt-4 main">
                 <a href="{{route('frontend.user.personal.details')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.personal.details') ? 'active' : '' }}" aria-current="true">
                     <i class="fa fa-user" aria-hidden="true"></i><span>Personal</span>
                 </a>
                 <a href="{{route('frontend.user.health.information')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.health.information') ? 'active' : '' }}">
                     <i class="fa fa-heart" aria-hidden="true"></i><span>Health</span>
                 </a>
                 <a href="{{route('frontend.user.health.card')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.health.card') ? 'active' : '' }}">
                     <i class="fa fa-id-card-o" aria-hidden="true"></i><span>Health Card</span>
                 </a>
                 <a href="{{route('frontend.user.payment')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.payment') ? 'active' : '' }}">
                     <i class="fa fa-credit-card" aria-hidden="true"></i><span>Payments</span>
                 </a>
                 <a href="{{route('frontend.user.address')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.address') ? 'active' : '' }}">
                     <i class="fa fa-home" aria-hidden="true"></i><span>Address</span>
                 </a>
                 <a href="{{route('frontend.user.insurance')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.insurance') ? 'active' : '' }}">
                     <i class="fa fa-shield" aria-hidden="true"></i><span>Insurance</span>
                 </a>
             </div>
             <div class="list-group list-group-flush mt-4">
                 <p class="txt"><strong>Medications and Prescriptions</strong></p>
                 <a href="{{route('frontend.user.dashboard')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.medications') ? 'active' : '' }}">
                     <i class="fa fa-home" aria-hidden="true"></i><span class="mx-3">Home</span>
                 </a>
                 <a href="{{route('frontend.user.orders')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.orders') ? 'active' : '' }}">
                     <i class="fa fa-ambulance" aria-hidden="true"></i><span class="mx-3">Orders</span>
                 </a>
                 <a href="{{route('frontend.user.prescription')}}" class="list-group-item list-group-item-action py-2 {{ (Route::currentRouteName() == 'frontend.user.prescription') ? 'active' : '' }}">
                     <i class="fa fa-pencil-square-o" aria-hidden="true"></i><span class="mx-3">Prescriptions</span>
                 </a>
                 
                @if(getAllChildUsers())
                
                    <div class="acc-info">
                        <p class="txt mt-5"><strong>Other Accounts</strong></p>
                        @foreach(getAllChildUsers() as $user)
                            <a href="{{route('frontend.user.switch.start',$user->id)}}">
                                <div class="left">
                                    <p class="user-ins">{{substr($user->first_name, 0, 1)}}{{substr($user->last_name, 0, 1)}}</p>
                                    <p class="user-name">{{$user->full_name}}</p>
                                    <p class="info">Primary</p>
                                </div>
                                <div class="right swt">
                                    <span class="info">Switch</span>
                                </div>
                            </a>
                            @foreach($user->subuser as $sbuser)
                                <a href="{{route('frontend.user.switch.start',$sbuser->id)}}">
                                    <div class="left">
                                        <p class="user-ins">{{substr($sbuser->first_name, 0, 1)}}{{substr($sbuser->last_name, 0, 1)}}</p>
                                        <p class="user-name">{{$sbuser->full_name}}</p>
                                        <p class="info">Other</p>
                                    </div>
                                    <div class="right swt">
                                         <span class="info">Switch</span>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    </div>

                @endif

                 <div class="sidebar-footer">
                     <div class="left">
                         <a aria-label="Return to home page" href="{{route('frontend.index')}}">
                             <img src="{{ asset('step/assets/images/logo.png') }}" alt="logo" />
                         </a>
                     </div>
                     <div class="right">
                         <a href="#" class="need-text">Need help?</a>
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
             <button class="user-ins">{{authUserShortName()}}</button>
             <p class="info">Viewing as</p>
             <p class="user-name"> {{(auth()->check()) ? auth()->user()->full_name: 'Alexandre'}} <i class="fa fa-sort-desc" aria-hidden="true"></i></p>
         </div>
         <div class="col-md-6 text-end">
             @if(auth()->check() && auth()->user()->parent_id == null)
                <a href="{{route('frontend.user.add.member')}}" class="profile-btn"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Member</a>
             @endif
         </div>
     </div>
     <div class="row menu">
         @php 
            $profile_route =   [
                                'frontend.user.health.card',
                                'frontend.user.health.information',
                                'frontend.user.insurance',
                                'frontend.user.address',
                                'frontend.user.payment',
                                'frontend.user.payment.add',
                                'frontend.user.personal.details',
                                'frontend.user.address.add',
                                ];
         @endphp
         @if(in_array(Route::getCurrentRoute()->getName(),$profile_route))
            <ul>
            <li><a href="{{route('frontend.user.personal.details')}}" class="{{ (Route::currentRouteName() == 'frontend.user.personal.details') ? 'active' : '' }}"><i class="fa fa-user-o" aria-hidden="true"></i> Personal details</a></li>
            <li><a href="{{route('frontend.user.health.information')}}" class="{{ (Route::currentRouteName() == 'frontend.user.health.information') ? 'active' : '' }}"><i class="fa fa-heart-o" aria-hidden="true"></i> Health details</a></li>
            <li><a href="{{route('frontend.user.health.card')}}" class="{{ (Route::currentRouteName() == 'frontend.user.health.card') ? 'active' : '' }}"><i class="fa fa-address-card-o" aria-hidden="true"></i> Health Card</a></li>
            <li><a href="{{route('frontend.user.insurance')}}" class="{{ (Route::currentRouteName() == 'frontend.user.insurance') ? 'active' : '' }}"><i class="fa fa-shield" aria-hidden="true"></i> Insurance</a></li>
            <li><a href="{{route('frontend.user.address')}}" class="{{ (Route::currentRouteName() == 'frontend.user.address') ? 'active' : '' }}"><i class="fa fa-envelope-o" aria-hidden="true"></i> Address</a></li>
            <li><a href="{{route('frontend.user.payment')}}" class="{{ (Route::currentRouteName() == 'frontend.user.payment') ? 'active' : '' }}"><i class="fa fa-credit-card" aria-hidden="true"></i> Payment</a></li>
            </ul>
         @else
            <ul>
                <li><a href="{{route('frontend.user.dashboard')}}" class="{{ (Route::currentRouteName() == 'frontend.user.dashboard') ? 'active' : '' }}"><i class="fa fa-home" aria-hidden="true"></i> @lang('Frontend/dashboard.header.home')</a></li>
                <!-- <li><a href="{{route('frontend.user.medications')}}" class="{{ (Route::currentRouteName() == 'frontend.user.medications') ? 'active' : '' }}" ><i class="fa fa-medkit" aria-hidden="true"></i> @lang('Frontend/dashboard.header.medication')</a></li> -->
                <li><a href="{{route('frontend.user.prescription')}}" class="{{ (Route::currentRouteName() == 'frontend.user.prescription') ? 'active' : '' }}"><i class="fa fa-list-alt" aria-hidden="true"></i> @lang('Frontend/dashboard.header.prescription') </a></li>
                <li><a href="{{route('frontend.user.orders')}}" class="{{ (Route::currentRouteName() == 'frontend.user.orders') ? 'active' : '' }}"><i class="fa fa-truck" aria-hidden="true"></i> @lang('Frontend/dashboard.header.orders')</a></li>
            </ul>

         @endif

     </div>

 </header>