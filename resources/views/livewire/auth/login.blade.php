<div class="col-md-7 col-lg-5 mx-auto">
    <div class="bg-light py-2 px-4 rounded">
        <h4 class="text-center py-2">Login now!</h4>
        @if (session()->has('invalid'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid! </strong> {{session('invalid')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form wire:submit.prevent='loginUser()'>
            <div class="mb-3">
                <label for="username" class="form-label">Username/Email :</label>
                <input wire:model='username' type="text" name="username" class="form-control" placeholder="Your email or username..." autofocus>
                @error('username')
                <p class="text-danger">{{$message}}</p>
                @enderror
                
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password :</label>
                <input  wire:model='password' type="password" name="password" class="form-control">
                @error('password')
                <p class="text-danger">{{$message}}</p>
                @enderror

            </div>
            <div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </form>
    </div>
</div>