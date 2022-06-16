{{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div> --}}


<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                {{ $logo}}
              </div>
              <h4>Bienvenido!</h4>              
              <h6 class="font-weight-light">Feliz de Verte de Nuevo!</h6>
              {{ $slot }}
            </div>
          </div>          
          <div class="col-lg-6 login-half-bg d-flex flex-row">
          </div>
        </div>
      </div>    
    </div>    
</div>