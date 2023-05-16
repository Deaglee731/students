<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<head>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href=" {{ route('groups.index') }} ">FWT</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('students.index') }}">Student</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('groups.index') }}">Group</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('subjects.index') }}">Subject</a>
          </li>
        </ul>
      </div>
    </div>
    @auth
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="btn-group">
          <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->fullName }}
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href=" {{ route('profile.index') }} ">
                <button class="btn">
                  Profile
                </button>
              </a></li>
            <li><a class="dropdown-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="btn">
                    Logout
                  </button>
                </form>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
    @endauth
  </nav>
  @guest
  @include('auth.login')
  @endguest
</head>

</html>
