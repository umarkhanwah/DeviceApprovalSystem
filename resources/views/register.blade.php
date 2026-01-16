<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>Sign Up</title>
  </head>
  <body class="d-flex vw-100 vh-100 align-items-center justify-content-center">
  
                <form action="{{ route('signup.register') }}" method="POST">
                    @csrf

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Your Name</label>
                    <input type="text" class="form-control" name="name" >
                    @error('name')
                    <div  class="form-text text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    @error('email')
                    <div  class="form-text text-danger">{{ $message }}</div>
                    @enderror
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                    <div  class="form-text text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>





   
  </body>
</html>
