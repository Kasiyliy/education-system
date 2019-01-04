
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASTC Global</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="assets/front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="assets/front/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/front/css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container-fluid" style='width:90%'>
              <a class="navbar-brand js-scroll-trigger" href="#page-top">
                  <img src="assets/images/PNGGold.png" alt="ASTC GLOBAL" width='120px' class="img img-responsive">
              </a>
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">О нас</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" >Курсы<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{URL::route('department.create')}}">Глобальный курс</a></li>
                      @can('Student')
                      <li><a href="{{URL::route('department.index')}}">Мои курсы</a></li>
                    @endcan
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">Отзывы</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Контакты</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="login">Вход</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>


    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h5 class="">
              <strong>Дорогой друг,</strong></br>
            <strong>Мы рады приветствовать Вас!</strong></br>
            <strong>Позвольте нам стать вашим путеводителем к успеху в приобретении ценных знаний! Ведь сегодня это неотъемлемый фактор развития.</strong> </br>
            <strong>Мы искренне верим в то, что подготовленный специально для вас курс, откроет перед вами двери к новым вершинам !</strong></br>
            </h5>
            <hr class = "light my-4">
          </div>
          <div class="col-lg-8 mx-auto">
            <p class="text-white mb-5 text-right">
                Искренне ваши ,</br>
                Команда </br>
                ASTC GLOBAL</br>
            </p>
          </div>
        </div>
      </div>
    </header>

    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">Наши курсы!</h2>
            <hr class="light my-4">
            <p class="text-faded mb-4">Помогут вам получить сертификат!</p>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">На наших курсах</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-1"></i>
              <h3 class="mb-3">Прохождение онлайн обучения</h3>
              <p class="text-muted mb-0">Наши курсы составлены очень круто.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-2"></i>
              <h3 class="mb-3">Прохождение онлайн теста</h3>
              <p class="text-muted mb-0">После прохождение обучения вам будет доступен тест!</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-file-alt text-primary mb-3 sr-icon-3"></i>
              <h3 class="mb-3">Получение сертификата</h3>
              <p class="text-muted mb-0">После завершения курса вам будет доступен сертификат.</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fas fa-4x fa-heart text-primary mb-3 sr-icon-4"></i>
              <h3 class="mb-3">Мы все сделали с любовью к нашим ученикам</h3>
              <p class="text-muted mb-0">Наши курсы были сделаны специально для вас!</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
        <div class="row no-gutters popup-gallery">
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/1.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/1.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/2.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/2.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/3.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/3.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/4.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/4.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/5.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/5.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-6">
            <a class="portfolio-box" href="assets/front/img/portfolio/fullsize/6.jpg">
              <img class="img-fluid" src="assets/front/img/portfolio/thumbnails/6.jpg" alt="">
              <div class="portfolio-box-caption">
                <div class="portfolio-box-caption-content">
                  <div class="project-category text-faded">
                    Category
                  </div>
                  <div class="project-name">
                    Project Name
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading">Хотите связаться с нами!</h2>
            <hr class="my-4">
            <p class="mb-5">Хотели связаться с нами и получить доступ к курсам?</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 ml-auto text-center">
            <i class="fas fa-phone fa-3x mb-3 sr-contact-1"></i>
            <p>+7-707-707-77-77</p>
          </div>
          <div class="col-lg-4 mr-auto text-center">
            <i class="fas fa-envelope fa-3x mb-3 sr-contact-2"></i>
            <p>
              <a href="mailto:your-email@your-domain.com">astcglobal@gmail.com</a>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/front/vendor/jquery/jquery.min.js"></script>
    <script src="assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="assets/front/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/front/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="assets/front/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="assets/front/js/creative.min.js"></script>

  </body>

</html>
