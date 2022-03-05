$(document).ready(function () {
    console.log("Working..");

    $("#register").click(function (e) { 
        e.preventDefault();
        console.log("Register Button Working Fine..");
        var userNamee=$("#us").val();
        var mail=$("#ml").val();
        var password=$("#ps").val();
        var Cpassword=$("#cps").val();
        var role="user";
        var status="Blocked";
        console.log("user name :"+userNamee);
        console.log(mail);
        console.log(password);
        console.log(Cpassword);

        if(userNamee="" || mail=="" || password=="" || Cpassword==""){
         
            $("#us").css("borderColor","red");
            $("#ml").css("borderColor","red");
            $("#ps").css("borderColor","red");
            $("#cps").css("borderColor","red");
        
            $("#result").text("All Feilds Are Required!");
            $("#result").css("color","red");
        } 
        else{
            if(password!=Cpassword){
                $("#result").text("Password Does not Match");
            $("#result").css("color","red");

                $("#us").css("borderColor","green");
                        $("#ml").css("borderColor","green");
                        $("#ps").css("borderColor","red");
                        $("#cps").css("borderColor","red");
                        
                    }
            else{
                var userNameee=$("#us").val();
                
                $.ajax({
                    type: "post",
                    url: "classes/call.php",
                    data: {
                        action:"register",
                        id:Math.floor((Math.random() * 1000) + 1),
                        password:password,
                        email:mail,
                        role:role,
                        status:status,
                        user:userNameee,

                        
                    },
                    success: function (response) {
                        $("#us").css("borderColor","green");
                        $("#ml").css("borderColor","green");
                        $("#ps").css("borderColor","green");
                        $("#cps").css("borderColor","green");
                        $("#result").text("Information Recorded..");   
                        $("#result").css("color","green");
                        console.log(response);
                        
                    }

                });
                        // $("#us").css("borderColor","green");
                        // $("#ml").css("borderColor","green");
                        // $("#ps").css("borderColor","green");
                        // $("#cps").css("borderColor","green");
            }
        }
        
    });


    ///code for Login.php file 
    $("#login").click(function (e) { 
        e.preventDefault();
        // console.log("Login Bt working..");
        var user=$("#un").val();
        var password=$("#ps").val();
        // console.log(user,password);
        if(user=="" || password==""){
          
            $("#rs").text("All Feilds Required");
            $("#rs").css("borderColor","red");
            $("#un").css("borderColor","red");
            $("#ps").css("borderColor","red");


        }   
        else{
            $("#rs").css("borderColor","green");
            $("#un").css("borderColor","green");
            $("#ps").css("borderColor","green");

         $.ajax({
             type: "post",
             url: "classes/call.php",
             data: {
                 action:"login",
                 username:user,
                 password:password
             },
             success: function (response) {
               
                 if(response=="valid"){
                    $(location). attr('href','../../dashboard.php'); 

                 }
                 else if(response=="Invalid Username Or Password!"){
                    $("#rs").css("borderColor","red");
                    $("#rs").text("Invalid Username Or Password  or status is not approved.");
                    


                 }
             }
         });
        }
    });

    // $("#aprov").click(function (e) { 
    //     e.preventDefault();
    //     alert("aproved");
    // });

    $(document).on('click','#aprov', function (e) {
        e.preventDefault();
        var id=$(this).val();
        // alert(id);

        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action:"updateapprov",
                id:id
            },
            success: function (response) {
                $(location). attr('href','../../dashboard.php'); 
            }
        });

    });

    $(document).on('click','#block', function (e) {
        e.preventDefault();
        var id=$(this).val();
        // alert(id);
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action:"updateblock",
                id:id
            },
            success: function (response) {
                $(location). attr('href','../../dashboard.php'); 
            }
        });
        
    });

    $(document).on('click','#del', function (e) {
        e.preventDefault();
        var id=$(this).val();
        // alert(id);
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action:"delvalue",
                id:id
            },
            success: function (response) {
                $(location). attr('href','../../dashboard.php'); 
            }
        });
        
    });
    
    $("#aaddproduct").click(function (e) { 
        e.preventDefault();
        var pid=$("#pid").val();
        var pname=$("#pname").val();
        var pcat=$("#pcat").val();
        var pScat=$("#pScat").val();
        var pprice=$("#pprice").val();
        if(pid="" || pname=="" || pcat=="" || pScat=="" || pprice==""){
            $("#pid").css("borderColor","red");
            $("#pname").css("borderColor","red");
            $("#pcat").css("borderColor","red");
            $("#pScat").css("borderColor","red");
            $("#pprice").css("borderColor","red");
        }
        else{
            console.log(pid,pname,pcat,pScat,pprice);
            var pidd=$("#pid").val();
            $.ajax({
                
                type: "post",
                url: "classes/call.php",
                data: {
                    action:"productInsert",
                    pid:pidd,
                    pname:pname,
                    pcat:pcat,
                    pScat,pScat,
                    pprice,pprice
                },
                success: function (response) {
                              
                    $("#pid").css("borderColor","green");
                    $("#pname").css("borderColor","green");
                    $("#pcat").css("borderColor","green");
                    $("#pScat").css("borderColor","green");
                    $("#pprice").css("borderColor","green");
               
                }
                
                

            });
            $(location). attr('href','../../products.php'); 
            
            
            
            $("#pid").css("borderColor","green");
            $("#pname").css("borderColor","green");
            $("#pcat").css("borderColor","green");
            $("#pScat").css("borderColor","green");
            $("#pprice").css("borderColor","green");
        }
        

    });

});