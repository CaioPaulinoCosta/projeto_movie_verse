<?php
  require_once("templates/header.php");
?>
 <div id="main-container" class="container-fluid">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container">
        <div class="card movie-card">
          <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/movie_cover.jpg');"></div>
          <div class="card-body">
            <p class="card-rating">
              <i class="fas fa-star"></i>
              <span class="rating">9</span>
            </p>
            <h5 class="card-title">
              <a href="#">Titulo do Filme</a>
            </h5>
          </div>
        </div>
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container">
        <p class="empty-list">Ainda não há filmes de ação cadastrados!</p>
    </div>
    <h2 class="section-title">Comédia</h2>
    <p class="section-description">Veja os melhores filmes de comédia</p>
    <div class="movies-container">
        <p class="empty-list">Ainda não há filmes de comédia cadastrados!</p>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>