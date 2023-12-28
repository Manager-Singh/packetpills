
<style>
.menu ul li a i.fa {
    color: #638e3c;
}
nav.step-menu ul li a{
    color: #638e3c;
    text-decoration: unset;
    font-size: 18px;
    font-weight: 600;
}
nav.step-menu ul li a:hover, .login-in-out a:hover{
    text-decoration: unset;
}
.step-main-menu {
    position: absolute;
    right: 0;
}

</style>
<div class="landing-page newui" style="justify-content: center; display: flex;">

<header  class="re-header show">
  <div  class="row between-xs row--nogutters row--middle row--nowrap">
    <div  class="column">
      <div  class="row row--gutter row--middle re-header__nav-container">
        <!-- <div  class="column hide-desktop">
          <button  class="btn-hamburger login-recognition">
            <i class="material-icons">menu</i>
          </button>
        </div> -->
     
        <div class="column">
          <a class="re-header__logo-default" aria-label="Return to home page" href="{{route('frontend.index')}}">
            <img alt="logo" width="136" height="25" src="{{asset('website/assets/images/logo.gif')}}">
          </a>

        </div>
        <div class="column step-main-menu">
          <!-- <nav class="step-menu">
            <ul role="menu" class="re-nav">
               <li role="menuitem" class="">

                <a href="https://misterpharmacist.com">Home</a>

              </li>
             <li role="menuitem" class="">

                <a href="#">How it works</a>

              </li>
              <li role="menuitem" class="hover-menu">
                <div>
                  <a href="{{route('frontend.drug.search')}}">
                  <button class="is-clickable button font-regular color-dark focus-visible-button" aria-label="Open drugs menu" aria-expanded="false">
                    <span  class="font-regular">Drugs</span> 
                     <i class="fa fa-angle-down" aria-hidden="true"></i> 

                  </button>
                  </a>
                  
                  <ul  class="row re-subnav xsmall-5" aria-label="Read about the drug">
                  @if($drugs)
                    @foreach($drugs as $drug)
                      <li  class="column">
                    
                        <div >
                          <a  href="{{route('frontend.drug.single',$drug->slug)}}">{{$drug->brand_name}}</a>
                        </div>
                    
                      </li>
                    @endforeach
                  @else
                  @endif
                  
                  <li  class="column">
                   
                      <div >
                        <a  href="#">Finasteride</a>
                      </div>
                   
                    </li>
                    <li  class="column">
                   
                      <div >
                        <a  href="#">Jardiance</a>
                      </div>
                   
                    </li>
                    <li  class="column">
                   
                      <div >
                        <a  href="#">Escitalopram</a>
                      </div>
                   
                    </li>  
                    
                                  
                    
                    
                    

                  </ul>
                </div>

              </li
             
             
              
              
              
           
            </ul>
         
          </nav> -->


          <nav  class="navbar navbar-expand-md navbar-light step-menu">
            <!-- <a class="navbar-brand" href="#">Your Logo</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a  class="nav-link" href="https://misterpharmacist.com">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://misterpharmacist.com/minor-ailment/">Minor Ailment</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link" href="https://misterpharmacist.com/blog/">Blog</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link" href="https://misterpharmacist.com/about-us/">About Us</a>
                </li>
                <li class="nav-item">
                  <a  class="nav-link" href="https://misterpharmacist.com/contact-us/">Contact Us</a>
                </li>
                <li  class="nav-item" >
                  @if(Auth::check())
                    <a class="nav-link" keyname="landing.navbar.login" href="{{ route('frontend.auth.logout') }}">Log Out</a>
                @else
                    <a class="nav-link" keyname="landing.navbar.login" href="{{ route('frontend.auth.new.login') }}">Log In</a>
                @endif
                </li>
              </ul>
            </div>
          </nav>
        </div>
     
      </div>
    </div>
    <!-- <div  class="column">
      <div  class="row row--middle row--gutter-half">
        <div  class="column">
           <div  class="select re-lang-pref">
            <select  name="lang-pref" aria-haspopup="listbox" aria-expanded="false" class="font-regular ng-untouched ng-pristine ng-valid" aria-label="Choose a language">
              <option  value="en" selected="">EN</option>
              <option  value="fr">FR</option>
            </select>
          </div> 
        </div>
     
        <div  class="re-nav xsmall-5 login-in-out">
            @if(Auth::check())
                <a keyname="landing.navbar.login" href="{{ route('frontend.auth.logout') }}">Log Out</a>
            @else
                <a keyname="landing.navbar.login" href="{{ route('frontend.auth.new.login') }}">Log In</a>
            @endif
        </div>

      </div>
    </div> -->
  </div>
</header>
</div>