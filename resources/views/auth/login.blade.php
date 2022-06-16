<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img src="{{ asset('images/icon.png') }}" alt="logo" style="width: 100px">
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />        

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" /> 

        <form class="pt-3" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-user text-primary"></i>
                  </span>
                </div>
                <input type="text" class="form-control form-control-lg border-left-0" id="email"
                name="email" :value="old('email')" required>   
                           
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="fa fa-lock text-primary"></i>
                  </span>
                </div>
                <input type="password" class="form-control form-control-lg border-left-0" id="password"
                name="password" required autocomplete="current-password">                
              </div>
            </div>
            <div class="my-2 d-flex justify-content-between align-items-center">
              <div class="form-group">
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label"></label>
                  <input type="checkbox" class="form-check-input" id="remember_me" name="remember" >
                  {{ __('Remember Me') }}
                  <i class="input-helper"></i>                  
                </div>
              </div>
              @if (Route::has('password.request'))
                <a class="auth-link text-black" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
              @endif
            </div>
            <div class="my-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                    {{ __('Log in') }}
                </button>                  
            </div>                
          </form>
    </x-auth-card>
</x-guest-layout>
