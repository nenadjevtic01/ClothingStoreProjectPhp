<?php

function insertUser($firstName, $lastName, $username, $email, $password, $vNumber){
    global $connection;

    $query= "INSERT INTO user(first_name, last_name,email,username, password ,role_id, validation_code,verified) VALUES(:first_name, :last_name, :email, :username, :password, :role_id , :valid_code, :verifiedStatus)";
    $role_id=2;
    $verified_status=0;
    $prepare= $connection->prepare($query);
    $prepare-> bindParam(":first_name",$firstName);
    $prepare-> bindParam(":last_name",$lastName);
    $prepare-> bindParam(":email",$email);
    $prepare-> bindParam(":username",$username);
    $prepare-> bindParam(":password",$password);
    $prepare-> bindParam(":role_id",$role_id);
    $prepare-> bindParam(":valid_code", $vNumber);
    $prepare-> bindParam(":verifiedStatus", $verified_status);

    $result=$prepare->execute();

    return $result;
}

function checkStatus($username, $email){
    global $connection;

    $query="SELECT username, email FROM user";

    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();

    foreach($result as $row){
        if($row->username== $username || $row->email== $email){
            return false;
            break;
        }
    }

    return true;
}

function checkAccount($username){
    global $connection;

    $query="SELECT username FROM user";

    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();

    foreach($result as $row){
        if($row->username==$username){
            return true;
            break;
        }
    }

    return false;
}

function login($username, $password){
    global $connection;

    $password=md5($password);

    $query="SELECT username, role_id FROM user WHERE username= :username AND password=:password";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->bindParam(":password",$password);
    $prepare->execute();

    $result=$prepare->fetch();

    if($result){
        session_start();
        $_SESSION["username"]=$result->username;
        $_SESSION["role"]=$result->role_id;
        header('Location: '.'index.php');
        return true;
    }else{
        return false;
    }
}

function insertAddress($id_user, $address, $city, $zip){
    global $connection;

    $query="INSERT INTO user_info(address, city, postal_code, user_id) VALUES (:address, :city, :zip, :user_id) ";

    $prepare=$connection->prepare($query);
    $prepare->bindParam(":address",$address);
    $prepare->bindParam(":city",$city);
    $prepare->bindParam(":zip",$zip);
    $prepare->bindParam(":user_id",$id_user);

    $result=$prepare->execute();

    return $result;
}

function getGender(){
    global $connection;

    $query= "SELECT * FROM gender";

    $prepare= $connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();

    return $result;
}

function getCategory(){
    global $connection;

    $query="SELECT * FROM category";

    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();

    return $result;
}

function getBrand(){
    global $connection;

    $query="SELECT * FROM brand";

    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();

    return $result;
}

function getEmail($username){
    global $connection;

    $query="SELECT email FROM user WHERE username=:username";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->execute();

    $result=$prepare->fetch();

    return $result->email;
}

function getvNumber($username){
    global $connection;

    $query="SELECT validation_code FROM user WHERE username=:username";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->execute();

    $result=$prepare->fetch();

    return $result->validation_code;
}

function setVerified($username){
    global $connection;

    $query="UPDATE user SET verified=1 WHERE username=:username";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $result=$prepare->execute();

    return $result;
}

function insertMessage($name, $subject, $message, $email){
    global $connection;
    $answered=0;
    $query="INSERT INTO admin_message(name,subject,message,email_user,answered) VALUES(:name, :subject,:message,:email,:answered)";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":name",$name);
    $prepare->bindParam(":subject",$subject);
    $prepare->bindParam(":message",$message);
    $prepare->bindParam(":email",$email);
    $prepare->bindParam(":answered",$answered);
    $result=$prepare->execute();

    return $result;
}

function isVerified($username){
    global $connection;

    $query="SELECT verified FROM user WHERE username=:username AND verified>0";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->execute();

    $result=$prepare->fetch();

    if($result){
        return true;
    }else{
        return false;
    }
}

function fetchProductsIndex(){
    global $connection;

    $query="SELECT p.product_id, p.product_name, i.src,i.alt, c.category_name, p.oldPrice, p.newPrice FROM product p INNER JOIN pictures i ON p.product_id = i.product_id INNER JOIN category c ON p.category_id = c.category_id WHERE p.sale=1";

    $prepare=$connection->prepare($query);

    $prepare->execute();

    $result=$prepare->fetchAll();
    $count=0;
    $output="";

    for($i=0;$i<count($result);$i++){
        $count=$count+1;
        $output.="<div class='col-md-6 col-lg-4 col-xl-3'>
        <div class='card text-center card-product'>
          <div class='card-product__img'>
            <a href='single-product.php?id=".$result[$i]->product_id."'>
            <img class='card-img' src='".$result[$i]->src."' alt='".$result[$i]->alt."'>
            </a>
          </div>
          <div class='card-body'>
            <p>".$result[$i]->category_name."</p>
            <h4 class='card-product__title'><a href='single-product.php?id=".$result[$i]->product_id."'>".$result[$i]->product_name."</a></h4>";
            if($result[$i]->oldPrice!=null){
                $output.="<p class='card-product__price newPrice'>".$result[$i]->newPrice."$ - SALE</p>";
            }else{
                $output.="<p class='card-product__price'>".$result[$i]->newPrice."$</p>";
            }
            $output.="</div></div></div>";
            if($count==8){
                break;
            }
        }

        echo $output;
}

function fetchSliderProducts(){
    global $connection;

    $query="SELECT p.product_id, p.product_name, i.src, i.alt, c.category_name, p.sale, p.inStock, p.newPrice FROM product p INNER JOIN pictures i ON p.product_id= i.product_id INNER JOIN category c ON p.category_id=c.category_id WHERE p.inStock=1 AND p.sale=1";

    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";

    for($i=0;$i<count($result);$i++){
        $output.="<div class='card text-center card-product'>
        <div class='card-product__img'>
            <a href='single-product.php?id=".$result[$i]->product_id."'>
                <img class='img-fluid' src='".$result[$i]->src."' alt='".$result[$i]->alt."'/>
            </a>
        </div>
        <div class='card-body'>
          <p>".$result[$i]->category_name."</p>
          <h4 class='card-product__title'><a href='single-product.php?id=".$result[$i]->product_id."'>".$result[$i]->product_name."</a></h4>
          <p class='card-product__price'>".$result[$i]->newPrice."$</p>
        </div>
      </div>";
    }


    echo $output;
}

function fetchUserMenu(){
    global $connection;

    $query="SELECT * FROM menu_user";
    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<li class='nav-item' ><a class='nav-link' href='".$row->link."' >".$row->name."</a></li>";
    }

    echo $output;
}

function fetchAdminMenu(){
    global $connection;

    $query="SELECT * FROM menu_admin";
    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<li class='nav-item' ><a class='nav-link' href='".$row->link."' >".$row->name."</a></li>";
    }

    echo $output;
}

function fetchMenu(){
    global $connection;

    $query="SELECT * FROM menu_item";
    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<li class='nav-item' ><a class='nav-link' href='".$row->link."' >".$row->name."</a></li>";
    }

    echo $output;
}

function fetchMessages(){
    global $connection;

    $query="SELECT message_id, subject, message, answer, email_user, date, answered FROM admin_message ORDER BY message_id";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";
    if(count($result)>0){
        foreach($result as $row){
            $output.="<tr>
                        <td>
                        ".$row->message_id."
                        </td>
                        <td>
                        ".$row->subject."
                        </td>
                        <td>
                        ".$row->message."
                        </td>
                        <td>
                        ".$row->answer."
                        </td>
                        <td>
                        ".$row->email_user."
                        </td>
                        <td>
                        ".$row->date."
                        </td>";
                        if($row->answered){
                            $output.="<td>Answered</td>";
                        }else{
                            $output.="<td>Not answered</td>";
                        }
                    $output.="</tr>";
        }
    }else{
        $output="<tr><td colspan='7'>No messages to display.</td></tr>";
    }
    

    echo $output;
}

function fetchUsers(){
    global $connection;

    $query="SELECT u.user_id, u.first_name, u.last_name,u.email, u.username, r.role_name, u.verified, u.registration_date FROM user u INNER JOIN role r ON u.role_id=r.role_id ORDER BY user_id";
    $prepare=$connection->prepare($query);

    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<tr>
                    <td>
                    ".$row->user_id."
                    </td>
                    <td>
                    ".$row->first_name."
                    </td>
                    <td>
                    ".$row->last_name."
                    </td>
                    <td>
                    ".$row->email."
                    </td>
                    <td>
                    ".$row->username."
                    </td>
                    <td>
                    ".$row->role_name."
                    </td>";
                    if($row->verified){
                        $output.= "<td>Verfied</td>";
                    }else{
                        $output.= "<td>Not verified</td>";
                    }
                    $output.= "<td>
                    ".$row->registration_date."
                    </td>
                </tr>";
    }

    echo $output;
}

function insertUserAdmin($firstName,$lastName,$username,$email,$password, $role_id, $vNumber, $verified){
    global $connection;

    $query= "INSERT INTO user(first_name, last_name,email,username, password ,role_id, validation_code,verified) VALUES(:first_name, :last_name, :email, :username, :password, :role_id , :valid_code, :verifiedStatus)";
    $prepare= $connection->prepare($query);
    $prepare-> bindParam(":first_name",$firstName);
    $prepare-> bindParam(":last_name",$lastName);
    $prepare-> bindParam(":email",$email);
    $prepare-> bindParam(":username",$username);
    $prepare-> bindParam(":password",$password);
    $prepare-> bindParam(":role_id",$role_id);
    $prepare-> bindParam(":valid_code", $vNumber);
    $prepare-> bindParam(":verifiedStatus", $verified);

    $result=$prepare->execute();

    return $result;
}

function fetchUserCombo(){
    global $connection;

    $query="SELECT user_id, username FROM user ORDER BY user_id";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<option value='".$row->user_id."'>".$row->user_id." - ".$row->username."</option>";
    }

    echo $output;
}

function updateUser($user_id,$firstName,$lastName,$username,$email,$encryptedPassword, $role, $verified ){
    global $connection;

    $query="UPDATE user SET first_name = :first_name , last_name=:last_name, username=:username, email=:email, password=:password, role_id=:role, verified=:verified WHERE user_id=:user_id";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":first_name",$firstName);
    $prepare->bindParam(":last_name",$lastName);
    $prepare->bindParam(":username",$username);
    $prepare->bindParam(":email",$email);
    $prepare->bindParam(":password",$encryptedPassword);
    $prepare->bindParam(":role",$role);
    $prepare->bindParam(":verified",$verified);
    $prepare->bindParam(":user_id",$user_id);
    

    $result=$prepare->execute();

    return $result;
}

function fetchSurveyAdmin(){
    global $connection;

    $query="SELECT poll_id, poll_name,status, poll_date FROM poll";
    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";
    if($result){
        foreach($result as $row){
            $output.="<tr>
            <td>".$row->poll_id."</td>
            <td>".$row->poll_name."</td>
            <td>";
            if($row->status){
                $output.="Enabled";
            }else{
                $output.="Disabled";
            }
            $output.="</td>
            <td>".$row->poll_date."</td>
            <td><a href='view-stats.php?id=".$row->poll_id."'>View</a></td>
            </tr>";
        }
    }else{
        $output="<tr><td colspan='5'>No survey to display.</td></tr>";
    }
    
    

    return $output;
}

function fetchStats($id){
    global $connection;

    $query="SELECT * FROM poll_answers WHERE poll_id=:id";
    $prepare=$connection->prepare($query);

    $prepare->bindParam(":id",$id);
    $prepare->execute();
    $result=$prepare->fetchAll();

    if($result){
        $countYes=0;
        $countMaybe=0;
        $countNo=0;
        $totalAnswers=count($result);

        foreach($result as $row){
            if($row->answer==1){
                $countYes++;
            }else if($row->answer==2){
                $countMaybe++;
            }else if($row->answer==3){
                $countNo++;
            }
        }
        $percentageYes=$countYes/($totalAnswers/100);
        $percentageMaybe=$countMaybe/($totalAnswers/100);
        $percentageNo=$countNo/($totalAnswers/100);

        $output=["totalAnswers"=>$totalAnswers,"yes"=>round($percentageYes,2),"maybe"=>round($percentageMaybe,2),"no"=>round($percentageNo,2)];

        return $output;
    }
}

function getPrice($id){
    global $connection;

    $query="SELECT newPrice FROM product WHERE product_id=:id";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":id",$id);
    $prepare->execute();
    $result=$prepare->fetch();

    return $result->newPrice;
}

function fetchOrders(){
    global $connection;

    $query="SELECT r.receipt_id, u.username, r.address, r.city, r.zip, r.order_note, r.subtotal, r.shipping_fee, r.total, r.date FROM receipt r INNER JOIN user u ON r.user_id=u.user_id";
    $prepare=$connection->prepare($query);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";
    if($result){
        foreach($result as $row){
            $output.="<tr>
                <td>".$row->receipt_id."</td>
                <td>".$row->username."</td>
                <td>".$row->address."</td>
                <td>".$row->city."</td>
                <td>".$row->zip."</td>
                <td>".$row->order_note."</td>
                <td>".$row->subtotal."$</td>
                <td>".$row->shipping_fee."$</td>
                <td>".$row->total."$</td>
                <td>".$row->date."</td>
                <td><a href='view-order-stats.php?id=".$row->receipt_id."'>View</a></td>
            </tr>";
        }
    }else{
        $output="<tr><td colspan='11'>No order to display.</td></tr>";
    }
        

    return $output;
}

function fetchOrderDetails($id){
    global $connection;

    $query="SELECT r.receipItem_id, r.product_id,p.product_name, r.price,r.size,r.quantity FROM receipt_item r INNER JOIN product p ON r.product_id=p.product_id WHERE r.receipt_id=:id";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":id",$id);
    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";
    foreach($result as $row){
        $output.="<tr>
            <td>".$row->receipItem_id."</td>
            <td><a href='single-product.php?id=".$row->product_id."'>".$row->product_name."</a></td>
            <td>".$row->price."</td>
            <td>".$row->size."</td>
            <td>".$row->quantity."</td>
        </tr>";
    }

    return $output;
}


function fetchSurvey($id){
    global $connection;

    $query="SELECT poll_id,poll_name FROM poll WHERE status=1 AND poll_id NOT IN (SELECT poll_id FROM poll_answers WHERE user_id=:id);";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":id",$id);
    $prepare->execute();
    $result=$prepare->fetch();
    if($result){
        $_SESSION['poll_id']=$result->poll_id;
        $output="</br><h5>".$result->poll_name."</h5>
            <div class='d-flex flex-column justify-content-center mt-5'>
                <ul class='answer d-flex flex-column align-items-start'>
                    <li class='filter-list'><input class='pixel-radio pixel-checkbox answer' type='radio' id='answerYes' name='answers' value='1'/><label for='answerYes'><span style='font-size:18px'>Yes</span></label></li>
                    <li class='filter-list'><input class='pixel-radio pixel-checkbox answer' type='radio' id='answerMaybe' name='answers' value='2'/><label for='answerMaybe'><span style='font-size:18px'>Maybe</span></label></li>
                    <li class='filter-list'><input class='pixel-radio pixel-checkbox answer' type='radio' id='answerNo' name='answers' value='3'/><label for='answerNo'><span style='font-size:18px'>No</span></label></li>
                </ul>
                <button type='button' value='Submit' id='btnSubmitSurvey' class='btn btn-primary w-75 mt-5'>Submit</button>
                <div id='statusSurveyForm' class='d-flex align-items-start mt-2'>
                </div>
            </div>";
    }else{
        $output="<h5>No survey available</h5>";
    }
    

    echo $output;
}

function fetchId($username){
    global $connection;

    $query="SELECT user_id FROM user WHERE username=:username";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->execute();
    $result=$prepare->fetch();

    return $result->user_id;
}

function ExistInDb($username,$email){
    global $connection;

    $query="SELECT username, email FROM user WHERE username=:username AND email=:email";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":username",$username);
    $prepare->bindParam(":email",$email);
    $prepare->execute();
    $result=$prepare->fetch();

    if($result){
        return true;
    }else{
        return false;
    }
}

function fetchSurveys(){
    global $connection;

    $query="SELECT poll_id, poll_name FROM poll ORDER BY poll_id";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";
    foreach($result as $row){
        $output.="<option value=".$row->poll_id.">".$row->poll_id." - ".$row->poll_name."</option>";
    }

    echo $output;
}

function getOldPrice($id){
    global $connection;

    $query="SELECT newPrice FROM product WHERE product_id=:id";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":id",$id);
    $prepare->execute();
    $result=$prepare->fetch();

    return $result->newPrice;
}

function addSurvey($name, $status){
    global $connection;

    $query="INSERT INTO poll(poll_name, status) VALUES (:name,:status)";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":name",$name);
    $prepare->bindParam(":status",$status);
    $result=$prepare->execute();

    if($result){
        return true;
    }else{
        return false;
    }
}

function surveyExist($name){
    global $connection;

    $query="SELECT poll_name FROM poll WHERE poll_name=:poll";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":poll",$name);
    $prepare->execute();

    $result=$prepare->fetch();

    if($result){
        return true;
    }else{
        return false;
    }
}

function fetchSurveyList(){
    global $connection;

    $query="SELECT poll_id, poll_name FROM poll ORDER BY poll_id";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";

    foreach($result as $row){
        $output.="<option value=".$row->poll_id.">".$row->poll_id." - ".$row->poll_name."</option>";
    }

    echo $output;
}

function fetchCategoryCombo(){
    global $connection;

    $query="SELECT category_id, category_name FROM category";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";
    foreach($result as $row){
        $output.="<option value='".$row->category_id."'>".$row->category_id." - ".$row->category_name."";
    }

    return $output;
}

function fetchBrandCombo(){
    global $connection;

    $query="SELECT brand_id, brand_name FROM brand";
    $prepare=$connection->prepare($query);
    $prepare->execute();

    $result=$prepare->fetchAll();
    $output="";
    foreach($result as $row){
        $output.="<option value='".$row->brand_id."'>".$row->brand_id." - ".$row->brand_name."";
    }

    return $output;
}

function updateSurvey($id,$name,$q1, $q2, $q3, $status){
    global $connection;

    $query="UPDATE poll SET poll_name=:name,answer_one=:q1, answer_two=:q2, answer_three=:q3, status=:status WHERE poll_id=:id";
    $prepare=$connection->prepare($query);
    $prepare->bindParam(":name",$name);
    $prepare->bindParam(":q1",$q1);
    $prepare->bindParam(":q2",$q2);
    $prepare->bindParam(":q3",$q3);
    $prepare->bindParam(":status",$status);
    $prepare->bindParam(":id",$id);
    $result=$prepare->execute();

    if($result){
        return true;
    }else{
        return false;
    }
}

function fetchProductCombo(){
    global $connection;

    $query="SELECT product_id, product_name FROM product ORDER BY product_id";
    $prepare=$connection->prepare($query);

    $prepare->execute();
    $result=$prepare->fetchAll();
    $output="";
    foreach($result as $row){
        $output.="<option value='".$row->product_id."'>".$row->product_id." - ".$row->product_name."</option>";
    }

    return $output;
}

?>