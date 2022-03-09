$(document).ready(function () {
    console.log("Working..");

    $("#register").click(function (e) {
        e.preventDefault();
        console.log("Register Button Working Fine..");
        var userNamee = $("#us").val();
        var mail = $("#ml").val();
        var password = $("#ps").val();
        var Cpassword = $("#cps").val();
        var role = "user";
        var status = "Blocked";
        console.log("user name :" + userNamee);
        console.log(mail);
        console.log(password);
        console.log(Cpassword);

        if (userNamee = "" || mail == "" || password == "" || Cpassword == "") {

            $("#us").css("borderColor", "red");
            $("#ml").css("borderColor", "red");
            $("#ps").css("borderColor", "red");
            $("#cps").css("borderColor", "red");

            $("#result").text("All Feilds Are Required!");
            $("#result").css("color", "red");
        }
        else {
            if (password != Cpassword) {
                $("#result").text("Password Does not Match");
                $("#result").css("color", "red");

                $("#us").css("borderColor", "green");
                $("#ml").css("borderColor", "green");
                $("#ps").css("borderColor", "red");
                $("#cps").css("borderColor", "red");

            }
            else {
                var userNameee = $("#us").val();

                $.ajax({
                    type: "post",
                    url: "classes/call.php",
                    data: {
                        action: "register",
                        id: Math.floor((Math.random() * 1000) + 1),
                        password: password,
                        email: mail,
                        role: role,
                        status: status,
                        user: userNameee,


                    },
                    success: function (response) {
                        $("#us").css("borderColor", "green");
                        $("#ml").css("borderColor", "green");
                        $("#ps").css("borderColor", "green");
                        $("#cps").css("borderColor", "green");
                        // var empt="";
                        // $("#us").text(empt);
                        $("#us").val("");
                        $("#ml").val("");
                        $("#ps").val("");
                        $("#cps").val("");
                        $("#result").text("Information Recorded..");
                        $("#result").css("color", "green");
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
        var user = $("#un").val();
        var password = $("#ps").val();
        // console.log(user,password);
        if (user == "" || password == "") {

            $("#rs").text("All Feilds Required");
            $("#rs").css("borderColor", "red");
            $("#un").css("borderColor", "red");
            $("#ps").css("borderColor", "red");


        }
        else {
            $("#rs").css("borderColor", "green");
            $("#un").css("borderColor", "green");
            $("#ps").css("borderColor", "green");

            $.ajax({
                type: "post",
                url: "classes/call.php",
                data: {
                    action: "login",
                    username: user,
                    password: password
                },
                success: function (response) {

                    if (response == "valid") {
                        console.log("loin");
                        $(location).attr('href', '../../dashboard.php');


                    }
                    else if (response == "Invalid Username Or Password!") {
                        $("#rs").css("borderColor", "red");
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

    $(document).on('click', '#aprov', function (e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id);

        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action: "updateapprov",
                id: id
            },
            success: function (response) {
                $(location).attr('href', '../../dashboard.php');
            }
        });

    });

    $(document).on('click', '#block', function (e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action: "updateblock",
                id: id
            },
            success: function (response) {
                $(location).attr('href', '../../dashboard.php');
            }
        });

    });

    $(document).on('click', '#del', function (e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action: "delvalue",
                id: id
            },
            success: function (response) {
                $(location).attr('href', '../../dashboard.php');
            }
        });

    });

    $("#aaddproduct").click(function (e) {
        e.preventDefault();
        var pid = $("#pid").val();
        var pname = $("#pname").val();
        var pcat = $("#pcat").val();
        var pScat = $("#pScat").val();
        var pprice = $("#pprice").val();
        var pimage = $('#pimage').val();
        if (pid = "" || pname == "" || pcat == "" || pScat == "" || pprice == "") {
            $("#pid").css("borderColor", "red");
            $("#pname").css("borderColor", "red");
            $("#pcat").css("borderColor", "red");
            $("#pScat").css("borderColor", "red");
            $("#pprice").css("borderColor", "red");
        }
        else {
            console.log(pid, pname, pcat, pScat, pprice);
            var pidd = $("#pid").val();
            $.ajax({

                type: "post",
                url: "classes/call.php",
                data: {
                    action: "productInsert",
                    pid: pidd,
                    pname: pname,
                    pcat: pcat,
                    pScat: pScat,
                    pprice: pprice,
                    pimage: pimage
                },
                success: function (response) {

                    $("#pid").css("borderColor", "green");
                    $("#pname").css("borderColor", "green");
                    $("#pcat").css("borderColor", "green");
                    $("#pScat").css("borderColor", "green");
                    $("#pprice").css("borderColor", "green");

                }



            });
            $(location).attr('href', '../../products.php');



            $("#pid").css("borderColor", "green");
            $("#pname").css("borderColor", "green");
            $("#pcat").css("borderColor", "green");
            $("#pScat").css("borderColor", "green");
            $("#pprice").css("borderColor", "green");
        }


    });

    $(document).on('click', '#dell', function (e) {
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                action: "delvalueProduct",
                id: id
            },
            success: function (response) {

            }
        });
        $(location).attr('href', '../../products.php');

    });

    $(document).on("click", "#editt", function () {
        var id = $(this).val();
        console.log(id);
        $("#UpdateProduct").css("display", "inline");
        $("#aaddproduct").css("display", "none");

        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "EditProduct",
                id: id
            },
            success: function (response) {
                displayEditValue(response);
                // console.log(response);

            }
        });


    });
    var readID;
    $("#UpdateProduct").click(function (e) {
        e.preventDefault();
        var id = $("#pid").val();
        var name = $("#pname").val();
        var pcat = $("#pcat").val();
        var pscat = $("#pScat").val();
        var price = $("#pprice").val();
        var image = $("#pimage").val();
        // console.log(id,name,pcat);
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "updateEditValue",
                pid: id,
                pname: name,
                pcat: pcat,
                pscat: pscat,
                price: price,
                image: image,
                realid: readID
            },
            success: function (response) {
                console.log(response);
            }
        });


    });
    function displayEditValue(responce) {
        var data = $.parseJSON(responce);
        $("#pid").val(data[0].id);
        $("#pname").val(data[0].product_name);
        $("#pcat").val(data[0].category);
        $("#pScat").val(data[0].sub_category);
        $("#pprice").val(data[0].price);
        $("#pimage").val(data[0].image);
        readID = $("#pid").val();
    }

    $("#srchh").click(function (e) {
        e.preventDefault();
        var search = $("#searcproduct").val();
        console.log(search);
        $.ajax({
            type: "post",
            url: "classes/call.php",
            data: {
                id: search,
                action: "search1"
            },
            success: function (response) {
                $("#tb").html(response);
            }
        });

    });


    $("#searchproduct").click(function (e) {
        e.preventDefault();
        var Productname = $("#pname").val();
        console.log(Productname);

        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                key: Productname,
                action: "search2",
            },
            success: function (response) {
                $("#ProductListingg").html(response);

            }
        });
    });

    $("#filter").change(function (e) {
        e.preventDefault();
        var value = $(this).val();
        console.log(value);
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "filter",
                key: value
            },
            success: function (response) {
                $("#ProductListingg").html(response);

            }
        });

    });

    $(document).on('click', '#addtocart', function () {
        var id = $(this).val();
        console.log(id);

        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "addtocart",
                id: id
            },
            success: function (response) {
                console.log(response);
            }
        });
    });

    $(document).on('click', '#updatebtn', function () {

        var id = $(this).val();
        var newid = $("#updatebtn").val();
        var newValue = $("#inputQuantity").val();
        var concatt = "updateValue" + id;
        var value = $("#" + concatt).val();
        console.log(id);
        console.log(value);
        console.log("New id", newid);
        console.log("New value", newValue);

        if (newValue > 0) {
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action: "updateQuant",
                    id: newid,
                    Quantity: newValue
                },
                success: function (response) {

                    $(location).attr('href', '../../front-end/cart.php');
                    console.log(response);
                    $("#inputQuantity").text("");
                }
            });
        }
        if (value > 0) {
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action: "updateQuant",
                    id: id,
                    Quantity: value
                },
                success: function (response) {

                    $(location).attr('href', '../../front-end/cart.php');
                    console.log(response);
                }
            });
        }

    });

    $(document).on("click", "#delll", function () {
        var id = $(this).val();
        console.log(id);
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "deleteCartItem",
                id: id
            },
            success: function (response) {
                console.log(response);
                $(location).attr('href', '../../front-end/cart.php');
            }
        });
    });

    $("#clearCart").click(function (e) {
        e.preventDefault();
        // console.log("clicked");
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "clearcart"
            },
            success: function (response) {
                $(location).attr('href', '../../front-end/cart.php');
            }
        });
    });

    $(document).on("click", ".viewProduct", function () {
        var product_name = $(this).text();
        console.log(product_name);
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "ViewProduct",
                pname: product_name
            },
            success: function (response) {
                $(location).attr('href', '../../front-end/single-product.php');
            }
        });



    });

    $("#placeorderBTN").click(function (e) {
        e.preventDefault();
        //    console.log("wprking..");
        var fname = $("#firstName").val();
        var lname = $("#lastName").val();
        var uname = $("#username").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var address2 = $("#address2").val();

        var country = $('#country :selected').text();
        var state = $('#state :selected').text();
        var zipcode = $("#zip").val();

        var paymentMode = $("input[name='paymentMethod']:checked").val();

        var cartholdername = $("#cc-name").val();
        var cartnumber = $("#cc-number").val();
        var expire = $("#cc-expiration").val();
        var cvv = $("#cc-cvv").val();

        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action: "placeorder",
                fname: fname,
                lname: lname,
                uname: uname,
                email: email,
                address: address,
                address2: address2,
                country: country,
                state: state,
                zipcode: zipcode,
                paymentmode: paymentMode,
                cartholdername: cartholdername,
                cartnumber: cartnumber,
                expire: expire,
                cvv: cvv
            },
            success: function (response) {
                console.log(response);
            }
        });


    });

    $("#sch").click(function (e) {
        e.preventDefault();
        var searchKey = $("#searchOrder").val();

        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action:'SearchOrder',
                searchkey:searchKey
            },
            success: function (response) {
                $("#td").html(response);
            }
        });

    });

    $(document).on("click",'#orderaction', function (e) {
        e.preventDefault();
        var keyAction=$(this).val();
        var txt=$(this).text();

        console.log(keyAction);
        console.log(txt);

       $.ajax({
           type: "post",
           url: "../../classes/call.php",
           data: {
               action:"updateStatusOrder",
               id:keyAction,
               value:txt
           },
           success: function (response) {
               $(location).attr('href','../../orders.php');
           }
       });

    });


    $("#singout").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "../../classes/call.php",
            data: {
                action:"signout"
            },
            success: function (response) {
                
            }
        });
    });
    var offset=0;

    $(document).on('click','#pageclick', function (e) {
        e.preventDefault();
        var a=$(this).text();
        console.log(a);
        if(a=='2'){
            offset=6;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"pagination",
                    offsetvalue:offset
                },
                success: function (response) {
                    $("#ProductListingg").html(response);
                }
            });
        }
        else if(a=='3'){
            offset=12;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"pagination",
                    offsetvalue:offset
                },
                success: function (response) {
                    $("#ProductListingg").html(response);
                }
            });
        }
        else if(a=='1'){
            offset=0;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"pagination",
                    offsetvalue:offset
                },
                success: function (response) {
                    $("#ProductListingg").html(response);
                }
            });
        }
        else if(a=='Next' && offset<12){
            offset+=6;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"pagination",
                    offsetvalue:offset
                },
                success: function (response) {
                    $("#ProductListingg").html(response);
                }
            });
        }
        else if(a=='Previous' && offset>0){
            offset-=6;
            console.log();
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"pagination",
                    offsetvalue:offset
                },
                success: function (response) {
                    $("#ProductListingg").html(response);

                }
            });
        }
        console.log("final offset "+offset);

    });
    
    var offset2=0;
    $(document).on("click","#pageclickproduct", function () {
        var b=$(this).text();
        if(b=='2'){
            offset2=10;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproduct",
                    offset:offset2
                },
                success: function (response) {
                    $("#tb").html(response);                    
                }
            });
            
        }
        else if(b=='3'){
            offset2=20;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproduct",
                    offset:offset2
                },
                success: function (response) {
                    $("#tb").html(response);                    
                }
            });
            
        }
        else if(b=='1'){
            offset2=0;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproduct",
                    offset:offset2
                },
                success: function (response) {
                    $("#tb").html(response);                    
                }
            });
            
        }
        else if(b=='Next' && offset2<20){
            offset2+=10;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproduct",
                    offset:offset2
                },
                success: function (response) {
                    $("#tb").html(response);                    
                }
            });
            
        }
        else if(b=='Previous'&& offset2>0){
            offset2-=10;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproduct",
                    offset:offset2
                },
                success: function (response) {
                    $("#tb").html(response);                    
                }
            });
            
        }
        console.log(offset2);
    });

    
    var offset3=0;
    $(document).on("click","#pageclickuser", function () {
        var c=$(this).text();
        console.log(c);
        if(c=='2'){
            offset3=5;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproductuser",
                    offset:offset3
                },
                success: function (response) {
                    $("#ll").html(response);    
                    console.log(response);                
                }
            });
            
        }
        else if(c=='3'){
            offset3=10;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproductuser",
                    offset:offset3
                },
                success: function (response) {
                    $("#ll").html(response);                  
                }
            });
            
        }
        else if(c=='1'){
            offset3=0;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproductuser",
                    offset:offset3
                },
                success: function (response) {
                    $("#ll").html(response);                    
                }
            });
            
        }
        else if(c=='Next' && offset3<10){
            offset3+=5;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproductuser",
                    offset:offset3
                },
                success: function (response) {
                    $("#ll").html(response);                    
                }
            });
            
        }
        else if(c=='Previous'&& offset3>0){
            offset3-=5;
            $.ajax({
                type: "post",
                url: "../../classes/call.php",
                data: {
                    action:"paginationproductuser",
                    offset:offset3
                },
                success: function (response) {
                    $("#ll").html(response);                    
                }
            });
            
        }
        console.log("final "+offset3);
    });
});

