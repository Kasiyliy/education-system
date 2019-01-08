@extends('layouts.guest_student_master')

@section('title', 'ASTCGlobal')

@section('content')
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
@endsection