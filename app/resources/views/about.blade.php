@extends('layout')

@section('content')
<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--19">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center brad__white">
                                <h2 class="bradcaump-title">Sobre nosotros</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="{{env('APP_URL')}}">Inicio</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                  <span class="breadcrumb-item active">Sobre nosotros</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->

        <!-- Start About Us Area  -->
        <section class="food__about__us__area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title title__style--2 service__align--center">
                            <h2 class="title__line">Why Choose Us</h2>
                            <p>The process of our service </p>
                        </div>
                    </div>
                </div>
                <div class="row mt--80">
                    <div class="col-lg-6 col-sm-12 col-md-12 align-self-center">
                        <div class="food__container">
                            <div class="food__inner">
                                <h2>Watch Videos to Know more About Aahar</h2>
                                <p>Lorem ipsum dolor sit amsa vadip isicing elit, seddei han  liqua. Ut enim ad miveniam, quis noion ullam.</p>
                            </div>
                            <div class="food__details">
                                <p>Lorem ipsum dolor sit amadipisicing elit, seddei smod dolore maaliqua. Ut enim ad miveniam, quis noion ullaml aboris nisi umt aliquip cequatL ipsum dolor sit ac adipis icling elit, se eiusmod tempor incididunt labmn hmagna aliqua. Ut enim ad minim veniam, quis nostr</p>
                            </div>
                            <div class="food__tab">
                                <div class="food__nav nav nav-tabs d-block" role="tablist">
                                    <a class="active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">1. History of Aahar (2000-2017)</a>

                                    <a id="nav-prepare-tab" data-toggle="tab" href="#prepare" role="tab" aria-controls="prepare" aria-selected="false">2. How  We prepare your meals</a>

                                    <a id="nav-meals-tab" data-toggle="tab" href="#meals" role="tab" aria-controls="meals" aria-selected="false">3. How  We prepare your meals</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 col-md-12">
                        <div class="food__video__wrap tab-content" id="nav-tabContent">
                            <!-- Start Single Video -->
                            <div class="video__owl__activation tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="about__video__activation owl-carousel owl-theme">
                                    <div class="about__video__inner">
                                        <div class="about__video__thumb">
                                            <img src="{{asset('public/images/about/video/1.jpg')}}" alt="video images">
                                            <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I">
                                              <img src="{{asset('public/images/icon/play.png')}}" alt="viveo play icon"></a>
                                        </div>
                                        <div class="about__video__content">
                                            <span>1</span>
                                        </div>
                                    </div>
                                    <div class="about__video__inner">
                                        <div class="about__video__thumb">
                                            <img src="{{asset('public/images/about/video/2.jpg')}}" alt="video images">
                                            <a class="video-play-button" href="https://www.youtube.com/watch?v=wJ9Ll8uD07I"><img src="images/icon/play.png" alt="viveo play icon"></a>
                                        </div>
                                        <div class="about__video__content">
                                            <span>2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Video -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Us Area  -->
        <!-- Start Accordion Area -->
                <section class="food__acconrdion__area bg--white section-padding--lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="section__title title__style--2 service__align--center">
                                    <h2 class="title__line">Frequantly Ask Question</h2>
                                    <p>The process of our service </p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt--80 pb--60">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="accordion" class="food_accordion" role="tablist">
                                    <div class="card">
                                        <div class="acc-header" role="tab" id="headingOne">
                                          <h5>
                                                <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne"><span>1.</span> Djanj  sit amet, consectetur adipisicing elit, sed do eiusmod temrem ?</a>
                                          </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magaliqua. oenim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duidolreprehendevoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecupidatat proident, sunt in culpa qui officideserunt mollitanim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium d sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labor fqa cabfm szdt jkasp faq havrtm
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="acc-header" role="tab" id="headingTwo">
                                          <h5>
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                <span>2.</span> Djanj  sit amet, consectetur adipisicing elit, sed do eiusmod tem pororem ?.
                                            </a>
                                          </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                          <div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magaliqua. oenim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duidolreprehendevoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecupidatat proident, sunt in culpa qui officideserunt mollitanim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium d sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labor fqa cabfm szdt jkasp faq havrtm
                                          </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="acc-header" role="tab" id="headingThree">
                                          <h5>
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                                <span>3.</span> Djanj  sit amet, consectetur adipisicing elit, sed do eiusmod tem pororem ?.
                                            </a>
                                          </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magaliqua. oenim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duidolreprehendevoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecupidatat proident, sunt in culpa qui officideserunt mollitanim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium d sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco labor fqa cabfm szdt jkasp faq havrtm
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End Accordion Area -->        

@endsection
