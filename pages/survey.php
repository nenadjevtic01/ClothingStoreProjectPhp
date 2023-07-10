<section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center d-flex flex-column">
              <h3>Survey</h3>
                <?php
                    $username=$_SESSION['username'];
                    $id=fetchId($username);
                    fetchSurvey($id);
                ?>
            </div>
          </div>
        </div>
      </div>
    </section>