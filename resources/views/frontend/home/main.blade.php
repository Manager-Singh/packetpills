
<div class="hero hero--desktop hero--exp-2"
    style="background-size: 100%; background-position: center top; background-image: url({{asset('website/assets/images/background2.png')}});">
    <div class="landing-wrapper margin-t-xl">
        <div class="content-exp2">
            <div>
                <h1 class="hero__heading color-brand font-bold txt-c"> Your Online Pharmacy </h1>
                <h2 class="paragraph hero__details--laptop color-light font-regular txt-c"> Free medication delivery.
                    Easy access to pharmacists. Anywhere in Canada. </h2>
            </div>

        </div>
        <div class="row center-xs">
            <div class="column column--xs-8 column--s-8 column--m-6 column--l-5 column--xl-4">
                <div class="hero__form margin-t-xl hero__form--vertical signup-form--desktop">

                    <div aria-label="Sign up with Pocketpills">
                        @if(Auth::check())
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand">Hi, Alexandre</p>
                            <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand"> Welcome back!</p><a href="{{route('frontend.user.account')}}"><button _ngcontent-serverapp-c48="" type="submit" class="btn btn--brand txt-defaultcase"><span _ngcontent-serverapp-c48="" translate="" class="button__label txt-defaultcase">Go to dashboard</span><i class="fa fa-angle-arrow-right" aria-hidden="true"></i></button></a>
                        @else

                        <p class="paragraph font-semibold hero__form-label txt-center--xs color-brand">Simply sign in to
                            join over 300,000 satisfied members:</p>

                        @endif



                        <div class="row row--nogutters">
                            <div class="column column--xs-12 row row--nogutters center-xs">
                                <div class="hero__form-wrapper">
                                    <div class="hero__form-row row row--nogutters row--grow-3">
                                        <div class="column column--xs full-width">
                                            <div class="hero__form-field">
                                                @if(!Auth::check())
                                                <form novalidate="" action="{{route('frontend.auth.login.post')}}" method="POST" class="ng-untouched ng-pristine ng-valid">
                                                

                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                        <label class="hide-label"
                                                            for="phone-number">Phone</label>
                                                        <div class="tel">
                                                            <div class="tel-prefix txt-c" aria-label="Country code +1">
                                                                <p class="color-dark font-semibold">+1</p>
                                                            </div>
                                                            <div class="tel-input">
                                                                <input autocomplete="off" type="tel"
                                                                    oninput="javascript: if (this.value.length &gt; 10) this.value = this.value.slice(0, 10);"
                                                                    onkeypress="return (event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57) || event.charCode == 13"
                                                                    keyname="landing.fields.phone" contenteditable="true"
                                                                    class="home-input full-width font-semibold ng-untouched ng-pristine ng-invalid"
                                                                    id="phone-number"
                                                                    placeholder="10 digit phone number" aria-required="true"
                                                                    required="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-inline">
                                                    <div class="form-inline__form">
                                                    <div class="row">
                                                        <div class="col otp-box hide" style="display:none;">
                                                            <div class="form-group">
                                                                {{ html()->label(__('validation.attributes.frontend.otp'))->for('otp') }}

                                                                {{ html()->text('otp')->class('form-control')->placeholder(__('validation.attributes.frontend.otp'))->attribute('id','otp')->attribute('maxlength', 6)->attribute('minlength', 6)->required() }}
                                                                <span class="genrated-otp"></span>
                                                            </div><!--form-group-->
                                                        </div><!--col-->
                                                    </div><!--row-->
                                                        
                                                    </div>

                                                </div>


                                                <div class="margin-t-l">
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset request-otp">{{ __('labels.frontend.auth.get_started') }}</button>
                                                    <button type="button" class="btn btn--full btn--brand txt-defaultcase lineheight-reset register-submit" style="display:none">{{ __('labels.frontend.auth.otp_verfied') }}</button>
                                                </div>


                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="This field is required.">

                                                </div>

                                                <div aria-live="assertive" role="alert" aria-atomic="true"
                                                    aria-label="false">
                                                    <div class="form-group__msg margin-t-s txt-c" style="display: none;">
                                                        <span class="color-error xsmall txt-c font-semibold"
                                                            style="display: none;">This field is required.</span>
                                                        <span class="color-error xsmall txt-c font-semibold"></span>

                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                            </div>
                                        </div>



                                    </div>
                                    <small keyname="landing.banner.terms"
                                        class="font-smallest tnc block margin-t-l term-cond">By proceeding, you agree to
                                        our <a href="" class="txt-underline" target="_blank">Terms of Use</a> &amp; <a
                                            href="" class="txt-underline" target="_blank">Privacy Policy</a>. Message
                                        and data rates may apply. </small>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="ratings margin-t-xxxl show-desktop">
            <div class="landing-wrapper txt-c">
                <div class="ratings__container txt-c lazy-loaded">
                    <p keyname="landing.rating.rating" class="heading-tertiary color-dark font-semibold">4.9 Rating</p>
                    <p keyname="landing.rating.title" class="small color-dark font-semibold margin-t-s">Google &amp;
                        Facebook</p>
                    <p keyname="landing.rating.desc" class="small color-re-darker font-semibold margin-t-s">(and we're
                        always striving for that 0.1)</p>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="ratings show-mobile margin-t-xl">
    <div class="landing-wrapper txt-c">
        <div class="ratings__container txt-c">
            <p keyname="landing.rating.rating" class="heading-tertiary color-dark font-semibold">4.9 Rating</p>
            <p keyname="landing.rating.title" class="small color-dark font-semibold margin-t-s">Google &amp; Facebook
            </p>
            <p keyname="landing.rating.desc" class="small color-re-darker font-semibold margin-t-s">(and we're always
                striving for that 0.1)</p>
        </div>
    </div>

</div>
<div class="news lazy-loaded">

    <div class="section-wrapper">
        <div class="landing-wrapper txt-c">
            <p class="news__headline color-brand font-semibold" style="font-size: 2rem;">"MisterPharmacist™ aims to be
                the Uber of pharmacies"</p>
        </div>
        <div class="news-actions landing-wrapper margin-t-xl">
            <div class="row row--middle center-xs">
                <div class="column focus-visible-news inactive">
                    <button class="btn--full news__thumb vancouver_sun lazy-loaded" aria-label="Vancouver Sun"></button>
                </div>

                <div class="column focus-visible-news active">
                    <button class="btn--full news__thumb winnipeg lazy-loaded" aria-label="Winnipeg Press"></button>
                </div>

                <div class="column focus-visible-news inactive">
                    <button class="btn--full ctv_news news__thumb lazy-loaded" aria-label="CTV News"></button>
                </div>

                <div class="column focus-visible-news inactive">
                    <button class="btn--full mobilesyrup news__thumb lazy-loaded" aria-label="MobileSyrup"></button>
                </div>

                <div class="column focus-visible-news inactive">
                    <button class="btn--full news__thumb ottawa_citizen lazy-loaded"
                        aria-label="Ottawa Citizen"></button>
                </div>


            </div>
        </div>
    </div>

</div>


<div class="hiw">
    <div class="section-wrapper">
        <div class="landing-wrapper txt-c">
            <h2 keyname="landing.get-started.title" class="heading-secondary font-bold color-brand"> Getting started is
                as easy as 1 - 2 </h2>
            <p keyname="landing.get-started.desc" class="paragraph font-regular color-re-darker margin-t-m">(it's so
                simple we don't need the 3)</p>
        </div>
        <div class="landing-wrapper margin-t-xxl">
            <div class="row center-xs">
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="hiw__inner-wrapper txt-c">
                        <picture>
                            <source height="324" width="328" media="(min-width: 640px)" class="img-responsive">
                            <source height="324" width="328" media="(max-width: 639px)" class="img-responsive">
                            <img loading="lazy" height="324" width="328" src="{{asset('website/assets/images/sign-up.png')}}"
                                class="img-responsive" alt="Become a member of Pocket Pills">
                        </picture>
                        <h3 keyname="landing.get-started.step-count"
                            class="heading-tertiary color-brand font-bold margin-t-xxl"> Step 1 </h3>
                        <h4 keyname="landing.get-started.step-1-title"
                            class="heading-tertiary color-dark font-semibold">Sign up online with your phone,
                            <br>tablet, or computer. </h4>
                        <p keyname="landing.get-started.step-1-desc" class="paragraph margin-t-l color-dark">It only
                            takes a few seconds to become a member. A couple clicks, a little typing, and you're done!
                        </p>
                    </div>
                </div>
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="hiw__inner-wrapper txt-c">
                        <picture>
                            <source height="324" width="328" media="(min-width: 640px)" class="img-responsive">
                            <source height="324" width="328" media="(max-width: 639px)" class="img-responsive">
                            <img loading="lazy" height="324" width="328" src="{{asset('website/assets/images/relaxnwait.png')}}"
                                class="img-responsive" alt="We sort out the details for you.">
                        </picture>
                        <h3 keyname="landing.get-started.step-count"
                            class="heading-tertiary color-brand font-bold margin-t-xxl"> Step 2 </h3>
                        <h4 keyname="landing.get-started.step-2-title"
                            class="heading-tertiary color-dark font-semibold">Kick back and relax <br>while we sort out
                            the details. </h4>
                        <p keyname="landing.get-started.step-2-desc" class="paragraph margin-t-l color-dark">We'll reach
                            out to your old pharmacy to get your prescriptions and prepare your medications for next-day
                            delivery* (oh, delivery is free by the way).</p>
                    </div>
                </div>
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="hiw__inner-wrapper txt-c">
                        <picture>
                            <source height="324" width="328" media="(min-width: 640px)" class="img-responsive">
                            <source height="324" width="328" media="(max-width: 639px)" class="img-responsive">
                            <img loading="lazy" height="324" width="328" src="{{asset('website/assets/images/enjoyac.png')}}"
                                class="img-responsive" alt="your medications are on the way.">
                        </picture>
                        <h3 keyname="landing.get-started.step-count"
                            class="heading-tertiary color-brand font-bold margin-t-xxl"> Step 3 </h3>
                        <h4 keyname="landing.get-started.step-3-title"
                            class="heading-tertiary color-dark font-semibold">Do whatever you like. <br>Seriously,
                            you're already done. </h4>
                        <p keyname="landing.get-started.step-3-desc" class="paragraph margin-t-l color-dark">Get back to
                            your life with the peace of mind that your medications are on the way.</p>
                    </div>
                </div>
            </div>
            <p keyname="landing.get-started.warning" class="txt-c small margin-t-xl color-brand">*Some restrictions may
                apply</p>
        </div>
    </div>
</div>

<div class="doctors-appointment row row--nogutters row--middle lazy-loaded">
    <div class="section-wrapper full-width">
        <div class="landing-wrapper txt-c">
            <div class="row center-xs">
                <div class="column column--xs-12 column--s-6">
                    <img loading="lazy" src="{{asset('website/assets/images/icon-rx.png')}}" height="72" width="45" aria-hidden="true"
                        alt="">
                    <h2 keyname="landing.fax-section.title" class="heading-secondary color-brand font-bold"> Doctor's
                        appointment coming up? </h2>
                    <h3 keyname="landing.fax-section.content" class="h6 margin-t-m"> Ask your clinic to fax your new
                        prescriptions to MisterPharmacist™! </h3>
                    <div class="margin-t-m">
                        <div class="focus-visible-fax">
                            <a class="h3 font-bold button--tertiary" href="tel:1-855-950-7226">
                                <span keyname="landing.common.fax">Fax: </span> 1-855-950-7226 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="usp lazy-loaded">

    <div class="section-wrapper">
        <div class="landing-wrapper txt-c">
            <h2 class="heading-secondary font-bold color-brand">This is the kind of care you deserve</h2>
        </div>
        <div class="landing-wrapper content-wrapper--small margin-t-xxl row">
            <div class="row row--vertical-gutters between-xs">
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-delivery-mobile.png')}}" alt="Free medication delivery">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m"> Free Delivery </h3>
                        <p class="paragraph margin-t-s color-dark">Your medication is delivered directly to you at no
                            added cost. We even offer same-day delivery in select locations.</p>
                    </div>
                </div>
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-packaging-mobile.png')}}" alt="Discreet prescription packaging">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m"> Discreet Packaging </h3>
                        <p class="paragraph margin-t-s color-dark">Your privacy is important. That's why we send your
                            medication inside a plain delivery box so no one will know what's inside.</p>
                    </div>
                </div>

            </div>
            <div class="row row--vertical-gutters between-xs">
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-support-mobile.png')}}" alt="Get help from our pharmacists">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m">We're Here for You</h3>
                        <p class="paragraph margin-t-s color-dark">Our pharmacists are happy to answer your questions.
                            Get in touch by phone, text or email.</p>
                    </div>
                </div>
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-refills.png')}}" alt="Automatic refills provided by PocketPills.">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m"> Automatic Refills </h3>
                        <p class="paragraph margin-t-s color-dark">We manage your refills and get in touch with your
                            doctors for prescription renewals, so that you always have the medication you need.</p>
                    </div>
                </div>

            </div>
            <div class="row row--vertical-gutters between-xs">
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-pocketpacks.png')}}" alt="Personalised medication pocketpacks">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m"> Personalized PocketPacks </h3>
                        <p class="paragraph margin-t-s color-dark">We sort your medication into clearly labeled,
                            individual packs so you can be sure you're taking the right dose at the right time.</p>
                    </div>
                </div>
                <div class="column column--xs-12 column--s-6 column--l-4">
                    <div class="usp__inner-wrapper txt-c">
                        <picture>
                            <img loading="lazy" height="235" width="328" class="img-responsive"
                                src="{{asset('website/assets/images/usp-caregiver.png')}}" alt="Get caregiver support">
                        </picture>
                        <h3 class="heading-tertiary color-dark font-semibold margin-t-m"> Caregiver Support </h3>
                        <p class="paragraph margin-t-s color-dark">It can be challenging to take care of your loved
                            one's prescriptions. We provide the tools to help manage medications for the whole family.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<div class="psearch lazy-loaded">
    <div class="section-wrapper">
        <div class="landing-wrapper">
            <div class="psearch__container txt-c">
                <h2 keyname="landing.search-new.title" class="heading-secondary font-bold color-brand txt-c"> Think our
                    prices are too good to be true? </h2>
                <p keyname="landing.search-new.sub-title"
                    class="paragraph font-regular txt-c color-re-darker margin-t-m">We think nothing is too good for
                    you.</p>
                <p keyname="landing.search-new.desc" class="paragraph margin-t-xl color-dark">Shop for prescription (Rx)
                    and over-the-counter (OTC) medications online with transparent pricing and calculate your copay with
                    no hidden fees.</p>
                <div class="psearch__form margin-t-xxl">
                    <label for="searchInput" class="hide-label">Search Medications</label>
                    <input type="search" placeholder="Search medications" size="28" keyname="landing.search-new.input"
                        id="searchInput" role="searchbox" class="ng-untouched ng-pristine ng-valid">
                    <div class="psearch__result txt-l">
                        <div class="psearch__result-container bg-white">
                            <h6 keyname="landing.search-new.result-title"
                                class="psearch__result-heading heading-tertiary color-base font-semibold">Search Results
                            </h6>
                            <ul role="list">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row center-xs">
                    <div class="column column--xs-12 column--l-6">
                        <div class="margin-t-l">
                            <p keyname="landing.search-new.popular-title" class="h5 font-semibold color-brand">Popular
                                Searches:</p>
                            <div class="psearch__tag-wrapper margin-t-s">
                                <div>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Ozempic </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Finasteride </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Jardiance </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Escitalopram </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Sertraline </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Trintellix </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Janumet </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Alysena </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Bupropion </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Fluoxetine </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Alesse </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Duloxetine </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Symbicort </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Eliquis </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Pantoprazole </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Desvenlafaxine </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Dutasteride </button>

                                    <button role="link"
                                        class="tag tag--small psearch__tag chipInput focus-visible-medication-tag">
                                        Synthroid </button>

                                    <button class="tag tag--small psearch__tag chipInput focus-visible-medication-tag"
                                        tabindex="0"> Januvia </button>

                                    <a class="tag tag--small psearch__tag chipInput focus-visible-medication-tag"
                                        href="#drug"> View More </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <p class="small color-dark font-regular margin-t-xl txt-italic">Cost may be subsidized by your
                    provincial or private health plan.</p>
                <img loading="lazy" src="{{asset('website/assets/icon-psearch-footer.png')}}" class="margin-t-xl" alt="footer background">
            </div>
        </div>
    </div>
</div>


<div class="switch lazy-loaded">
    <div class="section-wrapper">
        <div class="landing-wrapper content-wrapper--small">
            <div class="switch__container txt-c bg-brand-primary">
                <h2 class="heading-secondary font-bold txt-c color-white">Make the switch to MisterPharmacist™</h2>
                <div class="margin-t-xl">
                    <button class="button button--primary button--column bg-white color-brand">
                        <span>Become a Member</span>
                        <span class="font-regular">(it's free)</span>
                    </button>


                </div>
                <div class="margin-t-xl">
                    <p keyname="landing.switch-new.note" class="paragraph color-white">Prefer to sign up over the phone?
                        <br>Our care team can't wait to take your call! </p>
                </div>
                <a class="button button--secondary bg-transparent margin-t-l color-white" href="tel:1-855-950-7225"
                    aria-label="1-855-950-7225">

                    <span class="button__label">1-855-950-7225</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="article txt-c">
    <div class="section-wrapper">
        <div class="landing-wrapper">
            <h3 keyname="landing.blog-new.section-title" class="heading-secondary font-bold color-brand txt-c">Reading
                is good for you...</h3>
            <h4 keyname="landing.blog-new.section-desc" class="paragraph font-regular color-re-darker margin-t-m txt-c">
                Reading about what's good for you is even better.</h4>
        </div>
        <div class="article__carousel margin-t-xxl">
            <div class="landing-wrapper">
                <div class="row center-xs">
                    <div tabindex="-1" class="column column--xs-12 column--s-6 column--l-4">
                        <div class="article__card">
                            <div class="article__thumbnail">
                                <img loading="lazy" width="328" height="357" class="img-responsive"
                                    alt="All about Ozempic" src="{{asset('website/assets/images/diabetes-canada-foods-ozempic.webp')}}">
                                <button role="link"
                                    class="article__heading color-brand txt-c bg-white button font-regular focus-visible-blog-title">
                                    All about Ozempic </button>
                            </div>
                            <p class="article__date small font-semibold color-brand txt-c margin-t-l"> August 8, 2022
                            </p>
                        </div>
                    </div>



                    <div tabindex="-1" class="column column--xs-12 column--s-6 column--l-4">
                        <div class="article__card">
                            <div class="article__thumbnail">
                                <img loading="lazy" width="328" height="357" class="img-responsive"
                                    alt="When to start birth control pills"
                                    src="{{asset('website/assets/images/when-to-start-birth-control-pills.webp')}}">
                                <button role="link"
                                    class="article__heading color-brand txt-c bg-white button font-regular focus-visible-blog-title">
                                    When to start birth control pills </button>
                            </div>
                            <p class="article__date small font-semibold color-brand txt-c margin-t-l"> August 10, 2022
                            </p>
                        </div>
                    </div>



                    <div tabindex="-1" class="column column--xs-12 column--s-6 column--l-4">
                        <div class="article__card">
                            <div class="article__thumbnail">
                                <img loading="lazy" width="328" height="357" class="img-responsive"
                                    alt="Kyleena vs. Mirena IUDs"
                                    src="{{asset('website/assets/images/does-iud-make-you-gain-weight.webp')}}">
                                <button role="link"
                                    class="article__heading color-brand txt-c bg-white button font-regular focus-visible-blog-title">
                                    Kyleena vs. Mirena IUDs </button>
                            </div>
                            <p class="article__date small font-semibold color-brand txt-c margin-t-l"> August 2, 2022
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@push('after-scripts')
<script>
    $(function() {
        
                $('.request-otp').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                //   var otp = $('#otp').val();

                  console.log(phone);
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.send.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone},
                      success: function(response) {
                        response = JSON.parse(response);
                              console.log(response.otp);
                              if (response.error) {
                                
                              }
                              $('.otp-box').show(); 
                              
                              $('.genrated-otp').text(response.otp); 
                              $('.request-otp').hide(); 
                              $('.register-submit').show(); 
                                                         
                          }
                      });
                });
                $('.register-submit').click(function(e) {
                  e.preventDefault();
  
                  // Get the phone number and OTP
                  var phone = $('#phone-number').val();
                  var otp = $('#otp').val();

                  console.log(phone);
                //   console.log(phone);
                    $.ajax({
                      type: 'POST',
                      url: "{{ route('frontend.auth.verify.otp') }}", 
                      data: {_token:"{{ csrf_token() }}",mobile_no:phone,otp:otp},
                      success: function(response) {
                        console.log(response);
                        console.log(response.link);
                        response = JSON.parse(response);
                              console.log(response);
                              if (response.error) {
                                
                              }
                              window.location.reload();
                              $('.otp-box').show(); 
                              
                              $('.genrated-otp').text(response.otp); 
                              $('.request-otp').hide(); 
                              $('.register-submit').show(); 
                                                         
                          }
                      });
                });
        




    });

                
</script>
    @if (config('access.captcha.registration'))
        @captchaScripts
    @endif
@endpush