
<div class="landing-page newui" style="justify-content: center; display: flex;">

<header  class="re-header show">
  <div  class="row between-xs row--nogutters row--middle row--nowrap">
    <div  class="column">
      <div  class="row row--gutter row--middle re-header__nav-container">
        <div  class="column hide-desktop">
          <button  class="btn-hamburger login-recognition">
            <i class="material-icons">menu</i>
          </button>
        </div>
     
        <div class="column">
          <a class="re-header__logo-default" aria-label="Return to home page" href="#">
            <img alt="logo" width="136" height="25" src="{{asset('website/assets/images/logo-removebg.png')}}">
          </a>

        </div>
        <div class="column hide-mobile">
          <nav>
            <ul role="menu" class="re-nav">
              <li role="menuitem" class="">

                <a href="#">How it works</a>

              </li>
              <li role="menuitem" class="hover-menu">
                <div>
                  <button class="is-clickable button font-regular color-dark focus-visible-button" aria-label="Open drugs menu" aria-expanded="false">
                    <span  class="font-regular">Drugs</span> 
                    <!-- <i class="fa fa-angle-down" aria-hidden="true"></i> -->

                  </button>
                  
                  <ul  class="row re-subnav xsmall-5" aria-label="Read about the drug">
                  @if($drugs)
                    @foreach($drugs as $drug)
                      <li  class="column">
                    
                        <div >
                          <a  href="#">{{$drug->name}}</a>
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

              </li>
              <li  role="menuitem" class="">
             
             
                <a  href="#">For Business</a>
             
             
             
              </li>
           
            </ul>
         
          </nav>
        </div>
     
      </div>
    </div>
    <div  class="column">
      <div  class="row row--middle row--gutter-half">
        <div  class="column">
          <div  class="select re-lang-pref">
            <select  name="lang-pref" aria-haspopup="listbox" aria-expanded="false" class="font-regular ng-untouched ng-pristine ng-valid" aria-label="Choose a language">
              <option  value="en" selected="">EN</option>
              <option  value="fr">FR</option>
            </select>
          </div>
        </div>
     
        <div  class="re-nav xsmall-5">
            @if(Auth::check())
                <a keyname="landing.navbar.login" href="{{ route('frontend.auth.logout') }}">Log Out</a>
            @else
                <a keyname="landing.navbar.login" href="{{ route('frontend.auth.new.login') }}">Log In</a>
            @endif
        </div>

      </div>
    </div>
  </div>
</header>
</div>