<?php

require_once("models/User.php");

$userModel = new User();

$fullName = $userModel->getFullName($review->user);

if($review->user->image == "") {
  $review->user->image = "user.png";
}

?>


<div class="row ml-1 mt-5 w-25">
      <div class="col-6">
      <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>"><div class="review-profile" style="background-image: url('<?= $BASE_URL ?>/img/users/<?= $review->user->image?>');"></div></a>
      </div>
      <div class="col-6"> 
      <h4 class="mt-5"><?= $fullName?></h4>
        <i class="fas fa-star"></i><?=$review->rating ?>
      </div>
      <div class="col-12 text-secondary">
      <h6>Comentario:</h6>
      </div>
      <div class="col mt-2">
      <p><?=$review->review ?></p>
      </div>
    </div>