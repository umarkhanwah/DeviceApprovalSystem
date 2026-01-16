<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>Login</title>
  </head>
  <body class="d-flex flex-column vw-100 vh-100 align-items-center justify-content-center">
   <div class="col-6">

       <div class="card shadow p-4" style="max-width: 400px; margin: auto;">
    <h3 class="text-center mb-4">Login</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" id="loginForm">
        @csrf
        <input type="hidden" name="device_id" id="device_id">
        
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" 
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Login</button>
        </div>
    </form>

    <div class="text-center mt-3">
        <p>Don't have an account? <a href="{{ route('signup.register') }}">Create Account</a></p>
    </div>
</div>

<script>
    // Improved Fingerprint logic
    function generateFingerprint() {
        const info = [
            navigator.userAgent,
            navigator.language,
            window.screen.colorDepth,
            window.screen.width + 'x' + window.screen.height,
            new Date().getTimezoneOffset()
        ].join('###');
        
        return btoa(info); // Unique string for this device
    }
    document.getElementById('device_id').value = generateFingerprint();
</script>    
</div>



  </body>
</html>
