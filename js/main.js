window.onload=function(){

    if((JSON.parse(localStorage.getItem("cart")))==null){
        document.getElementById("numberOfProducts").textContent=0;
    }else{
        document.getElementById("numberOfProducts").textContent=(JSON.parse(localStorage.getItem("cart"))).length;
    }

  

    var dugme = document.getElementById("scrollUp");

    window.onscroll = function () {
    SkrolGore();
    };

function SkrolGore() {
    if(
        document.body.scrollTop > 350 ||
        document.documentElement.scrollTop > 350
    ){
        dugme.style.display = "block";
    } else {
        dugme.style.display = "none";
    }
}

 
    var path=document.location.pathname;
    var broj=path.lastIndexOf("/");
    path=path.substring(broj);
    
    if(path=="/index.php" || path=="/"){
       
        slajder();
        carouselOwl();
        
        
    }

    function carouselOwl(){
        $(".hero-carousel").owlCarousel({
            items:3,
            margin: 10,
            autoplay:false,
            autoplayTimeout: 5000,
            loop:true,
            nav:false,
            dots:false,
            responsive:{
              0:{
                items:1
              },
              600:{
                items: 2
              },
              810:{
                items:3
              }
            }
          });
    }

    function slajder(){
        if($('.owl-carousel').length > 0){
            $('#bestSellerCarousel').owlCarousel({
              loop:true,
              margin:30,
              nav:true,
              navText: ["<i class='ti-arrow-left'></i>","<i class='ti-arrow-right'></i>"],
              dots: false,
              responsive:{
                0:{
                  items:1
                },
                600:{
                  items: 2
                },
                900:{
                  items:3
                },
                1130:{
                  items:4
                }
              }
            })
          }
    }
    if(path=="/addUser.php" || path=="/updateUser.php" || path=="/adminpnl.php" || path=="/addSurvey.php" || path=="/updateSurvey.php" || path=="/addProduct.php" || path=='/updateProduct.php'){
        $("select").niceSelect();
    }
    if(path=="/shop.php"){
        //dohvatanjePodataka("data/proizvodi.json",prikazProizvoda);
        //dohvatanjePodataka("data/categories.json",prikazKategorija);
        filterProducts();
        $("select").niceSelect();
        prikazPopularnihProizvoda();

        $("#gender, #kategorije, #brendovi, #dostupnost, #sortiranje").change(()=>{
            let newUrl= getNewUrl();
    
            window.history.pushState("object or string", "Title", "/" + newUrl );
            if(localStorage.getItem("filters")){
                $("#clearFilters").removeClass("hidden");
            }
            catchFilters();
            filterProducts();
            
        });

        $("#searchText").on("keyup",()=>{
            let newUrl= getNewUrl();
    
            window.history.pushState("object or string", "Title", "/" + newUrl );
            if(JSON.parse(localStorage.getItem("filters"))){
                $("#clearFilters").removeClass("hidden");
            }
            catchFilters();
            filterProducts();
        });

        $("#clearFilters").click(()=>{
            let filteri=JSON.parse(localStorage.getItem("filters"));
            if(filteri){
                let pol=filteri["pol"];
                let kategorije=filteri["kategorije"];
                let brendovi=filteri["brend"];
                let dostupnost=filteri["dostupnost"];
                let sortiranjeNacin=filteri["nacinSortiranja"];
    
                if(pol){
                    for(let i=0;i<pol.length;i++){
                        for(let j=0;j<$(".pol").length;j++){
                            if(($(".pol")[j]).value=="pol"+pol[i]){
                                ($(".pol")[j]).checked=false;
                                break;
                            }
                        }
                    }
                }
        
                if(kategorije){
                    for(let i=0;i<kategorije.length;i++){
                        for(let j=0;j<$(".category").length;j++){
                            if($(".category")[j].value=="category"+kategorije[i]){
                                ($(".category")[j]).checked=false;
                                break;
                            }
                        }
                    }
                }
    
                if(brendovi){
                    for(let i=0;i<brendovi.length;i++){
                        for(let j=0;j<$(".brand").length;j++){
                            if($(".brand")[j].value=="brand"+brendovi[i]){
                                ($(".brand")[j]).checked=false;
                                break;
                            }
                        }
                    }
                }
    
                    let search=document.getElementById("searchText");
                    search.value="";
    
                if(dostupnost){
                    for(let i=0;i<dostupnost.length;i++){
                        for(let j=0;j<$(".stanje").length;j++){
                            if($(".stanje")[j].value==dostupnost[i]){
                                $(".stanje")[j].checked=false;
                                break;
                            }
                        }
                    }
                    
                }
                
                document.querySelector('option[value="0"]').selected = true;
                
            }
            catchFilters();
            filterProducts();
            $('select').niceSelect('update');
            $("#clearFilters").addClass("hidden");
        });
        
    }

    if(path=="/single-product.php"){
        var params=new URLSearchParams(window.location.search);
        var proizvodID=params.get("id");
        prikazProizvoda(proizvodID);
        prikazPopularnihProizvoda();
        //dohvatanjePodataka("data/proizvodi.json",prikazPojedinacnogProizvoda);
        //dohvatanjePodataka("data/proizvodi.json",ispisPopularniProizvodi);
    }

    if(path=="/cart.php"){
        prikazKorpa();
        //dohvatanjePodataka("data/proizvodi.json",ispisKorpa);
    }

    if(path=="/checkout.php"){
        //dohvatanjePodataka("data/proizvodi.json",ispisProizvodaCheckout);
        ispisCheckout();
        ispisRacunaCheckout();
        let korpa=JSON.parse(localStorage.getItem("cart"));
        if(!korpa){
            $("#submitBtn").text('Nothing in cart');
            $("#submitBtn").addClass("disabled-a");
            $("#submitBtn").css("background-color","#ed242e");
        }
    }

/*     if(path=="/login.php"){
        proveraFormeLogin();
    } */

    

$("#form-submit").click(function(){
    proveraFormeContact()
});

function proveraFormeContact(){
    proveriIme();
    proveriEmail();
    let subject=document.getElementById("subject").value;
    let txt=document.getElementById("message").value;

    if(subject !="" && txt != "" && proveriIme() && proveriEmail()){
        document.getElementById("upozorenjeTema").classList.add("hidden");
        document.getElementById("upozorenjeText").classList.add("hidden");
        let paket={
            email:$("#email").val(),
            subject:$("#subject").val(),
            name:$("#name").val(),
            message:$("#message").val()
        }
        slanjePodataka('models/sendMessage.php',paket,'statusContact');
    }
    if (txt == "") {
        document.getElementById("upozorenjeText").style.color="Red";
        document.getElementById("upozorenjeText").classList.remove("hidden");
    }else if (txt != "") {
        document.getElementById("upozorenjeText").classList.add("hidden");
    }
    if (subject == "") {
        document.getElementById("upozorenjeTema").style.color="Red";
        document.getElementById("upozorenjeTema").classList.remove("hidden");
    }else if (subject != "") {
        document.getElementById("upozorenjeTema").classList.add("hidden");
    }
}

$("#submitBtn").click(function(){
    proveraFormeCheckout();
});


function proveraFormeCheckout(){
        /* proveriIme();
        proveriEmail();
        proveriTelefon(); */
        proveriAdresu();
        proveriGrad();
        proveraZipKoda();
        proveraCheckBox();
       
          let subtotal=$("#subtotal").text();
          let total=$("#total").text();
          let pos$=subtotal.lastIndexOf("$");
          let pos$1=total.lastIndexOf("$");
          subtotal=subtotal.substring(0,pos$);
          total=total.substring(0,pos$1);
          let korpa=JSON.parse(localStorage.getItem('cart'));
          if(korpa && proveriAdresu() && proveriGrad() && proveraZipKoda() && proveraCheckBox()){
                let paket={
                    address:$("#address").val(),
                    city:$("#city").val(),
                    zip:$("#zip").val(),
                    subtotal:subtotal,
                    total:total,
                    products:korpa,
                    note:$("#message").val()
                }

                slanjePodataka('models/addReceipt.php',paket,'statusOrder');
               
          }

}

function proveriIme() {
        let uzorakIme= /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})?(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,20})\s*$/;
        let ime = document.getElementById("name").value;
        ime.replace(/\s\s+/g, " ");
        if (!uzorakIme.test(ime)) {
        let poljeIme = document.getElementById("upozorenjeIme");
        if (ime == "" || !ime.trim()) {
            poljeIme.innerHTML = "Enter your name and last name!";
        } else {
            poljeIme.innerHTML = "Invalid name format!";
        }
        poljeIme.style.color="red";
        poljeIme.classList.remove("hidden");
        return false;
        }
        if (uzorakIme.test(ime)) {
        let poljeIme = document.getElementById("upozorenjeIme");
        poljeIme.classList.add("hidden");
        return true;
        }
  }

  function proveriEmail() {
        let uzorakEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        let email = document.getElementById("email").value;
        if (!uzorakEmail.test(email)) {
        let poljeEmail = document.getElementById("upozorenjeEmail");
        if (email == "" || !email.trim())
            poljeEmail.innerHTML = "Enter email!";
        else poljeEmail.innerHTML = "Invalid email format!";
        poljeEmail.style.color="red";
        poljeEmail.classList.remove("hidden");
        return false;
        }
        if (uzorakEmail.test(email)) {
        let poljeEmail = document.getElementById("upozorenjeEmail");
        poljeEmail.classList.add("hidden");
        return true;
        }
  }

  function proveriTelefon() {
        let uzorakTelefon = /^\+(?:[0-9] ?){6,14}[0-9]$/;
        let telefon = document.getElementById("number").value;
        if (!uzorakTelefon.test(telefon)) {
        let poljeTelefon = document.getElementById("upozorenjeTelefon");
        if (telefon == "" || !telefon.trim())
            poljeTelefon.innerHTML = "Enter phone number";
        else poljeTelefon.innerHTML = "Invalid phone number format!";
        poljeTelefon.style.color="red";
        poljeTelefon.classList.remove("hidden");
        return false;
        }
        if (uzorakTelefon.test(telefon)) {
        let poljeTelefon = document.getElementById("upozorenjeTelefon");
        poljeTelefon.classList.add("hidden");
        return true;
        }
  }

  function proveriAdresu(){
        let uzorakAdrese= /^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽa-zčćšđž0-9]{1,15})+$/;
        let adresa=document.getElementById("address").value;
        if (!uzorakAdrese.test(adresa)) {
            let poljeAdresa = document.getElementById("upozorenjeAdresa");
            if (adresa == "" || !adresa.trim())
            poljeAdresa.innerHTML = "Enter your address";
            else poljeAdresa.innerHTML = "Invalid address format!";
            poljeAdresa.style.color="red";
            poljeAdresa.classList.remove("hidden");
            return false;
        }
        if (uzorakAdrese.test(adresa)) {
            let poljeAdresa = document.getElementById("upozorenjeAdresa");
            poljeAdresa.classList.add("hidden");
            return true;
        }
  }

  function proveriGrad(){
        let uzorakGrad=/^[a-zA-Z\u0080-\u024F]+(?:[\s-][a-zA-Z\u0080-\u024F]+)*$/
        let grad=document.getElementById("city").value;
        if (!uzorakGrad.test(grad)) {
            let poljeGrad = document.getElementById("upozorenjeGrad");
            if (grad == "" || !grad.trim())
            poljeGrad.innerHTML = "Enter city name";
            else poljeGrad.innerHTML = "Invalid city name!";
            poljeGrad.style.color="red";
            poljeGrad.classList.remove("hidden");
            return false;
        }
        if (uzorakGrad.test(grad)) {
            let poljeGrad = document.getElementById("upozorenjeGrad");
            poljeGrad.classList.add("hidden");
            return true;
        }
  }

  function proveraZipKoda(){
        let uzorakZipKoda=/^\d{5}$/;
        let postanskiBroj=$("#zip").val();
        if (!uzorakZipKoda.test(postanskiBroj)) {
            let poljeZip = document.getElementById("upozorenjePostanskiBroj");
            if (postanskiBroj == "" || !postanskiBroj.trim())
            poljeZip.innerHTML = "Enter postcode/ZIP!";
            else poljeZip.innerHTML = "Invalid postcode/ZIP!";
            poljeZip.style.color="red";
            poljeZip.classList.remove("hidden");
            return false;
        }
        if (uzorakZipKoda.test(postanskiBroj)) {
            let poljeZip = document.getElementById("upozorenjePostanskiBroj");
            poljeZip.classList.add("hidden");
            return true;
        }
  }

  function proveraCheckBox(){
      let dugme=document.getElementById("f-option4");
      if(dugme.checked==false){
          document.getElementById("linkCheckbox").style.color="red";
          return false;
      }else{
        document.getElementById("linkCheckbox").style.color="green";
        return true;
      }
  }

  

    function ispisCheckout(){
        let korpa=JSON.parse(localStorage.getItem("cart"));
        
        let paket={
            korpa: korpa
        }
        fetchData("models/fetchCheckout.php",paket,"listaProizvodaCheckout")
    }

    function ispisRacunaCheckout(){
        let korpa=JSON.parse(localStorage.getItem("cart"));

        let paket={
            korpa:korpa
        }

        fetchData("models/fetchReceiptPrice.php",paket,"cenaCheckout");
    }

    function prikazPopularnihProizvoda(){
        let paket={};
        fetchData("models/sliders/fetchPopularProducts.php",paket,"popularniProizvodi");
    }

    function proveraFormeLogin(){
            proveriUsername();
            proveriPassword();
            if(proveriUsername() /* && proveriPassword() */){
                let paket={
                    username: $("#username").val(),
                    password: $("#password").val()
                }

                slanjePodataka("models/login.php",paket,"status",'index.php');
            }
    }

    function proveriUsername(){
        let uzorakUsername=/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zčćšđžA-ZČĆŠĐŽ0-9._]+$/;
        let username=$("#username").val();
        if (!uzorakUsername.test(username)) {
            let poljeUsername = document.getElementById("upozorenjeUsername");
            if (username == "" || !username.trim())
            poljeUsername.innerHTML = "Enter username";
            else poljeUsername.innerHTML = "Invalid username format!";
            poljeUsername.style.color="red";
            poljeUsername.classList.remove("hidden");
            return false;
        }
        if (uzorakUsername.test(username)){
            let poljeUsername = document.getElementById("upozorenjeUsername");
            poljeUsername.classList.add("hidden");
            return true;
        }
    }
    //let uzorakPassword=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    let uzorakPassword=/^(?=.*[a-z])(?=.*[A-Z]).{8,32}$/;

    function proveriPassword(){
        let password=$("#password").val();
        if (!uzorakPassword.test(password)) {
            let poljePassword = document.getElementById("upozorenjePassword");
            if (password == "" || !password.trim())
            poljePassword.innerHTML = "Enter password";
            else poljePassword.innerHTML = "Min 8 characters, at least 1 upper case and 1 number!";
            poljePassword.style.color="red";
            poljePassword.classList.remove("hidden");
            return false;
        }
        if (uzorakPassword.test(password)){
            let poljePassword = document.getElementById("upozorenjePassword");
            poljePassword.classList.add("hidden");
            return true;
        }
    }

    function proveriPassword2(){
        let password=$("#confirmPassword").val();
        if (!uzorakPassword.test(password)) {
            let poljePassword = document.getElementById("upozorenjePassword2");
            if (password == "" || !password.trim())
            poljePassword.innerHTML = "Re-enter password";
            else poljePassword.innerHTML = "Min 8 characters, at least 1 upper case and 1 number!";
            poljePassword.style.color="red";
            poljePassword.classList.remove("hidden");
            return false;
        }
        if (uzorakPassword.test(password)){
            let poljePassword = document.getElementById("upozorenjePassword2");
            poljePassword.classList.add("hidden");
            return true;
        }
    }

    function uporediPassword(){
        let password2=$("#confirmPassword").val();
        let password=$("#password").val();

        if(password!=password2){
            alert("Passwords doesn't match!");
            return false;
        }else{
            return true;
        }
    }
    let uzorakName=/^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,12}$/;

    function proveriFirstName(){
        let firstName=$("#firstName").val();
        if (!uzorakName.test(firstName)) {
            let poljeIme = document.getElementById("upozorenjeFirst");
            if (firstName == "" || !firstName.trim()) {
                poljeIme.innerHTML = "Enter your first name!";
            } else {
                poljeIme.innerHTML = "Invalid name format!";
            }
            poljeIme.style.color="red";
            poljeIme.classList.remove("hidden");
            return false;
            }
            if (uzorakName.test(firstName)) {
            let poljeIme = document.getElementById("upozorenjeFirst");
            poljeIme.classList.add("hidden");
            return true;
            }
    }

    function proveriLastName(){
        let lastName=$("#lastName").val();
        if (!uzorakName.test(lastName)) {
            let poljePrezime = document.getElementById("upozorenjeLast");
            if (lastName == "" || !lastName.trim()) {
                poljePrezime.innerHTML = "Enter your first name!";
            } else {
                poljePrezime.innerHTML = "Invalid name format!";
            }
            poljePrezime.style.color="red";
            poljePrezime.classList.remove("hidden");
            return false;
            }
            if (uzorakName.test(lastName)) {
            let poljePrezime = document.getElementById("upozorenjeLast");
            poljePrezime.classList.add("hidden");
            return true;
            }
    }

    function slanjePodataka(url, data,polje,link){
        $.ajax({
            url: url,
            method: "POST",
            datatype: "JSON",
            data : data,
            success: function(result){
                $("#"+polje+"").html(result.answer);
                if(result.answer.substring(0,3)=="<h6"){
                    const timer=setTimeout(function(){
                        localStorage.removeItem('cart');
                        window.location.href='index.php';
                    },1000);
                }else if(result.answer.substring(0,3)=="<sp"){
                    const timer=setTimeout(function(){
                        window.location.href='adminpnl.php';
                    },1000);
                }else if(result.answer.substring(0,3)=="<h4"){
                    const timer=setTimeout(function(){
                        window.location.href='verification.php';
                    },1000);
                }
                if(url=='models/sendMessage.php'){
                    const timer=setTimeout(function(){
                        window.location.href='contact.php'
                    },2000);
                }
            },
            error: function(xhr){
                console.log(xhr);
            }
        })
    }

    $("#btnRemoveUser").click(function(){
        removeUser();
    });

    $("#btnRemoveSurvay").click(function(){
        removeSurvey();
    });

    $("#btnAddSurvey").click(function(){
        dodajSurvey();
    });

    $("#btnUpdateSurvey").click(function(){
        izmeniSurvey();
    });

    $("#btnAddProduct").click(function(){
        dodajProizvod();
    });

    $("#btnRemoveProduct").click(function(){
        removeProduct();
    });

    $("#btnVerifyUser").click(function(){
        verifyUser();
    });


    $("#btnSubmitSurvey").click(function(){
        let polje=$(".answer");
        let answer;
        for(let i=0;i<polje.length;i++){
            if(polje[i].checked==true){
                answer=polje[i].value;
                break;
            }
        }
        if(answer){
            let paket={
                answer:answer
            }
            slanjePodataka('models/insertAnswer.php',paket,'statusSurveyForm');
        }else{
            let html=`<p style='color:red'>Select answer</p>`;
            $("#statusSurveyForm").html(html);
        }
    });
    
    $("#btnUpdateProduct").click(function(){
        izmeniProizvod();
    });

    function izmeniProizvod(){
        let id=$("#product").val();
        if(id>0){
                proveriNazivProizvoda();
                proveriCenu();
                proveriMaterijal();
                proveriZemlju();

                let slika=$("#productImage").val();

                if(slika.trim()==""){
                        $("#upozorenjeImage").removeClass("hidden");
                        $("#upozorenjeImage").css("color","red");
                }else{
                    $("#upozorenjeImage").addClass("hidden");
                }
                let kategorija=$("#category").val();
                if(kategorija==0){
                    $("#upozorenjeCategory").removeClass("hidden");
                    $("#upozorenjeCategory").css("color","red");
                }else{
                    $("#upozorenjeCategory").addClass("hidden");
                }
            
                let brend=$("#brand").val();
            
                if(brend==0){
                    $("#upozorenjeBrand").removeClass("hidden");
                    $("#upozorenjeBrand").css("color","red");
                }else{
                    $("#upozorenjeBrand").addClass("hidden");
                }
            
                let pol=$("#gender").val();
            
                if(pol==0){
                    $("#upozorenjeGender").removeClass("hidden");
                    $("#upozorenjeGender").css("color","red");
                }else{
                    $("#upozorenjeGender").addClass("hidden");
                }
            
                let odabraneVelicine=[];
                let statusProvere;
                let status=$("#inStock").val();
                if(status==1){
                    for(let i=0;i<$(".size").length;i++){
                        if($(".size")[i].checked==true){
                            odabraneVelicine.push($(".size")[i].value);
                        }
                    }
                }
                if(status!=0){
                    if(odabraneVelicine.length==0){
                        $("#upozorenjeSize").removeClass("hidden");
                        $("#upozorenjeSize").css("color","red");
                        statusProvere=false;
                    }else{
                        $("#upozorenjeSize").addClass("hidden");
                        statusProvere=true;
                    }
                }else{
                        statusProvere=true;
                }
                if(statusProvere && proveriNazivProizvoda() && brend!=0 && pol!=0 && kategorija!=0 && slika.trim()!="" && proveriCenu() && proveriMaterijal() && proveriZemlju()){
                    let paketProduct={
                        id:id,
                        naziv: $("#productName").val(),
                        brend: brend,
                        kategorija:kategorija,
                        pol:pol,
                        cena: $("#newPrice").val(),
                        materijal : $("#material").val(),
                        coo: $("#coo").val(),
                        sizes: odabraneVelicine.join(),
                        inStock: $("#inStock").val(),
                        sale : $("#sale").val(),
                    }
                
                    let ft=new FormData();
                    ft.append("slika",document.getElementById('productImage').files[0]);
                    ft.append('product_id',id);
                
                    fetchDataMethod('models/adminpnl/updateProduct.php',paketProduct,function(result){
                        $("#statusProduct").html(result.answer);
                        $.ajax({
                            url: "models/adminpnl/updateImage.php",
                            method: "POST",
                            datatype: "JSON",
                            data: ft,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                              console.log("Image added successfull");
                              console.log(data);
                            },
                            error: function (err) {
                              /* console.log("Error");
                              console.log(err); */
                            }
                          });
                        if(result.answer.substring(0,3)=="<h6"){
                            const timer=setTimeout(function(){
                                window.location.href='index.php';
                            },1000);
                        }else if(result.answer.substring(0,3)=="<sp"){
                            const timer=setTimeout(function(){
                                window.location.href='adminpnl.php';
                            },1000);
                        }
                    });
                }
        }else{
            let html=`<h6 style='color:red'>Select product</h6>`;
            $("#statusProduct").html(html);
        }
        
    }

    function verifyUser(){
        let vNumber=$("#validationCode").val();
        let uzorakVcode=/^[0-9]{5}$/;
        if(vNumber.trim()!=""){
            if(uzorakVcode.test(vNumber)){
                let paket={
                    code:vNumber
                }
                $("#upozorenjeVcode").addClass("hidden");
                slanjePodataka('models/verification.php',paket,'statusVerify');
            }else{
                $("#upozorenjeVcode").removeClass("hidden");
                $("#upozorenjeVcode").css("color","red");
                $("#upozorenjeVcode").text("Invalid validation code");
            }
        }else{
            $("#upozorenjeVcode").removeClass("hidden");
            $("#upozorenjeVcode").css("color","red");
            $("#upozorenjeVcode").text("Enter validation code");
        }
    }

    function removeProduct(){
        let id=$("#productRemove").val();
        if(id>0){
            let paket={
                id:id
            }

            slanjePodataka("models/adminpnl/removeProduct.php",paket,'statusProduct');
        }
    }

    function dodajProizvod(){
        proveriNazivProizvoda();
        proveriCenu();
        proveriMaterijal();
        proveriZemlju();

        let slika=$("#productImage").val();

        if(slika.trim()==""){
                $("#upozorenjeImage").removeClass("hidden");
                $("#upozorenjeImage").css("color","red");
        }else{
            $("#upozorenjeImage").addClass("hidden");
        }
        let kategorija=$("#category").val();
        if(kategorija==0){
            $("#upozorenjeCategory").removeClass("hidden");
            $("#upozorenjeCategory").css("color","red");
        }else{
            $("#upozorenjeCategory").addClass("hidden");
        }

        let brend=$("#brand").val();

        if(brend==0){
            $("#upozorenjeBrand").removeClass("hidden");
            $("#upozorenjeBrand").css("color","red");
        }else{
            $("#upozorenjeBrand").addClass("hidden");
        }

        let pol=$("#gender").val();

        if(pol==0){
            $("#upozorenjeGender").removeClass("hidden");
            $("#upozorenjeGender").css("color","red");
        }else{
            $("#upozorenjeGender").addClass("hidden");
        }

        let odabraneVelicine=[];
        let statusProvere;
        let status=$("#inStock").val();
        for(let i=0;i<$(".size").length;i++){
            if($(".size")[i].checked==true){
                odabraneVelicine.push($(".size")[i].value);
            }
        }
        if(status!=0){
            if(odabraneVelicine.length==0){
                $("#upozorenjeSize").removeClass("hidden");
                $("#upozorenjeSize").css("color","red");
                statusProvere=false;
            }else{
                $("#upozorenjeSize").addClass("hidden");
                statusProvere=true;
            }
        }else{
                statusProvere=true;
        }
        if(statusProvere && proveriNazivProizvoda() && brend!=0 && pol!=0 && kategorija!=0 && slika.trim()!="" && proveriCenu() && proveriMaterijal() && proveriZemlju()){
            let paketProduct={
                naziv: $("#productName").val(),
                brend: brend,
                kategorija:kategorija,
                pol:pol,
                cena: $("#newPrice").val(),
                materijal : $("#material").val(),
                coo: $("#coo").val(),
                sizes: odabraneVelicine.join(),
                inStock: $("#inStock").val(),
                sale : $("#sale").val(),
            }

            let ft=new FormData();
            ft.append("slika",document.getElementById('productImage').files[0]);

            fetchDataMethod('models/adminpnl/addProduct.php',paketProduct,function(result){
                $("#statusProduct").html(result.answer);
                $.ajax({
                    url: "models/adminpnl/addImage.php",
                    method: "POST",
                    datatype: "json",
                    data: ft,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                      console.log("Image added successfull");
                      console.log(data);
                    },
                    error: function (err) {
                      /* console.log("Error");
                      console.log(err); */
                    }
                  });
                if(result.answer.substring(0,3)=="<h6"){
                    const timer=setTimeout(function(){
                        window.location.href='index.php';
                    },1000);
                }else if(result.answer.substring(0,3)=="<sp"){
                    const timer=setTimeout(function(){
                        window.location.href='adminpnl.php';
                    },1000);
                }
            });
        }
        
    }

    function proveriCenu(){
        let polje=$("#newPrice").val();
        let uzorak=/^[1-9][0-9]*(\.[0-9]{2})?$/;
        if(polje.trim()!=""){
            if(uzorak.test(polje)){
                $("#upozorenjePrice").addClass("hidden");
                return true;
            }else{
                $("#upozorenjePrice").removeClass("hidden");
                $("#upozorenjePrice").text("Invalid price!");
                $("#upozorenjePrice").css("color","red");
                return false;
            }
        }else{
                $("#upozorenjePrice").removeClass("hidden");
                $("#upozorenjePrice").text("Enter price!");
                $("#upozorenjePrice").css("color","red");
                return false;
        }
    }

    function proveriMaterijal(){
        let polje=$("#material").val();
        let uzorak=/^[A-ZČĆŠĐŽa-zčćšđž\s]{5,30}$/;
        if(polje.trim()!=""){
            if(uzorak.test(polje)){
                $("#upozorenjeMaterijal").addClass("hidden");
                return true;
            }else{
                $("#upozorenjeMaterijal").removeClass("hidden");
                $("#upozorenjeMaterijal").text("Invalid material name");
                $("#upozorenjeMaterijal").css("color","red");
                return false;
            }
        }else{
            $("#upozorenjeMaterijal").removeClass("hidden");
            $("#upozorenjeMaterijal").css("color","red");
            $("#upozorenjeMaterijal").text("Enter material!");
                return false;
        }
    }

    function proveriZemlju(){
        let polje=$("#coo").val();
        let uzorak=/^[A-ZČĆŠĐŽa-zčćšđž\s]{5,30}$/;
        if(polje.trim()!=""){
            if(uzorak.test(polje)){
                $("#upozorenjeCoo").addClass("hidden");
                return true;
            }else{
                $("#upozorenjeCoo").removeClass("hidden");
                $("#upozorenjeCoo").text("Invalid country of origin");
                $("#upozorenjeCoo").css("color","red");
                return false;
            }
        }else{
            $("#upozorenjeCoo").removeClass("hidden");
            $("#upozorenjeCoo").css("color","red");
            $("#upozorenjeCoo").text("Enter country of origin!");
                return false;
        }
    }

    function proveriNazivProizvoda(){
        let polje=$("#productName").val();
        let uzorak=/^[A-ZČĆŠĐŽa-zčćšđž\s]{5,30}$/;
        if(polje.trim()!=""){
            if(uzorak.test(polje)){
                $("#upozorenjeProductName").addClass("hidden");
                return true;
            }else{
                $("#upozorenjeProductName").removeClass("hidden");
                $("#upozorenjeProductName").text("Invalid product name");
                $("#upozorenjeProductName").css("color","red");
                return false;
            }
        }else{
            $("#upozorenjeProductName").removeClass("hidden");
            $("#upozorenjeProductName").css("color","red");
            $("#upozorenjeProductName").text("Enter product name!");
                return false;
        }
    }

    function izmeniSurvey(){
        let id=$("#surveyList").val();
        let naziv=$("#surveyName").val();
        let q1=$("#q1").val();
        let q2=$("#q2").val();
        let q3=$("#q3").val();
        let status=$("#statusSurvey").val();
        if(naziv.trim()==""){
            $("#upozorenjeSurveyName").removeClass("hidden");
            $("#upozorenjeSurveyName").css("color","red");
        }else{
            $("#upozorenjeSurveyName").addClass("hidden");
        }
        if(q1.trim()==""){
            $("#upozorenjeQ1").removeClass("hidden");
            $("#upozorenjeQ1").css("color","red");
        }else{
            $("#upozorenjeQ1").addClass("hidden");
        }
        if(q2.trim()==""){
            $("#upozorenjeQ2").removeClass("hidden");
            $("#upozorenjeQ2").css("color","red");
        }else{
            $("#upozorenjeQ2").addClass("hidden");
        }
        if(q3.trim()==""){
            $("#upozorenjeQ3").removeClass("hidden");
            $("#upozorenjeQ3").css("color","red");
        }else{
            $("#upozorenjeQ3").addClass("hidden");
        }
        if(naziv.trim()!="" && q1.trim()!="" && q2.trim()!="" && q3.trim()!=""){
            let paket={
                id:id,
                name: naziv,
                q1: q1,
                q2: q2,
                q3: q3,
                status: status
            }
            slanjePodataka("models/adminpnl/updateSurvey.php",paket,'statusSurveyText');
        }
    }

    function dodajSurvey(){
        let naziv=$("#surveyName").val();
        let status=$("#statusSurvey").val();
        if(naziv.trim()==""){
            $("#upozorenjeSurveyName").removeClass("hidden");
            $("#upozorenjeSurveyName").css("color","red");
        }else{
            $("#upozorenjeSurveyName").addClass("hidden");
        }

        if(naziv.trim()!=""){
            let paket={
                name: naziv,
                status: status
            }
            slanjePodataka("models/adminpnl/addSurvey.php",paket,'statusSurveyText');
        }


    }


    function removeSurvey(){
        let id=$("#survey").val();
        if(id>0){
            let paket={
                id:id
            }
            slanjePodataka("models/adminpnl/removeSurvey.php",paket,'statusSurvey');
        }
        
    }
    
    function removeUser(){
        let id=$("#userRemove").val();
        if(id>0){
            let paket={
                id:id
            }
            slanjePodataka("models/adminpnl/removeUser.php",paket,'statusUser');
        }
    }


    function fetchData(url, data,polje){
        $.ajax({
            url: url,
            method: "POST",
            datatype: "JSON",
            data : data,
            success: function(result){
                $("#"+polje+"").html(result.answer);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    }

/*     function prikazOpis(url, data){
        $.ajax({
            url: url,
            method: "POST",
            datatype: "JSON",
            data : data,
            success: function(result){
                $("#tabelaSpecs").html(result.answer);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    } */


    $("#btnRegister").click(function(){
        proveraFormeRegister();
    });

    $("#btnLogIn").click(function(){
        proveraFormeLogin();
    });
    
    $("#btnAddUser").click(function(){
        dodajKorisnika();
    });

    $("#users").change(function(){
        let polje=$("#users").val();
        if(polje>0){
            fetchCells(polje);
        }else{
            $("#firstName").val("");
            $("#lastName").val("");
            $("#username").val("");
            $("#email").val("");
            let polje=document.getElementById("role");
            polje.options[0].selected=true;
            $('select').niceSelect('update');
        }
        
    });

    $("#product").change(function(){
        let polje=$("#product").val();
        if(polje>0){
            fetchCellsProduct(polje);
        }else{
            emptyCellsProduct();
        }
    });

    $("#btnUpdateUser").click(function(){
        izmeniKorisnika();
    });

    $("#surveyList").change(function(){
        let polje=$("#surveyList").val();
        if(polje>0){
            fetchCellsPoll(polje);
        }else{
            $("#surveyName").val("");
            let polje=document.getElementById("statusSurvey");
            polje.options[0].selected=true;
            $('select').niceSelect('update');
        }
        
    });

    function fetchCellsProduct(polje){
        let data={
            id:polje
        }
        $.ajax({
            url:"models/fetchProductCells.php",
            method:"POST",
            datatype:"JSON",
            data:data,
            success:function(result){
                fillCellsProduct(result);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    }

    function emptyCellsProduct(){
        $("#productName").val("");
        $("#newPrice").val("");
        let kategorije=document.getElementById('category');
        kategorije.options[0].selected=true;
        let brand=document.getElementById('brand');
        brand.options[0].selected=true;
        let pol=document.getElementById('gender');
        pol.options[0].selected=true;
        let sale=document.getElementById('sale');
        sale.options[0].selected=true;
        let stock=document.getElementById('inStock');
        stock.options[0].selected=true;
        $("#material").val("");
        $("#coo").val("");
        for(let i=0;i<$(".size").length;i++){
            if($(".size")[i].checked==true){
                $(".size")[i].checked=false;
            }
        }
        $('select').niceSelect('update');
    }

    function fillCellsProduct(niz){
        $("#productName").val(niz['product_name']);
        let kategorije=document.getElementById('category');
        for(let i=0;i<kategorije.options.length;i++){
            if(kategorije.options[i].value==niz['category']){
                kategorije.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }
        let brand=document.getElementById('brand');
        for(let i=0;i<brand.options.length;i++){
            if(brand.options[i].value==niz['brand']){
                brand.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }

        let pol=document.getElementById('gender');
        for(let i=0;i<pol.options.length;i++){
            if(pol.options[i].value==niz['gender']){
                pol.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }

        let sale=document.getElementById('sale');
        for(let i=0;i<sale.options.length;i++){
            if(sale.options[i].value==niz['sale']){
                sale.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }

        $("#newPrice").val(niz['price']);

        let stock=document.getElementById('inStock');
        for(let i=0;i<stock.options.length;i++){
            if(stock.options[i].value==niz['inStock']){
                stock.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }

        let sizes=niz['sizes'];
        if(sizes!=null){
            sizes=sizes.split(",");
            for(let i=0;i<sizes.length;i++){
                for(let j=0;j<$(".size").length;j++){
                    if(sizes[i]==$(".size")[j].value){
                        $(".size")[j].checked=true;
                    }else{
                        $(".size")[j].checked=false;
                    }
                }
            }
        }else{
            for(let i=0;i<$(".size").length;i++){
                    $(".size")[i].checked=false;
            }
        }

        $("#material").val(niz['material']);

        $("#coo").val(niz['coo']);
    }

    function fetchCellsPoll(polje){
        let data={
            id:polje
        }
        $.ajax({
            url:"models/fetchPollCells.php",
            method:"POST",
            datatype:"JSON",
            data:data,
            success:function(result){
                fillCellsPoll(result);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    }

    function fillCellsPoll(niz){
        $("#surveyName").val(niz["pollName"]);
        let polje=document.getElementById("statusSurvey");
        for(let i=0;i<polje.options.length;i++){
            if(polje.options[i].value==niz["status"]){
                polje.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }
    }

    
    function fetchCells(polje){
        let data={
            id:polje
        }
        $.ajax({
            url:"models/fetchUserCells.php",
            method:"POST",
            datatype:"JSON",
            data:data,
            success:function(result){
                fillCells(result);
            },
            error: function(xhr){
                console.log(xhr);
            }
        });
    }

    function fillCells(niz){
        $("#firstName").val(niz["firstName"]);
        $("#lastName").val(niz["lastName"]);
        $("#username").val(niz["username"]);
        $("#email").val(niz["email"]);
        let polje=document.getElementById("role");
        for(let i=0;i<polje.options.length;i++){
            if(polje.options[i].value==niz["role"]){
                polje.options[i].selected=true;
                $('select').niceSelect('update');
            }
        }
    }

    function izmeniKorisnika(){
        proveriFirstName();
        proveriLastName();
        proveriUsername();
        proveriEmail();
        proveriPassword();
        if(proveriFirstName() && proveriLastName() && proveriUsername() &&  proveriEmail() && proveriPassword()){
            let paket={
                user: $("#users").val(),
                firstName : $("#firstName").val(),
                lastName : $("#lastName").val(),
                username : $("#username").val(),
                email: $("#email").val(),
                password : $("#password").val(),
                role: $("#role").val(),
                verified : 1
            }
            slanjePodataka("models/adminpnl/updateUser.php",paket,"status");
        }
    }

    function dodajKorisnika(){
        proveriFirstName();
        proveriLastName();
        proveriUsername();
        proveriAdresu();
        proveriGrad();
        proveraZipKoda();
        proveriEmail();
        proveriPassword();
        proveriPassword2();
        if(proveriPassword() && proveriPassword2()){
            uporediPassword();
        }

        if(proveriFirstName() && proveriLastName() && proveriUsername() && proveriAdresu() && proveriGrad() && proveraZipKoda() && proveriEmail() && proveriPassword() && proveriPassword2() && uporediPassword()){
            verificationNumber=Math.floor(Math.random()*90000) + 10000;
            let paket={
                firstName : $("#firstName").val(),
                lastName : $("#lastName").val(),
                username : $("#username").val(),
                email: $("#email").val(),
                adresa: $("#address").val(),
                grad : $("#city").val(),
                zip: $("#zip").val(),
                password : $("#password").val(),
                role: $("#role").val(),
                Vnumber: verificationNumber,
                verified : 1
            }
            slanjePodataka("models/adminpnl/addUser.php",paket,"status");
        }
    }

    function proveraFormeRegister(){
        /* let dugme=document.getElementById("btnRegister");
        dugme.addEventListener("click", ()=>{
            proveriUsername();
            proveriEmail();
            proveriPassword();
            proveriPassword2();
            if(proveriPassword() && proveriPassword2()){
                uporediPassword();
            }
        }) */
        proveriFirstName();
        proveriLastName();
        proveriUsername();
        proveriAdresu();
        proveriGrad();
        proveraZipKoda();
        proveriEmail();
        proveriPassword();
        proveriPassword2();
        if(proveriPassword() && proveriPassword2()){
            uporediPassword();
        }

        if(proveriFirstName() && proveriLastName() && proveriUsername() && proveriAdresu() && proveriGrad() && proveraZipKoda() && proveriEmail() && proveriPassword() && proveriPassword2() && uporediPassword()){
            /* let dugme=document.getElementById("btnRegister");
            dugme.style.color="white";
            dugme.style.backgroundColor="green";
            dugme.innerText="Registration successfully" */
            verificationNumber=Math.floor(Math.random()*90000) + 10000;
            let paket={
                firstName : $("#firstName").val(),
                lastName : $("#lastName").val(),
                username : $("#username").val(),
                email: $("#email").val(),
                adresa: $("#address").val(),
                grad : $("#city").val(),
                zip: $("#zip").val(),
                password : $("#password").val(),
                Vnumber: verificationNumber
            }
            slanjePodataka("models/registration.php",paket,"status",'verifikacija.php');
        }
    }


    function getNewUrl(){
        var current= window.location.href;
        var afterDomain= current.substring(current.indexOf('/',10)+1);
        var beforeQueryString= afterDomain.split("?")[0];
 
        return beforeQueryString;
    }

    function catchFilters(){
        let odabraniPol=[];
        let odabraniBrendovi=[];
        let odabraneKategorije=[];
        let odabraneDostupnosti=[];
        let nacinSortiranja="";
        let search="";
        
        for(let i=0;i<$(".brand:checked").length;i++){
            odabraniBrendovi.push(parseInt($(".brand:checked")[i].value.substring(5)));
        }

        for(let i=0;i<$(".category:checked").length;i++){
            odabraneKategorije.push(parseInt($(".category:checked")[i].value.substring(8)));
        }

        for(let i=0;i<$(".pol:checked").length;i++){
            odabraniPol.push(parseInt($(".pol:checked")[i].value.substring(3)));
        }
        let dugmad=$(".stanje:checked");
        for(let i=0;i<dugmad.length;i++){
            if(dugmad[i].checked==true){
                odabraneDostupnosti.push(dugmad[i].value);
            }
        }

        nacinSortiranja=$("#sortiranje").val();
        let filteri={};
        search=$("#searchText").val();
        filteri["nacinSortiranja"]=nacinSortiranja;
        if(search.trim()!=""){
            search=search.toLowerCase().trim();
            filteri["search"]=search;
        }

        if(odabraniPol.length!=0){
            filteri["pol"]=odabraniPol;
        }
        if(odabraniBrendovi.length!=0){
            filteri["brend"]=odabraniBrendovi;
        }
        if(odabraneKategorije.length!=0){
            filteri["kategorije"]=odabraneKategorije;
        }
        if(odabraneDostupnosti.length!=0){
            filteri["dostupnost"]=odabraneDostupnosti;
        }
        
        localStorage.setItem("filters",JSON.stringify(filteri));
    }

    function filterProducts(){
        let odabraniPol=[];
        let odabraniBrendovi=[];
        let odabraneKategorije=[];
        let odabraneDostupnosti=[];
        let nacinSortiranja="";
        let search="";

        let filteri=JSON.parse(localStorage.getItem("filters"));
        if(filteri){
            let pol=filteri["pol"];
            let kategorije=filteri["kategorije"];
            let brendovi=filteri["brend"];
            let dostupnost=filteri["dostupnost"];
            let searchText= filteri["search"];
            let sortiranjeNacin=filteri["nacinSortiranja"];

            if(pol){
                for(let i=0;i<pol.length;i++){
                    for(let j=0;j<$(".pol").length;j++){
                        if(($(".pol")[j]).value=="pol"+pol[i]){
                            ($(".pol")[j]).checked=true;
                            break;
                        }
                    }
                }
            }
    
            if(kategorije){
                for(let i=0;i<kategorije.length;i++){
                    for(let j=0;j<$(".category").length;j++){
                        if($(".category")[j].value=="category"+kategorije[i]){
                            ($(".category")[j]).checked=true;
                            break;
                        }
                    }
                }
            }

            if(brendovi){
                for(let i=0;i<brendovi.length;i++){
                    for(let j=0;j<$(".brand").length;j++){
                        if($(".brand")[j].value=="brand"+brendovi[i]){
                            ($(".brand")[j]).checked=true;
                            break;
                        }
                    }
                }
            }

            if(searchText){
                let search=document.getElementById("searchText");
                search.value=searchText;
            }

            if(dostupnost){
                for(let i=0;i<dostupnost.length;i++){
                    for(let j=0;j<$(".stanje").length;j++){
                        if($(".stanje")[j].value==dostupnost[i]){
                            $(".stanje")[j].checked=true;
                            break;
                        }
                    }
                }
                
            }

            if(sortiranjeNacin){
                let polje=document.getElementById("sortiranje");
                for(let i=0;i<polje.options.length;i++){
                    if(polje.options[i].value==sortiranjeNacin){
                        polje.options[i].selected=true;
                        break;
                    }
                }
            }
            
    
        }
        
        for(let i=0;i<$(".brand:checked").length;i++){
            odabraniBrendovi.push(parseInt($(".brand:checked")[i].value.substring(5)));
        }

        for(let i=0;i<$(".category:checked").length;i++){
            odabraneKategorije.push(parseInt($(".category:checked")[i].value.substring(8)));
        }

        for(let i=0;i<$(".pol:checked").length;i++){
            odabraniPol.push(parseInt($(".pol:checked")[i].value.substring(3)));
        }
        let dugmad=$(".stanje:checked");
        for(let i=0;i<dugmad.length;i++){
            if(dugmad[i].value=="dostupno"){
                odabraneDostupnosti.push(true);
            }
            if(dugmad[i].value=="nedostupno"){
                odabraneDostupnosti.push(false);
            }
        }
        nacinSortiranja=$("#sortiranje").val();
        search=$("#searchText").val();
        let podaciZaSlanje={};

        if(search.trim()!=""){
            search=search.toLowerCase().trim();
            podaciZaSlanje["search"]=search;
        }

        if(odabraniPol.length!=0){
            podaciZaSlanje["pol"]=odabraniPol;
        }
        if(odabraniBrendovi.length!=0){
            podaciZaSlanje["brend"]=odabraniBrendovi;
        }
        if(odabraneKategorije.length!=0){
            podaciZaSlanje["kategorije"]=odabraneKategorije;
        }
        if(odabraneDostupnosti.length!=0){
            podaciZaSlanje["dostupnost"]=odabraneDostupnosti;
        }

        if(nacinSortiranja!=""){
            if(nacinSortiranja=="priceAscending"){
                nacinSortiranja="newPrice ASC";
            }else if(nacinSortiranja=="priceDescending"){
                nacinSortiranja="newPrice DESC";
            }else if(nacinSortiranja=="nameAscending"){
                nacinSortiranja="product_name ASC";
            }else if(nacinSortiranja=="nameDescending"){
                nacinSortiranja="product_name DESC";
            }else{
                nacinSortiranja="";
            }
            podaciZaSlanje["nacinSortiranja"]=nacinSortiranja;
        }
        
        const urlParams = new URLSearchParams(window.location.search);

        let strana=urlParams.get('page');
        if(!strana){
            strana=1;
        }
        podaciZaSlanje['page']=strana;
        fetchData("models/fetchProducts.php",podaciZaSlanje,"proizvodi");

    }

    function prikazProizvoda(idProizvoda){
        let paket={
            id_proizvoda : idProizvoda
        }
        fetchData("models/fetchSingleProduct.php",paket,"jedanProizvod");
        fetchData("models/fetchDescription.php",paket,"tabelaSpecs");
    }

    function prikazKorpa(){
        let korpa=JSON.parse(localStorage.getItem("cart"));
            let paket={
                korpa :korpa
            }
            fetchData("models/fetchCart.php",paket,"prikazKorpe");
    }
}

function prikazSocial(polje){
    let id=polje.getAttribute("data-id");
    let dugme=document.getElementById(id);
    dugme.classList.remove("hidden");
}

function sakriSocial(polje){
    let id=polje.getAttribute("data-id");
    let dugme=document.getElementById(id);
    dugme.classList.add("hidden");
}

function dodajUkorpu(idProizvoda){
    var velicina=checkSizeSelected();
    var kolicina=checkQuantity();
    var products=[];
    var korpa=JSON.parse(localStorage.getItem("cart"));
    if(kolicina && velicina){
        if(korpa){
            if(productExist()){
                updateQuantity();
            }else{
                korpa.push({
                    id:idProizvoda,
                    size:velicina,
                    qty:parseInt(kolicina)
                });
                localStorage.setItem("cart",JSON.stringify(korpa));
            }
        }else{
            products[0]={
                id:idProizvoda,
                size:velicina,
                qty:parseInt(kolicina)
            }
            localStorage.setItem("cart",JSON.stringify(products));
            document.getElementById("numberOfProducts").textContent=1;
        }
    }

    if(korpa!=null){  
        document.getElementById("numberOfProducts").textContent=korpa.length;
    }
    
    function productExist(){
        return korpa.filter(x=>x.id==idProizvoda && x.size==velicina).length;
    }

    function updateQuantity(){
        let korpa=JSON.parse(localStorage.getItem("cart"));

        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==idProizvoda && korpa[i].size==velicina){
                korpa[i].qty=parseInt(korpa[i].qty)+parseInt(kolicina);
                break;
            }
        }
        localStorage.setItem("cart",JSON.stringify(korpa));
    }
     
}

function checkSizeSelected(){
    if($(".size:checked").length!=0){
        for(let i=0;i<($(".size").length);i++){
            if($(".size:checked")){  
                if(!document.getElementById("izaberiVelicinu").classList.contains("hidden")){
                    document.getElementById("izaberiVelicinu").classList.add("hidden");
                }
                return ($(".size:checked").val());
            }
        }
        
    }else{
        document.getElementById("izaberiVelicinu").classList.remove("hidden");
        return false;
    }
}

function checkQuantity(){
    let kolicina=document.getElementById("qty").value;
    if(kolicina<1 || kolicina>99){
        document.getElementById("izaberiKolicinu").classList.remove("hidden");
        return false;
    }else{
        document.getElementById("izaberiKolicinu").classList.add("hidden");
        return kolicina;
    }
}

function fetchData(url, data,polje){
    $.ajax({
        url: url,
        method: "POST",
        datatype: "JSON",
        data : data,
        success: function(result){
            $("#"+polje+"").html(result.answer);
        },
        error: function(xhr){
            console.log(xhr);
        }
    });
}

function fetchDataMethod(url, data,method){
    $.ajax({
        url: url,
        method: "POST",
        datatype: "JSON",
        data : data,
        success: method,
        error: function(xhr){
            console.log(xhr);
        }
    });
}


function dodajQty(polje){
    let dugme=polje.value;
    dugme=dugme.split(",");
    let korpa=JSON.parse(localStorage.getItem("cart"));
    if(dugme[2]==99){
        return;
    }else{
        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==dugme[0] && korpa[i].size==dugme[1] && korpa[i].qty==dugme[2]){
                korpa[i].qty=korpa[i].qty+1;
            }
        }
    }
    localStorage.setItem("cart",JSON.stringify(korpa));
    let korpaUpdate=JSON.parse(localStorage.getItem("cart"));
    let paket={
        korpa : korpaUpdate
    }
    fetchData("models/fetchCart.php",paket,"prikazKorpe");
}

function smanjiQty(polje){
    let dugme=polje.value;
    dugme=dugme.split(",");
    let korpa=JSON.parse(localStorage.getItem("cart"));
    if(dugme[2]==1){
        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==dugme[0] && korpa[i].size==dugme[1] && korpa[i].qty==dugme[2]){
                    korpa.splice(i,1);
            }
        }
        if(korpa.length==0){
            localStorage.removeItem("cart");
        }else{
            localStorage.setItem("cart",JSON.stringify(korpa));
        }
        document.getElementById("numberOfProducts").textContent=korpa.length;
        let korpaUpdate=JSON.parse(localStorage.getItem("cart"));
        let paket={
            korpa : korpaUpdate
        }
        fetchData("models/fetchCart.php",paket,"prikazKorpe");
    }else{
        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==dugme[0] && korpa[i].size==dugme[1] && korpa[i].qty==dugme[2]){
                korpa[i].qty=korpa[i].qty-1;
            }
        }
        localStorage.setItem("cart",JSON.stringify(korpa));
        let korpaUpdate=JSON.parse(localStorage.getItem("cart"));
        let paket={
            korpa : korpaUpdate
        }
        fetchData("models/fetchCart.php",paket,"prikazKorpe");
    }
}

function UkloniProizvod(polje){
    let dugme=polje.value;
    dugme=dugme.split(",");
    let dugmad=document.getElementsByClassName("removeItem").length;
    if(dugmad!=1){
        let korpa=JSON.parse(localStorage.getItem("cart"));
        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==parseInt(dugme[0]) && korpa[i].size==dugme[1] && korpa[i].qty==parseInt(dugme[2])){
                korpa.splice(i,1);
            }
        }
        document.getElementById("numberOfProducts").textContent=korpa.length;
        localStorage.setItem("cart",JSON.stringify(korpa));
        let korpaUpdate=JSON.parse(localStorage.getItem("cart"));
        let paket={
            korpa : korpaUpdate
        }
        fetchData("models/fetchCart.php",paket,"prikazKorpe");
    }else{
        let korpa=JSON.parse(localStorage.getItem("cart"));
        for(let i=0;i<korpa.length;i++){
            if(korpa[i].id==parseInt(dugme[0]) && korpa[i].size==dugme[1] && korpa[i].qty==parseInt(dugme[2])){
                korpa.splice(i,1);
            }
        }
        document.getElementById("numberOfProducts").textContent=0;
        localStorage.removeItem("cart");
        let korpaUpdate=JSON.parse(localStorage.getItem("cart"));
        let paket={
            korpa : korpaUpdate
        }
        fetchData("models/fetchCart.php",paket,"prikazKorpe");
    }
}

function redirectAdmin(){
    const timer=setTimeout(() => {
        window.location.href='adminpnl.php';
    }, 1000);
    
}
