<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>iBake - Tier's of Joy | Customize Cake</title>

    <!-- Header Section -->
    @include('partials.head')
    <!-- <link href="{{ asset('css/cake.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/cake-main.css') }}" rel="stylesheet">
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        @include('partials.preloader')

        <!-- Navbar -->
        @include('partials.navbar')

        <!--Page Title-->
        <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
            <div class="auto-container">
                <h1>Your Cakes</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">home</a></li>
                    <li>Customize Cake</li>
                </ul>
            </div>
        </section>
        <!--End Page Title-->

        <script>
       
        </script>
        <!-- Contact Section -->
        <section class="customize-section" >
        

            <div class="auto-container">
                <div class="sec-title text-center">
                    <div class="divider"><img src="images/icons/divider_1.png" alt=""></div>
                    <h2>Make your own Cake with Us</h2>
                    <div class="text">
                    Build your cake of choice with our intuitive cake builder!!
                    </div>
                </div>
                <div class="row clearfix" >
                    <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-column">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                                <h4>Build Your Cake or <a href="#uploadrefcake">Upload Photo</a></h4>
                            </div>

                            <div class="customize-info">
                                <div class="cakeSummary d-none mt-2">
                                    <h5 class="mb-2">Your custom cake:</h5>
                                    <ul>
                                        <li><i class="fa fa-check"></i> <span id="cakeSize"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeFlavor"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeFilling"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeIcing"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeTopBorder"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeBottomBorder"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeDecoration"></span></li>
                                        <li><i class="fa fa-check"></i> <span id="cakeMessage"></span></li>
                                        
                                    </ul>
                                    <h4 class="mt-3 d-flex justify-content-between">
                                        <p>Total:</p>    
                                        <span id="cakePrice"></span>
                                    </h4>
                                    <hr>
                                </div>


                                <div id="slide1" class="mt-2 steps">
                                    <h5 class="mb-2">Size:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="size-label font-weight-bold text-left">Small</p>
                                            <span class="align-left font-italic font-light-weight">12 Servings</span>
                                            </div>
                                            <p class="font-weight-bold">
                                                <span class="cake-price">120</span>PHP
                                            </p>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="size-label font-weight-bold text-left">Medium</p>
                                            <span class="align-left font-italic font-light-weight">24 Servings</span>
                                            </div>
                                            <p class="font-weight-bold">
                                                <span class="cake-price">180</span>PHP
                                            </p>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="size-label font-weight-bold text-left">Large</p>
                                            <span class="align-left font-italic font-light-weight">32 Servings</span>
                                            </div>
                                            <p class="font-weight-bold">
                                                <span class="cake-price">220</span>PHP
                                            </p>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide2" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Flavor:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flavor font-weight-bold text-left">Chocolate</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flavor font-weight-bold text-left">Strawberry</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flavor font-weight-bold text-left">Ube</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide3" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Filling:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-filling font-weight-bold text-left">Bavarian</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-filling font-weight-bold text-left">Blueberry</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-filling font-weight-bold text-left">Vanilla</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide4" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Icing:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-icing font-weight-bold text-left">Blue</p>
                                            </div>
                                        </div>
                                        
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-icing font-weight-bold text-left">Red</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-icing font-weight-bold text-left">Yellow </p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide5" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Top Border:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-top-border font-weight-bold text-left">Gray</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-top-border font-weight-bold text-left">Pink</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-top-border font-weight-bold text-left">Red</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide6" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Bottom Border:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-bottom-border font-weight-bold text-left">Gray</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-bottom-border font-weight-bold text-left">Pink</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-bottom-border font-weight-bold text-left">Red</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide7" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Decoration:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">None</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <p>Flower Color</p>
                                    
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">Gray</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">Pink</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">Red</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">Orange</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <button type="button" class="btn sizes container-fluid   py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                            <p class="cake-flower-color font-weight-bold text-left">Yellow</p>
                                            </div>
                                        </div>
                                    </button>
                                </div>

                                <div id="slide8" class="mt-2 steps d-none">
                                    <h5 class="mb-2">Message:</h5>
                                    <button type="button" class="btn sizes container-fluid  py-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p class="cake-message font-weight-bold text-left">None</p>
                                            </div>
                                        </div>
                                    </button>
                                    <hr>
                                    <textarea id="cake-message" class="cake-message" rows="4" colspan="100" style="width:100%; border:2px solid black; border-radius:12px;padding:10px;" placeholder="enter short message"> </textarea>
                                    
                                </div>

                                <div class="steps-buttons mt-5 text-center container-fluid d-flex justify-content-between justify-items-center">
                                    <button class="btn" id="prevStep">Previous</button>
                                    <div class="btn">
                                        <span id="currentStep">1</span> / <span>8</span>
                                    </div>
                                    <button class="btn" id="nextStep">Next</button>
                                </div>
                                    <?php if (Auth::check()) { ?>
                                        <form method="POST" action="{{ route('custom-orders') }}">
                                            @csrf
                                            <div style="display:none;">
                                                <input type="" value="" id="cakeSizeval" name="cakeSize">
                                                <input type="" value="" id="cakeFlavorval" name="cakeFlavor">
                                                <input type="" value="" id="cakeFillingval" name="cakeFilling">
                                                <input type="" value="" id="cakeIcingval" name="cakeIcing">
                                                <input type="" value="" id="cakeTopBorderval" name="cakeTopBorder">
                                                <input type="" value="" id="cakeBottomBorderval" name="cakeBottomBorder">
                                                <input type="" value="" id="cakeDecorationval" name="cakeDecoration">
                                                <input type="" value="" id="cakeMessageval" name="cakeMessage">
                                                <input type="" value="" id="cakePriceval" name="cakePrice">
                                            </div>
                                            <div class="go-back mt-5 text-center container-fluid d-none justify-content-end justify-items-center">
                                                <button type="submit" class="btn btn-primary btn-sm form-control" id="cOrderbtn">Order</button>
                                                <button class="btn btn-default form-control" id="editChoices">Edit choices</button>
                                            </div>
                                        </form>
                                    <?php }else{?>
                                        <div class="alert alert-warning" role="alert">
                                          Please <a href="{{ route('login') }}">login</a> to proceed your Order...
                                        </div>
                                    <?php } ?>

                            </div>
                        </div>
                    </div>

                    <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div id="cake-container">
                            <div id="birthday-cake">
                                <div id="cakeType" class="cake" style="--cake-flavor-bg:#ddb892; --cake-filling-top-bg:#b08968;">
                                    <div id="flavorType" class="filling" style="--cake-fillings-bg:#b08968;"></div>
                                    <div id="top-borders" class="top-borders" style="--cake-border-top-bg:#7f5539;"></div>
                                    <div id="topIcing" class="top" style="--cake-icing-bg:#7f5539;"></div>
                                    <div id="bottom-borders" class="bottom-borders" style="--cake-border-bottom-bg:#7f5539;"></div>
                                </div>
                                <div class="candles">
                                    <div class="flame"></div>
                                    <div class="flame2"></div>
                                    <div class="flame3"></div>
                                    <div class="shadows"></div>
                                </div>
                                <div class="decors" id="decors" style="--flower-bg:orange">
                                    <div class="flower">
                                        <div class="centerplain"></div>
                                        <div class="petal1"></div>
                                        <div class="petal2"></div>
                                        <div class="petal3"></div>
                                        <div class="petal4"></div>
                                        <div class="petal5"></div>
                                        <div class="petal6"></div>
                                        <div class="petal7"></div>
                                        <div class="petal8"></div>
                                        <div class="leaf1"></div>
                                        <div class="leaf2"></div>
                                    </div>
                                    <div class="flower2">
                                        <div class="centerplain"></div>
                                        <div class="petal1"></div>
                                        <div class="petal2"></div>
                                        <div class="petal3"></div>
                                        <div class="petal4"></div>
                                        <div class="petal5"></div>
                                        <div class="petal6"></div>
                                        <div class="petal7"></div>
                                        <div class="petal8"></div>
                                        <div class="leaf1"></div>
                                        <div class="leaf2"></div>
                                    </div>
                                    <div class="flower3">
                                        <div class="centerplain"></div>
                                        <div class="petal1"></div>
                                        <div class="petal2"></div>
                                        <div class="petal3"></div>
                                        <div class="petal4"></div>
                                        <div class="petal5"></div>
                                        <div class="petal6"></div>
                                        <div class="petal7"></div>
                                        <div class="petal8"></div>
                                        <div class="leaf1"></div>
                                        <div class="leaf2"></div>
                                    </div>
                                    <div class="flower4">
                                        <div class="centerplain"></div>
                                        <div class="petal1"></div>
                                        <div class="petal2"></div>
                                        <div class="petal3"></div>
                                        <div class="petal4"></div>
                                        <div class="petal5"></div>
                                        <div class="petal6"></div>
                                        <div class="petal7"></div>
                                        <div class="petal8"></div>
                                        <div class="leaf1"></div>
                                        <div class="leaf2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="uploadrefcake">
                    <div class="row clearfix">
                        <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="title">
                                <div class="icon"><img src="images/icons/icon-devider-gray.png" alt=""></div>
                                <h4>Upload Photo of your prefer Cake..</h4>
                            </div>
                            <br>
                            <div class="inner-column">
                                <form action="{{ route('customer.upload-order-photo') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="cakeOrderImage" accept="image/gif, image/jpg, image/png, image/jpeg" onchange="loadFile(event)" required="" rows="4" colspan="100" style="width:100%; border:2px solid black; border-radius:12px;padding:10px;"><br><br>
                                    <textarea class="cake-message" name="cakeMessage" rows="4" colspan="100" style="width:100%; border:2px solid black; border-radius:12px;padding:10px;" placeholder="Additional Info..." name="cakeImageDetails"></textarea>
                                    <?php if (Auth::check()) { ?>
                                        <button type="submit" class="btn btn-primary form-control">Send Order</button>
                                    <?php }else{?>
                                        <div class="alert alert-warning" role="alert">
                                          Please <a href="{{ route('login') }}">login</a> to proceed your Order...
                                        </div>
                                    <?php } ?>    
                                </form>
                            </div>
                        </div>

                        <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <img id="output" style="width: 100%;height: auto;margin-top: 70px;border-radius:5% ;" src=""/>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </section>
        <!--End Contact Section -->


        <!-- Footer Section -->
        @include('partials.footer')

    </div><!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    @include('partials.scroll-to-top')

    <!--Google Map APi-->
    <script src="js/jquery.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/script.js"></script>

    <script>
        let index = 1
        let yourCakeBuild = {
            size:null,
            flavor:null,
            icing:null,
            filling:null,
            topBorder:null,
            bottomBorder:null,
            decorColor:null,
            message:null,
            price:null
        }
        
        $(document).ready(function(){

            $.fn.removeStyle = function(style)
            {
                var search = new RegExp(style + '[^;]+;?', 'g');

                return this.each(function()
                {
                    $(this).attr('style', function(i, style)
                    {
                        return style && style.replace(search, '');
                    });
                });
            };
            $('#slide1 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide1 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.size = $(this).find('.size-label').html()
                    yourCakeBuild.price = $(this).find('.cake-price').html()
                })
            })
            $('#slide2 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide2 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.flavor = $(this).find('.cake-flavor').html().trim()
                    if(yourCakeBuild.flavor=='Chocolate'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#593d2a"; //brown
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.flavor=='Strawberry'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#fc5a8d "; // pink
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.flavor=='Ube'){
                        $('#cakeType').removeStyle('--cake-flavor-bg')
                        var cssVariableName = "--cake-flavor-bg";
                        var cssVariableValue = "#8878c3";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                    }
                })
            })
            $('#slide3 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide3 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.filling = $(this).find('.cake-filling').html().trim()
                    if(yourCakeBuild.filling=='Bavarian'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#0099d5";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#0099d5";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                        // yourCakeBuild.price = parseInt(yourCakeBuild.price.replace("PHP","")) + 1000 + "PHP"
                    } else if(yourCakeBuild.filling=='Blueberry'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#4f86f7";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#4f86f7";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    } else if(yourCakeBuild.filling=='Vanilla'){
                        $('#cakeType').removeStyle('--cake-filling-top-bg')
                        var cssVariableName = "--cake-filling-top-bg";
                        var cssVariableValue = "#F3E5AB";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue);
                        $('#flavorType').removeStyle('--cake-fillings-bg')
                        var cssVariableName = "--cake-fillings-bg";
                        var cssVariableValue = "#F3E5AB";
                        document.getElementById('flavorType').style.setProperty(cssVariableName, cssVariableValue);
                    }
                })
            })
            $('#slide4 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide4 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.icing = $(this).find('.cake-icing').html().trim()
                    if(yourCakeBuild.icing=='Blue'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "blue";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Red'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "red";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.icing=='Yellow'){
                        $('#topIcing').removeStyle('--cake-icing-bg')
                        var cssVariableName = "--cake-icing-bg";
                        var cssVariableValue = "yellow";
                        document.getElementById('cakeType').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide5 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide5 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.topBorder = $(this).find('.cake-top-border').html().trim()
                    if(yourCakeBuild.topBorder=='Gray'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "gray";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Pink'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "pink";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.topBorder=='Red'){
                        $('#top-borders').removeStyle('--cake-border-top-bg')
                        var cssVariableName = "--cake-border-top-bg";
                        var cssVariableValue = "red";
                        document.getElementById('top-borders').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide6 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide6 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.bottomBorder = $(this).find('.cake-bottom-border').html().trim()
                    if(yourCakeBuild.bottomBorder=='Gray'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "gray";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Pink'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "pink";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.bottomBorder=='Red'){
                        $('#bottom-borders').removeStyle('--cake-border-bottom-bg')
                        var cssVariableName = "--cake-border-bottom-bg";
                        var cssVariableValue = "red";
                        document.getElementById('bottom-borders').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide7 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide7 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    $('#decors').removeClass('d-none')
                    yourCakeBuild.decorColor = $(this).find('.cake-flower-color').html().trim()
                    if(yourCakeBuild.decorColor=='Gray'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "gray";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Pink'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "pink";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Red'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "red";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Orange'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "orange";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='Yellow'){
                        $('#decors').removeStyle('--flower-bg')
                        var cssVariableName = "--flower-bg";
                        var cssVariableValue = "yellow";
                        document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    } else if(yourCakeBuild.decorColor=='None'){
                        $('#decors').addClass('d-none')
                        // var cssVariableName = "--flower-bg";
                        // var cssVariableValue = "yellow";
                        // document.getElementById('decors').style.setProperty(cssVariableName, cssVariableValue)
                    }
                })
            })

            $('#slide8 > button').each(function(i,el){
                $(this).on('click',function(){
                    $('#slide8 > button').each(function(){
                        $(this).removeClass('border border-info')
                    });
                    $(this).addClass('border border-info')
                    yourCakeBuild.message = $(this).find('.cake-message').html().trim()
                    if(yourCakeBuild.message=='None'){
                        yourCakeBuild.message = 'None'
                        $('#cake-message').val('')
                        $('#cake-message').prop('readonly',true)
                    } 
                })
            })

            $('#cake-message').on('click',function(){
                $(this).prop('readonly',false)
            })
            $('#cake-message').on('change',function(){
                yourCakeBuild.message = $(this).val()
            })

            $('#nextStep').on('click',function(){
                if(index==1) {
                    if(yourCakeBuild.size==null) return
                } else if(index==2) {
                    if(yourCakeBuild.flavor==null) return
                } else if(index==3) {
                    if(yourCakeBuild.filling==null) return
                } else if(index==4) {
                    if(yourCakeBuild.icing==null) return
                } else if(index==5) {
                    if(yourCakeBuild.topBorder==null) return
                } else if(index==6) {
                    if(yourCakeBuild.bottomBorder==null) return
                } else if(index==7) {
                    if(yourCakeBuild.decorColor==null) return
                }
                
                if(index==8) {
                    if(yourCakeBuild.message==null) return
                    $('.steps-buttons').addClass('d-none')
                    $('.steps-buttons').removeClass('d-flex')
                    $('.go-back').removeClass('d-none')
                    $('.go-back').addClass('d-flex')
                    $('.cakeSummary').removeClass('d-none')
                    $('.steps').each(function(i,el){
                        $(this).addClass('d-none')
                    })
                    // Cake Customized order summary data
                    $('#cakeSize').html('Size: ' +yourCakeBuild.size)
                    $('#cakeSizeval').val(yourCakeBuild.size)

                    $('#cakeFlavor').html('Flavor: ' +yourCakeBuild.flavor)
                    $('#cakeFlavorval').val(yourCakeBuild.flavor)

                    $('#cakeFilling').html('Filling: ' +yourCakeBuild.filling)
                    $('#cakeFillingval').val(yourCakeBuild.filling)

                    $('#cakeIcing').html('Icing: ' +yourCakeBuild.icing)
                    $('#cakeIcingval').val(yourCakeBuild.icing)

                    $('#cakeTopBorder').html('Top Border: ' +yourCakeBuild.topBorder)
                    $('#cakeTopBorderval').val(yourCakeBuild.topBorder)

                    $('#cakeBottomBorder').html('Bottom Border: ' +yourCakeBuild.bottomBorder)
                    $('#cakeBottomBorderval').val(yourCakeBuild.bottomBorder)

                    if(yourCakeBuild.decorColor == 'None') {
                        $('#cakeDecoration').html('Decoration: ' +yourCakeBuild.decorColor)
                        $('#cakeDecorationval').val(yourCakeBuild.decorColor)
                    } else {
                        $('#cakeDecoration').html('Decoration: ' +yourCakeBuild.decorColor+ ' Flower')
                        $('#cakeDecorationval').val(yourCakeBuild.decorColor+ ' Flower')
                    }

                    $('#cakeMessage').html('Message: ' +yourCakeBuild.message)
                    $('#cakeMessageval').val(yourCakeBuild.message)

                    $('#cakePrice').html(yourCakeBuild.price)
                    $('#cakePriceval').val(yourCakeBuild.price)

                }
                index++
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                        
                    }
                })
                $('#currentStep').html(index)
            })
            $('#prevStep').on('click',function(){
                if(index==1) return
                index--
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                })
                $('#currentStep').html(index)
            })

            $('#editChoices').on('click',function(){
                index = 1
                $('.go-back').addClass('d-none')
                $('.go-back').removeClass('d-flex')
                $('.steps-buttons').removeClass('d-none')
                $('.steps-buttons').addClass('d-flex')
                $('#currentStep').html(index)
                $('.cakeSummary').addClass('d-none')
                $('.steps').each(function(i,el){
                    if(i==index-1) {
                        $(this).removeClass('d-none')
                    } else {
                        $(this).addClass('d-none')
                    }
                })
            })
        })
    </script>
    <script>
      var loadFile = function(event) {
      var reader = new FileReader();
          reader.onload = function(){
              var output = document.getElementById('output');
                              
              output.src = reader.result;

          };
          reader.readAsDataURL(event.target.files[0]);
      };
    </script>



</body>

</html>
