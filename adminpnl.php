<?php
    include "config/connection.php";
    include "models/functions.php";
    include "pages/head.php";
    include "pages/header.php";
?>

<?php

  if($_SESSION){
    if($_SESSION["role"]==1){
      echo "<section class='section-margin--small mb-5'>
      <div class='container'>
        <div class='row'>
          <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
            <a class='btn btn-primary w-50 mt-5' href='addProduct.php'>Add new product</a>
          </div>
          <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
            <a class='btn btn-primary w-50 mt-5' href='updateProduct.php'>Update product</a>
          </div>
          <div class='col-md-12 col-lg-4 mt-5 d-flex flex-column align-items-center'>
          <select id='productRemove' class='w-75 mb-2'>
            <option value='0'>Select product</option>";
            echo fetchProductCombo();
          echo "</select>
            <input type='button' class='btn btn-primary w-50' id='btnRemoveProduct' value='Remove product'/>
            <div id='statusProduct' class='mt-1'></div>
          </div>
        </div>
          <div class='row'>
            <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
              <a class='btn btn-primary w-50 mt-5' href='addUser.php'>Add new user</a>
            </div>
            <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
              <a class='btn btn-primary w-50 mt-5' href='updateUser.php'>Update user</a>
            </div>
            <div class='col-md-12 col-lg-4 mt-5 d-flex flex-column align-items-center'>
              <select id='userRemove' class='w-75 mb-2'>
                <option value='0'>Select user</option>";
                echo fetchUserCombo();
              echo "</select>
              <input type='button' class='btn btn-primary w-50' id='btnRemoveUser' value='Remove user'/>
              <div id='statusUser' class='mt-1'></div>
            </div>
          </div>
          <div class='row'>
          <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
            <a class='btn btn-primary w-50 mt-5' href='addSurvey.php'>Add new survey</a>
          </div>
          <div class='col-md-12 col-lg-4 mt-5 h-50 d-flex justify-content-center'>
            <a class='btn btn-primary w-50 mt-5' href='updateSurvey.php'>Update survey</a>
          </div>
          <div class='col-md-12 col-lg-4 mt-5 d-flex flex-column align-items-center'>
            <select id='survey' class='w-75 mb-2'>
              <option value='0'>Select survey</option>";
              echo fetchSurveys();
            echo "</select>
            <input type='button' class='btn btn-primary w-50' id='btnRemoveSurvay' value='Remove survey'/>
              <div id='statusSurvey'>
              </div>
          </div>
        </div>
      </div>
    </section>
    <section class='section-margin--small mb-5'>
      <div class='d-flex justify-content-center'>
          <table class='w-75 table table-striped table-responsive-md'>
            <thead>
              <th>Message ID</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Answer</th>
              <th>User email</th>
              <th>Date</th>
              <th>Status</th>
            </thead>
            <tbody>";
             echo fetchMessages();
            echo" </tbody>
          </table>
      </div>
    </section></br>
    <section class='section-margin--small mb-5'>
      <div class='d-flex justify-content-center'>
          <table class='w-75 table table-striped table-responsive-md'>
            <thead>
              <th>Poll ID</th>
              <th>Question</th>
              <th>Status</th>
              <th>Date</th>
              <th>View stats</th>
            </thead>
            <tbody>";
             echo fetchSurveyAdmin();
            echo" </tbody>
          </table>
      </div>
    </section></br>
    <section class='section-margin--small mb-5'>
      <div class='d-flex justify-content-center'>
          <table class='w-75 table table-striped table-responsive-md'>
            <thead>
              <th>Receipt ID</th>
              <th>User</th>
              <th>Address</th>
              <th>City</th>
              <th>Postal code</th>
              <th>Order note</th>
              <th>Subtotal</th>
              <th>Shipping fee</th>
              <th>Total</th>
              <th>Date</th>
              <th>View order details</th>
            </thead>
            <tbody>";
             echo fetchOrders();
            echo" </tbody>
          </table>
      </div>
    </section></br>
    <section class='section-margin--small mb-5'>
      <div class='d-flex flex-row justify-content-center'>
          <table class='w-75 table table-striped table-responsive-md'>
            <thead>
              <th>User ID</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Role</th>
              <th>Verified</th>
              <th>Registration date</th>
            </thead>
            <tbody>";
             echo fetchUsers();
            echo" </tbody>
          </table>
      </div>
    </section></br>";
    }else{
      echo "<section class='section-margin--small mb-5'><div class='container mt-5'>
      <div class='d-flex justify-content-center mt-5'>
      <h1 class='mt-5'>Restricted area</h1>
      </div>
      </div></section>";
    }
  }else{
    echo "<section class='section-margin--small mb-5'><div class='container mt-5'>
    <div class='d-flex justify-content-center mt-5'>
    <h1 class='mt-5'>Restricted area</h1>
    </div>
    </div></section>";
  }
?>






<?php
  include "pages/footer.php";
?>