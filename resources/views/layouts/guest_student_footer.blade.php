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
            <div class="col-md-6 mt-md-0 mt-3">
                <b class="font-weight-bold"><i calss="map-marker-alt"></i>{{trans('messages.address')}} {{$institute->address}}</b><br/><br/>
                <b class="font-weight-bold"><i class="glyphicon glyphicon-earphone"></i>{{trans('messages.telephone')}}:
                    {{$institute->phoneNo}}</b><br/><br/>
                <b class="font-weight-bold"><i class="glyphicon glyphicon-envelope"></i>E-mail: {{$institute->email}}</b><br/>
            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none pb-3">

            <!-- Grid column -->
            <div class="col-md-6 mb-md-0 mb-3">


            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Text -->

    <!-- Copyright --><br/><br/><br/><br/>
    <div class="footer-copyright text-center py-3 text-light">© {{date('Y')}} Powered by: ZMA Incorp</a>
    </div>
    <!-- Copyright -->

</footer>