<div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="border-bottom text-center pb-4">
              <img src="{{ asset(Auth()->user()->image_user) }}" alt="profile" class="img-lg rounded-circle mb-3"/>
              <p>{{ $bio }}</p>
              <div class="d-flex justify-content-between">
                <button class="btn btn-success">Cambiar Imagen</button>
                {{-- <button class="btn btn-success">Follow</button> --}}
              </div>
            </div>
            <div class="border-bottom py-4">
              <p>Skills</p>
              <div>
                <label class="badge badge-outline-dark">Chalk</label>
                <label class="badge badge-outline-dark">Hand lettering</label>
                <label class="badge badge-outline-dark">Information Design</label>
                <label class="badge badge-outline-dark">Graphic Design</label>
                <label class="badge badge-outline-dark">Web Design</label>  
              </div>                                                               
            </div>
            <div class="border-bottom py-4">
              <div class="d-flex mb-3">
                <div class="progress progress-md flex-grow">
                  <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="d-flex">
                <div class="progress progress-md flex-grow">
                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="py-4">
              <p class="clearfix">
                <span class="float-left">
                  Status
                </span>
                <span class="float-right text-muted">
                  {{ Auth()->user()->status  ? 'Activo' : 'Inacivo' }}
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Phone
                </span>
                <span class="float-right text-muted">{{ $phone }}</span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Email
                </span>
                <span class="float-right text-muted">
                  {{ $email }}
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Facebook
                </span>
                <span class="float-right text-muted">
                  <a href="#">{{ $facebook }}</a>
                </span>
              </p>
              <p class="clearfix">
                <span class="float-left">
                  Twitter
                </span>
                <span class="float-right text-muted">
                  <a href="#">{{ $twitter }}</a>
                </span>
              </p>
            </div>
            <button class="btn btn-primary btn-block">Preview</button>
          </div>
          <div class="col-lg-8 pl-lg-5">
            <div class="d-flex justify-content-between">
              <div>
                <h3>{{ $firstname }}</h3>
                <h4>{{ $lastname }}</h4>
                <div class="d-flex align-items-center">
                  <h5 class="mb-0 mr-2 text-muted">Canada</h5>                  
                </div>
              </div>
              <div>                
                <button class="btn btn-primary" id="perfilupdate" wire:click="edit()">Actualizar</button>
              </div>
            </div>
            <div class="mt-4 py-2 border-top border-bottom">
              <ul class="nav profile-navbar">
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="fa fa-user"></i>
                    Info
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">
                    <i class="fas fa-file"></i>
                    Feed
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="fa fa-calendar"></i>
                    Agenda
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="far fa-file-word"></i>
                    Resume
                  </a>
                </li>
              </ul>
            </div>
            <div class="profile-feed">
              <div class="d-flex align-items-start profile-feed-item">
                <img src="{{ asset(Auth()->user()->image_user) }}" alt="profile" class="img-sm rounded-circle"/>
                <div class="ml-4">
                  <h6>
                    Mason Beck
                    <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                  </h6>
                  <p>
                    There is no better advertisement campaign that is low cost and also successful at the same time.
                  </p>
                  <p class="small text-muted mt-2 mb-0">
                    <span>
                      <i class="fa fa-star mr-1"></i>4
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-comment mr-1"></i>11
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-mail-reply"></i>
                    </span>
                  </p>
                </div>
              </div>
              <div class="d-flex align-items-start profile-feed-item">
                <img src="{{ asset(Auth()->user()->image_user) }}" alt="profile" class="img-sm rounded-circle"/>
                <div class="ml-4">
                  <h6>
                    Willie Stanley
                    <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                  </h6>
                  <p>
                    When I first got into the online advertising business, I was looking for the magical combination 
                    that would put my website into the top search engine rankings
                  </p>
                  <p class="small text-muted mt-2 mb-0">
                    <span>
                      <i class="fa fa-star mr-1"></i>4
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-comment mr-1"></i>11
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-mail-reply"></i>
                    </span>
                  </p>
                </div>
              </div>
              <div class="d-flex align-items-start profile-feed-item">
                <img src="{{ asset(Auth()->user()->image_user) }}" alt="profile" class="img-sm rounded-circle"/>
                <div class="ml-4">
                  <h6>
                    Dylan Silva
                    <small class="ml-4 text-muted"><i class="far fa-clock mr-1"></i>10 hours</small>
                  </h6>
                  <p>
                    When I first got into the online advertising business, I was looking for the magical combination 
                    that would put my website into the top search engine rankings
                  </p>
                  
                  <p class="small text-muted mt-2 mb-0">
                    <span>
                      <i class="fa fa-star mr-1"></i>4
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-comment mr-1"></i>11
                    </span>
                    <span class="ml-2">
                      <i class="fa fa-mail-reply"></i>
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>    
    @include('livewire.profile.form')
</div>
@push('scripts')
    {{-- <script>
      (function($) {
      'use strict';
      $(function() {
        $("#perfilupdate").on("click", function() {
          $("#updateperfil-right-sidebar").toggleClass("open");
        });
        $(".settings-close").on("click", function() {
          $("#updateperfil-right-sidebar,#theme-settings").removeClass("open");
        });

        $("#settings-trigger").on("click" , function(){
          $("#theme-settings").toggleClass("open");
        });
       
      });
    })(jQuery);
    </script> --}}
@endpush