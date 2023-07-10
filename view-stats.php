<?php

    include "config/connection.php";
    include "models/functions.php";
    include "pages/head.php";
    include "pages/header.php";

?>

<?php
     if($_SESSION){
        if($_SESSION["role"]==1){
            $id=$_GET['id'];
            if($id){
              $result=fetchStats($id);
                  if($result['totalAnswers']>0){
                      echo "<section class='section-margin--small mb-5'>
                      <h1 class='text-center pt-5'>Survey statistic</h1></br>
                      <div class='d-flex justify-content-center'>
                          <table class='w-75 table table-striped table-responsive-md'>
                            <thead>
                              <th>Poll ID</th>
                              <th>Total answers</th>
                              <th>Answer Yes</th>
                              <th>Answer Maybe</th>
                              <th>Answer No</th>
                            </thead>
                            <tbody>
                              <tr>
                                  <td>".$id."</td>
                                  <td>".$result["totalAnswers"]."</td>
                                  <td>".$result["yes"]."</td>
                                  <td>".$result["maybe"]."</td>
                                  <td>".$result["no"]."</td>
                              </tr>
                            </tbody>
                          </table>
                      </div>
                      <div class='d-flex justify-content-center'>
                          <input type='button' class='btn btn-primary' value='Back' onclick='redirectAdmin()'/>
                      </div>
                    </section></br>";
                  }else{
                      echo "<section class='section-margin--small mb-5'>
                  <h1 class='text-center pt-5'>Survey statistic</h1></br>
                  <div class='d-flex justify-content-center'>
                      <table class='w-75 table table-striped table-responsive-md'>
                        <thead>
                          <th>Poll ID</th>
                          <th>Total answers</th>
                          <th>Answer Yes</th>
                          <th>Answer Maybe</th>
                          <th>Answer No</th>
                        </thead>
                        <tbody>
                          <tr>
                              <td colspan='5'>No statistic available</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                  <div class='d-flex justify-content-center'>
                      <input type='button' class='btn btn-primary' value='Back' onclick='redirectAdmin()'/>
                  </div>
                  </section></br>";
                  }
            }else{
              echo "<section class='section-margin--small mb-5'>
              <h1 class='text-center pt-5'>Survey statistic</h1></br>
              <div class='d-flex justify-content-center'>
                  <table class='w-75 table table-striped table-responsive-md'>
                    <thead>
                      <th>Poll ID</th>
                      <th>Total answers</th>
                      <th>Answer Yes</th>
                      <th>Answer Maybe</th>
                      <th>Answer No</th>
                    </thead>
                    <tbody>
                      <tr>
                          <td colspan='5'>Access denied.</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              <div class='d-flex justify-content-center'>
                  <input type='button' class='btn btn-primary' value='Back' onclick='redirectAdmin()'/>
              </div>
              </section></br>";
            }
            
            
        }
     }
?>


<?php

    include "pages/footer.php";

?>