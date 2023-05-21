<?php

include_once("templates/header.php");

require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao->verifyToken();
?>
<div id="main-container" class="container-fluid">
  <h1>Edita perfil</h1>
</div>
<?php

include_once("templates/footer.php");

?>