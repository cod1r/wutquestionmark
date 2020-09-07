      <?php  
      echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Wu?</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/index.php">Home</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/login.php">Profile</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="./ask.php">Ask</a>
                </li>
                  <!--<li class="nav-item dropdown active">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Math</a>
                    <a class="dropdown-item" href="#">Science</a>
                    <a class="dropdown-item" href="#">English</a>
                    <a class="dropdown-item" href="#">Social Studies</a>
                    <a class="dropdown-item" href="#">Computer Science</a>
                  </div>
                  -->
                </li>
              </ul>
              <form action="./search.php" method="GET" class="form-inline p-0 m-0 ">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
          </nav>'
          ?>