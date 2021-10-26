$(document).ready(function()
{   
    //Login script
	$("#user_login").submit(function(e)
	{
		e.preventDefault(); //stop action="" in form
		var username = document.forms["user_login"]["username"].value;
		var password = document.forms["user_login"]["password"].value;
        
        //if username and password are not blank - required handles this too
        if(username != "" && password != "")
        {
            $.ajax
            ({
                type: "POST",
                url: "login.php",
                data: { login_submit: "login", username: username, password: password},
        
                success: function(response)
                {
                    if(response === "success")
                    {
                        window.location.href = "http://localhost/WebDev2/home.php?login=success";
                    }
                    else
                    {
                        alert(response);
                    }
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }
                
            });
        }
        else
        {
            alert("Fill in details");
        }
    });

    //Registration script
    //regestration submission
    $("#user_reg").submit(function(e)
    {
        e.preventDefault();

        var username = document.getElementById("reg_username").value;
        var password = document.getElementById("reg_password").value;
        var firstname = document.getElementById("reg_firstname").value;
        var lastname = document.getElementById("reg_lastname").value;
        var email = document.getElementById("reg_email").value;
        var sec_q = document.getElementById("reg_sec_q").value;
        var sec_ans = document.getElementById("reg_sec_ans").value;
        var city = document.getElementById("reg_city").value;
        var country = document.getElementById("reg_country").value;
        var regis_submit = document.getElementById("regis_submit").value;
        var profile_pic = document.getElementById("profile_img").value;
        var email_valid = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var invalid = "";

        //Remove path
        profile_pic = profile_pic.split(/(\\|\/)/g).pop();

        if(profile_pic === "")
        {
            profile_pic = "default_img.jpg";
        }

        //if name is valid
        if((isNaN(firstname) && isNaN(lastname)) && (firstname !== "" && lastname !== "") )
        {
            var fullname = firstname+" "+lastname;
        }
        else
        {
            if(!(isNaN(firstname)))
            {
                invalid = "\n - Please enter a valid first name";
            }
            else
            {
                if(!(isNaN(lastname)))
                {
                    invalid = invalid + "\n - Please enter a valid last name";
                }
            }
        }

        //if security question is valid
        if(!(isNaN(sec_ans)) || sec_ans === "")
        {
            invalid = invalid + "\n - Please enter a valid answer"
        }

        //if email is valid
        if(!((email).match(email_valid)) || email === "")
        {
            invalid = invalid + "\n - Please enter a valid email";
        }

        //if city is valid
        if(!(isNaN(city)) || city === "")
        {
            invalid = invalid + "\n - Please enter a valid city";
        }

        if(!(isNaN(country))|| country === "")
        {
            invalid = invalid + "\n - Please enter a valid country";
        }

        //if no invalids
        if(invalid === "")
        {
            //alert(username+"\n"+password+"\n"+fullname+"\n"+email+"\n"+city+"\n"+country+"\n"+sec_q+"\n"+sec_ans+"\n"+profile_pic);
           $.ajax
            ({
                type: "POST",
                url: "process_registration.php",
                data: { regis_submit: regis_submit, username: username,
                password: password, name: fullname, email: email, city: city, country: country, sec_q: sec_q,
                sec_ans: sec_ans, profile_img: profile_pic },

                success: function(response)
                {
                    alert(response);

                    if(response === "success")
                    {
                        window.location.href = "http://localhost/WebDev2/index.php";
                    }

                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }
                
            });
        }
        else
        {
            alert("Invalid Input(s): "+invalid);
        }

    });

    //show password during registration
    $("#showPass").click(function()
    {
        var x = document.getElementById("reg_password");
        if(x.type === "password")
        {
            x.type = "text";
        }
        else
        {
            x.type = "password";
        }
    });

    //Suggest restaurants
    $("#res_sw").keyup(function()
    {
        var search = $("#res_sw").val();

        if(search != "")
        {
            $.ajax
            ({
                type: "POST",
                url: "suggest_restaurant.php",
                data: { suggestion: search },
                success: function(data)
                {
                    $("#suggest").html(data);
                }
            });
        }
        else
        {
            $("#suggest").html("");
        }
    });

    var myDealCount = 2;
    //Load more deals
    $("#more_deals").click(function()
    {
        myDealCount = myDealCount + 1;

        $("#my_deals").load("more_deals.php", { dealsNewCount: myDealCount });

    });

    var myFavCount = 5;
    //Load more favourites
    $("#more_favs").click(function()
    {
        myFavCount = myFavCount + 2;

        $("#my_favs").load("more_favs.php", { favsNewCount: myFavCount });

    });

    //Load more restaurants
    var restaurantCount = 5;
    $(".more_res").click(function()
    {
        restaurantCount = restaurantCount + 2;
        var location = document.forms['filter_by']['filter_location'].value;
        var cuisine = document.forms['filter_by']['filter_cuisine'].value;

        $(".all_res").load("more_restaurants.php", { resNewCount: restaurantCount, filter_location: location, filter_cuisine: cuisine });

    });

    //Load more searched restaurants
    var restaurantSearchCount = 5;
    $(".more_res_sw").click(function()
    {
        restaurantSearchCount = restaurantSearchCount + 2;
        var searched = document.getElementById("res_sw").value;
        var location = document.forms['filter_by_sw']['filter_location'].value;
        var cuisine = document.forms['filter_by_sw']['filter_cuisine'].value;


        $(".all_res").load("more_searched_res.php", { sw_item: searched, resNewCount: restaurantSearchCount, filter_location: location, filter_cuisine: cuisine });

    });

    //Filter category restaurants
    $("#filter_by").submit(function(e)
    {
        e.preventDefault();
        
        var location = document.forms['filter_by']['filter_location'].value;
        var cuisine = document.forms['filter_by']['filter_cuisine'].value;
        var apply_filter = document.forms['filter_by']['apply_filter'].value;

        $(".all_res").load("filter_cat_restaurants.php", { filter_location: location, filter_cuisine: cuisine, apply_filter: apply_filter });   

    });

    //Filter searched restaurants
    $("#filter_by_sw").submit(function(e)
    {
        e.preventDefault();
        
        var searched = document.getElementById("res_sw").value;
        var location = document.forms['filter_by_sw']['filter_location'].value;
        var cuisine = document.forms['filter_by_sw']['filter_cuisine'].value;
        var apply_filter = document.forms['filter_by_sw']['apply_filter'].value;

       // alert(searched+location+cuisine+apply_filter);

        $(".all_res").load("filter_searched_res.php", { sw_item: searched, filter_location: location, filter_cuisine: cuisine, apply_filter: apply_filter });   

    });

    //Write a review
    $("#review_form").submit(function(e)
    {
        e.preventDefault();

        var rev_title = document.forms["review_form"]["review_title"].value;
        var rev_desc = document.forms["review_form"]["review_desc"].value;
        var rev_submit = document.forms["review_form"]["submit_review"].value;

        $.ajax
        ({
            type: "POST",
            url: "submit_review.php",
            data: { review_title: rev_title, review_desc: rev_desc, submit_review: rev_submit },
            success: function(ret)
            {
                if(ret !== "failed")
                {
                    alert("Review posted successfully ");
                    var url = "http://localhost/WebDev2/view_restaurant.php?resid="+ret;
                    window.location.href = url;
                }
                else
                {
                    alert("Failed to post review");
                }

            },
            error: function(xhr, textStatus, errorThrown)
            {
                alert("An error as occured: "+textStatus+": "+errorThrown);
            }

        });


    });

    //Change profile pic section
    $("#picture_arrow").click(function()
    {
        $("#change_upic").toggle(200);

    });

    //Change password section
    $("#password_arrow").click(function()
    {
        $("#change_upass").toggle(200);

    });

    //Change personal info section
    $("#personal_arrow").click(function()
    {
        $("#change_personal").toggle(200);

    });

    //Change Profile picture
    $("#change_profile_pic").submit(function(e)
    {
        e.preventDefault();

        var new_pic = document.forms['change_profile_pic']['new_profile_picture'].value;
        var pic_submit = document.forms['change_profile_pic']['change_picture'].value;

        //Remove path from file selected
        new_pic = new_pic.split(/(\\|\/)/g).pop();

        if(new_pic === "")
        {
            alert("No file chosen");
        }
        else
        {
            $.ajax
            ({
                type: "POST",
                url: "change_details.php",
                data: { new_profile_picture: new_pic, change_picture: pic_submit },
                success: function(ret)
                {
                    if(ret === "success")
                    {
                        alert("Profile picture changed");
                    }
                    else
                    {
                        alert("Unable to change profile picture");
                    }
                    
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }

            });
            
        }

    });

    //Change password
    $("#change_profile_pass").submit(function(e)
    {
        e.preventDefault();

        var new_password = document.forms['change_profile_pass']['new_pass'].value;
        var conf_password = document.forms['change_profile_pass']['confirm_new_pass'].value;
        var pass_submit = document.forms['change_profile_pass']['change_password'].value;

        //Check blank
        if(new_password === "")
        {
            alert("Invalid password: blank. Please enter a valid password");
            return;
        }

        //Check number
        if(!(isNaN(new_password)))
        {
            alert("Invalid password: number. Please enter a valid password");
            return;
        }
    
        //Check if passwords are the same
        if(new_password !== conf_password)
        {
            alert("Passwords do not match ");
            return;
        }
        else
        {
            $.ajax
            ({
                type: "POST",
                url: "change_details.php",
                data: { new_pass: new_password, change_password: pass_submit },
                success: function(ret)
                {
                    if(ret === "success")
                    {
                        alert("Password changed");
                    }
                    else
                    {
                        alert("Unable to change password");
                    }
                    
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }

            });
            
        }

    });

    //Change personal info
    $("#change_profile_info").submit(function(e)
    {
        e.preventDefault();

        var new_name = document.forms['change_profile_info']['new_name'].value;
        var new_email = document.forms['change_profile_info']['new_email'].value;
        var new_city = document.forms['change_profile_info']['new_city'].value;
        var new_country = document.forms['change_profile_info']['new_country'].value;
        var info_submit = document.forms['change_profile_info']['change_info'].value;
        var email_valid = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var invalid = "";

        //Check for numbers
        if(!(isNaN(new_name)) && new_name !== "")
        {
            invalid = "\n- Invalid Name Entry";
        }

        //make sure email is valid
        if(!((new_email).match(email_valid)) && new_email !== "")
        {
            invalid = invalid + "\n- Invalid Email Entry";
        }

        if((!(isNaN(new_city)) || !(isNaN(new_country))) && (new_city !== "" || new_country !== ""))
        {
            invalid = invalid + "\n- Invalid Location Entry";
        }

        if(invalid === "")
        {
            //alert(new_name+" "+new_email+" "+new_city+", "+new_country+info_submit);
            $.ajax
            ({
                type: "POST",
                url: "change_details.php",
                data: { new_name : new_name, new_email: new_email, 
                    new_city: new_city, new_country: new_country, change_info : info_submit },
                success: function(ret)
                {
                    if(ret === "success")
                    {
                        alert("Details Changed Successfully");
                        document.getElementById("name_label").innerHTML = "Name: "+new_name;
                        document.getElementById("email_label").innerHTML = "Email: "+new_email;
                        document.getElementById("location_label").innerHTML = "Location: "+new_city+", "+new_country;
                        document.getElementById("new_name").value = "";
                        document.getElementById("new_email").value = "";
                        document.getElementById("new_city").value = "";
                        document.getElementById("new_country").value = "";
                        
                    }
                    else
                    {
                        alert("Unable to change details: "+ret);
                    }
                    
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }

            });
            
        }
        else
        {
            alert("Invalid Input(s) Found:"+ invalid);
        }

    });

    //Verify user script
    $("#check_user").submit(function(e)
    {
        e.preventDefault();

        var username = document.forms['check_user']['check_uname'].value;
        var email = document.forms['check_user']['check_uemail'].value;
        var verify = document.forms['check_user']['verify_user'].value;
        var email_valid = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        var invalid = "";

        if(!(isNaN(username)) || username === "")
        {
            invalid = "\n- Please enter a valid username\n";
        }

        if(!(email.match(email_valid)) || email === "")
        {
            invalid = invalid + "\n- Please enter a valid email\n";
        }

        if(invalid === "")
        {
            /*$("#verify_user").slideUp(800);
            $("#verify-ucheck").delay(500).toggle(800);
            $("#verify_question").html(res[0].content).delay(1200).slideDown(800);*/

            $.ajax
            ({
                type: "POST",
                url:"recover_password.php",
                data: { username: username, email: email, verify_user: verify },
                success: function(data)
                {
                    //$("#verify_question").html(data).delay(1200).slideDown(800);
                    var res = JSON.parse(data);
                    if(res[0].result === "valid")
                    {
                        $("#verify_user").slideUp(800);
                        $("#verify-ucheck1").delay(500).toggle(800);
                        $("#usec_q").html(res[0].content);
                        $("#verify_question").delay(1200).slideDown(800);
                    }
                    else
                    {
                        alert(res[0].content);
                    }
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }

                
            });
        }
        else
        {
            alert("Invalid Inputs Found:"+invalid);
        }


    });

    //Security question script
    $("#security_q").submit(function(e)
    {
        e.preventDefault();
        
        var username = document.forms['check_user']['check_uname'].value;
        var email = document.forms['check_user']['check_uemail'].value;
        var sec_submit = document.forms['security_q']['sec_submit'].value;
        var sec_answer = document.forms['security_q']['sec_answer'].value;
        var invalid = "";

        if(sec_answer === "")
        {
            invalid = "Please enter a valid answer";
        }

        if(invalid === "")
        {
            $.ajax
            ({
                type: "POST",
                url: "recover_password.php",
                data: { username: username, email: email, sec_submit: sec_submit, sec_answer: sec_answer },
                success: function(ret)
                {
                    if(ret === "Success")
                    {
                        $("#security_q").slideUp(800);
                        $("#verify-ucheck2").delay(500).toggle(800);
                        $("#change_pass").delay(1200).toggle(800);

                    }
                    else
                    {
                        if(ret === "None")
                        {
                            alert("An error has occured");
                        }
                        else
                        {
                            if(ret === "Failed")
                            {
                                alert("Wrong Answer");
                            }
                            else
                            {
                                alert(ret);
                            }
                        }
                    }

                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }
                

            });
        }
        else
        {
            alert("Invalid Inputs Found:"+invalid);
        }

    });

    //Change password for forgot password
    $("#recover_pass").submit(function(e)
    {
        e.preventDefault();

        var username = document.forms['check_user']['check_uname'].value;
        var email = document.forms['check_user']['check_uemail'].value;
        var new_password = document.forms['recover_pass']['new_pass'].value;
        var conf_password = document.forms['recover_pass']['confirm_new_pass'].value;
        var pass_submit = document.forms['recover_pass']['change_password'].value;

        //Check blank
        if(new_password === "")
        {
            alert("Invalid password: blank. Please enter a valid password");
            return;
        }

        //Check number
        if(!(isNaN(new_password)))
        {
            alert("Invalid password: number. Please enter a valid password");
            return;
        }
    
        //Check if passwords are the same
        if(new_password !== conf_password)
        {
            alert("Passwords do not match ");
            return;
        }
        else
        {
            $.ajax
            ({
                type: "POST",
                url: "recover_password.php",
                data: { new_pass: new_password, change_password: pass_submit, username: username, email: email},
                success: function(ret)
                {
                    if(ret === "success")
                    {
                        $("#recover_pass").slideUp(800);
                        $("#verify-ucheck3").delay(500).toggle(800);
                        $("#redirect_alert").delay(500).toggle(800);
                        setTimeout(function()
                        {
                            window.location.href = 'http://localhost/WebDev2/my_profile.php';
                         }, 3000);
                    }
                    else
                    {
                        if(ret === "None")
                        {
                            alert("An error has occured");
                        }
                        else
                        {
                            if(ret === "fail")
                            {
                                alert("Unable to change password");
                            }
                            else
                            {
                                alert(ret);
                            }
                        }
                    }
                    
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }

            });
            
        }

    });

    //Delete multiple restaurants from favourites page
    $("#del_fav").click(function()
    {
        var multi_resid = [];

        $(":checkbox:checked").each(function(i)
        {
            multi_resid[i] = $(this).val();
        });

        if(multi_resid.length !== 0)
        {
            $.ajax
            ({
                type: "POST",
                url: "remove_from_fav.php",
                data: { multi_resid: multi_resid },
                success: function(ret)
                {
                    if(ret === "success")
                    {
                        for(var i = 0; i < multi_resid.length; i++)
                        {
                            $("tr#"+multi_resid[i]+"").toggle("slow");
                        }
                    }
                    else
                    {
                        alert("Uh Oh! An error has occured: "+ret);
                    }
                },
                error: function(xhr, textStatus, errorThrown)
                {
                    alert("An error as occured: "+textStatus+": "+errorThrown);
                }
            });
        }
        else
        {
            alert("No restaurants selected");
        }

    });

    var myreviewCount = 5;
    //Load more my reviews
    $("#more_reviews").click(function()
    {
        myreviewCount = myreviewCount + 2;

        $("#my-reviews").load("more_my_reviews.php", { myreviewCount : myreviewCount });

    });

});