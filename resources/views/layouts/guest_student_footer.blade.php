<!-- Footer -->
<footer class="page-footer font-small teal pt-4" style="background-color: black;">

    <!-- Footer Text -->
    <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row text-light">
        <?php

        use App\Institute;
        $institute = Institute::select('*')->first();
        if (!$institute) {
            $institute = new Institute;
            $institute->name = "Название учереждения";
        }

        ?>
        <!-- Grid column -->
            <div class="col-md-4"></div>
            <div class="col-md-4 col-centered mt-md-0 mt-3">
                <center>
                    <b class="font-weight-bold"><i
                                class="fas fa-map-marker-alt"></i> {{trans('messages.address')}} {{$institute->address}}
                    </b><br/><br/>
                    <b class="font-weight-bold"><i class="fa fa-phone"></i> {{trans('messages.telephone')}}:
                        {{$institute->phoneNo}}</b><br/><br/>
                    <b class="font-weight-bold"><i class="fa fa-envelope"></i> E-mail: {{$institute->email}}</b><br/>
                </center>
            </div>

            <div class="col-md-4"></div>

            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Text -->

    <!-- Copyright --><br/><br/><br/><br/>
    <div class="footer-copyright text-center py-3 text-light">© {{date('Y')}} Powered by: ZMA Incorporation</a>
    </div>
    <!-- Copyright -->

</footer>