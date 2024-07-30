@include("User.head")

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
@include("User.header")

    <!-- Page Content -->
    <!-- Banner Starts Here -->
@include("User.slider")
@include("User.latest")
@include("User.body")


@include("User.footer")