<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Bidding App</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/html/home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0" >
      <?php
        if(!isset($_SESSION["islogined"]))
        {
          echo '
            <form>
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </form>
            <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit" onclick="login()" >Login To Bid</button>
            <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit" onclick="register()" >Signup To Bid</button>     
          ';
        }
        else
        {
          echo '
          <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit" onclick="info()" >Welcome '.$_SESSION["fullname"].'</button>
          <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit" onclick="signout()" >Signout</button> 
          ';
        }
        ?>
    </div>
  </div>
</nav>
<?php
if(isset($_GET["msg"]) && isset($_GET["status"]) && $_GET["status"]=="fail")
{ 
    echo "<div class=\"alert alert-danger\">
        <strong>Message Error:</strong><h2>".$_GET["msg"]."</h2>.
    </div>";
}
elseif(isset($_GET["msg"]) && isset($_GET["status"]) && $_GET["status"]=="success")
{ 
    echo "<div class=\"alert alert-success\">
        <strong>Message Success:</strong><h2>".$_GET["msg"]."</h2>.
    </div>";
} 
?>