<div class="wrapper wrapper-content animated fadeInRight">    
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">    
    
    <div class="ibox-content">
        <div class="row">
            <div id="edit_data"></div>
            <div id="add_data">
                <div class="col-sm-12 b-r"> 
                <h2>Change Password</h2><br>                   
                    <form role="form" id="validation_data" action="<?=base_url('admin/changepassword')?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                 <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="form-control validate[required]" data-errormessage-value-missing="Current password is required" data-prompt-position="bottomLeft" placeholder="************" value="<?= $current_pass ?>">

                                <i class="fa fa-eye-slash showicon2" onclick="toggleShowPassword()" id="showicon" style="cursor: pointer;"></i>
                                
                            </div> 
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" name="password" id="password" onkeyup="char_check()" class="form-control validate[required]"  maxlength="20" data-errormessage-value-missing="New password is required" data-prompt-position="bottomLeft" placeholder="Type new password">
                                <span style="display: none;" id="show_error_msg" class="same_error_msg">Can't use old password!</span>
                                <span id="show_pass" class="show_error arrow_error" style="display: none"></span>
                                <span id="show_pass1" class="show_error arrow_error1" style="display: none"></span>
                                

                                <i class="fa fa-eye-slash showicon" onclick="toggleShowNewPassword()" id="showicon1" style="cursor: pointer;"></i>
                              
                            </div>
                            <div class="form-group">
                                <label>Confirm password</label>
                                <input type="password" id="password-confirm" name="confrim_password" class="form-control validate[required,equals[password]]" data-errormessage-value-missing="Confirm new password is required" data-prompt-position="bottomLeft" placeholder="Type Confirm new password">
                                <!-- <img src="https://pluspng.com/img-png/hidden-png-eye-hidden-invisible-off-icon-512.png" alt="" class="showicon1" onclick="toggleShowPasswordConfirm()" id="showicon_confirm" style="cursor: pointer;"> -->

                                <i class="fa fa-eye-slash showicon1" onclick="toggleShowPasswordConfirm()" id="showicon2" style="cursor: pointer;"></i>
                            </div>
                            </div> 
                            <div class="col-lg-6">
                              
                            </div>   
                        </div><br><br><br>
                        <div class="col-sm-12">                    
                            <button class="btn btn-warning btn-primary pull-right m-t-n-xs grediant-btn" type="reset"><strong>Cancel</strong></button>                                                            
                            <button class="btn btn-primary pull-right m-t-n-xs grediant-btn"  type="submit" style="margin-right: 6px;" id="change_password"><strong>Save</strong></button>
                        </div>
                        
                    </form>
                </div>                            
        </div>

        </div>    

</div>
 </div>
</div>
</div>
</div>
<style type="text/css">
        .showicon {
                height: 20px;
                position: absolute;
                top: 102px;
                right: 19px;
                font-size: 20px;
            }
            .showicon1 {
                height: 20px;
                position: absolute;
                top: 174px;
                right: 19px;
                font-size: 20px;
            }
            .showicon2 {
                height: 20px;
                position: absolute;
                top: 33px;
                right: 22px;
                font-size: 20px;
            }
        .show_error {
        position: absolute;
        top: 128px !important; 
        width: auto !important;
        left: 16px !important;
        z-index: 11 !important;
        text-transform: none !important;
        background-color: #f2dede !important;
        color: #a94442!important;
        padding: 3px 10px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border-radius: 0px !important;        
    }
    .arrow_error:after {
        content: '';
        position: absolute !important;
        bottom: 32px !important;
        left: 28px !important;
        width: 0 !important;
        height: 0 !important;
        border: 8px solid transparent !important;
        border-top-color: #f2dede!important;
        border-bottom: 0 !important;
        margin-bottom: -9px !important;
        transform: rotate(180deg) !important;
    }
    .arrow_error1:after {
        content: '';
        position: absolute !important;
        bottom: 33px !important;
        left: 28px !important;
        width: 0 !important;
        height: 0 !important;
        border: 8px solid transparent !important;
        border-top-color: #f2dede!important;
        border-bottom: 0 !important;
        margin-bottom: -9px !important;
        transform: rotate(180deg) !important;
    }
    .same_error_msg{
       position: absolute;
        top: 128px !important; 
        width: auto !important;
        left: 16px !important;
        z-index: 11 !important;
        text-transform: none !important;
        background-color: #f2dede !important;
        color: #a94442!important;
        padding: 3px 10px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border-radius: 0px !important;        
    }
    .same_error_msg:after {
        content: '';
        position: absolute !important;
        bottom: 32px !important;
        left: 28px !important;
        width: 0 !important;
        height: 0 !important;
        border: 8px solid transparent !important;
        border-top-color: #f2dede!important;
        border-bottom: 0 !important;
        margin-bottom: -9px !important;
        transform: rotate(180deg) !important;
    }
     
    </style>
    <script type="text/javascript">

        function toggleShowPassword(){
        var x = document.getElementById("current_password");
        var imgsrc = document.getElementById("showicon");
        if (x.type === "password") {
            
            $('#showicon').removeClass('fa fa-eye-slash');
            $('#showicon').addClass('fa fa-eye');
            x.type = "text";                    
        } else {
           
            
            $('#showicon').removeClass('fa fa-eye');
            $('#showicon').addClass('fa fa-eye-slash');
            x.type = "password";                    
        }
    }

    
    function toggleShowNewPassword(){
        var x = document.getElementById("password");
        var imgsrc = document.getElementById("password");
        if (x.type === "password") {
             $('#showicon1').removeClass('fa fa-eye-slash');
            $('#showicon1').addClass('fa fa-eye');
            x.type = "text";                    
        } else {
           $('#showicon1').removeClass('fa fa-eye');
            $('#showicon1').addClass('fa fa-eye-slash');
            x.type = "password";                    
        }
    }
    
      function blank_check() {
        var pass_val=$('#password').val();
        if(pass_val==''){
            $('#show_pass').text('Password is required');
            $("#password").removeClass('success_cls');
            $("#password").addClass('error_cls');
            $('#show_pass').show('');   
        }
    }
     function toggleShowPasswordConfirm(){
        var x = document.getElementById("password-confirm");
        var imgsrc = document.getElementById("showicon2");
        if (x.type === "password") {
           $('#showicon2').removeClass('fa fa-eye-slash');
            $('#showicon2').addClass('fa fa-eye');
            x.type = "text";                    
        } else {
           $('#showicon2').removeClass('fa fa-eye');
            $('#showicon2').addClass('fa fa-eye-slash');
            x.type = "password";                    
        }
    }



</script>