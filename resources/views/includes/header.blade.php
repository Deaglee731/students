<!DOCTYPE html>
<html>

<head>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="https://framework.team/">FWT</a>
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
  </nav>
</head>



</html>