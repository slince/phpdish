webpackJsonp([14],{0:function(e,r){e.exports=window.$},2:function(e,r){e.exports=window._},41:function(e,r,a){"use strict";(function(e){a(1),a(4),function(){e("#login-form").validate({errorClass:"error-message",errorPlacement:function(r,a){e(a).parent().before(r)},rules:{username:{required:!0},pwd:{required:!0}},messages:{username:{required:"请输入用户名"},pwd:{required:"请输入密码!"}}})}(),function(){e("#register-form").validate({errorClass:"error-message",errorPlacement:function(r,a){"checkbox"==e(a).attr("type")?e("#for_policy").append(r):r.insertAfter(e(a).prev())},rules:{username:{required:!0},pwd:{required:!0,rangelength:[6,15]},repassword:{required:!0,equalTo:"#password",rangelength:[6,15]},agree_policy:{required:!0}},messages:{username:{required:"请输入用户名"},pwd:{required:"请输入密码!",rangelength:"密码在6到15位之间"},repassword:{required:"请重复密码!",equalTo:"重复密码不一致",rangelength:"密码在6到15位之间"},agree_policy:{required:"请先同意条款!"}}})}(),function(){e("#forgot-form").validate({errorClass:"error-message",errorPlacement:function(r,a){r.insertAfter(e(a).prev())},rules:{email:{required:!0,email:!0},captcha:{required:!0}},messages:{email:{required:"请输入账号绑定的邮箱",email:"邮箱格式错误"},captcha:{required:"请输入验证码"}}})}(),function(){e("#resetting-form").validate({errorClass:"error-message",errorPlacement:function(r,a){r.insertAfter(e(a).prev())},rules:{password:{required:!0,rangelength:[6,15]},repassword:{required:!0,equalTo:"#password",rangelength:[6,15]},code:{required:!0}},messages:{password:{required:"请输入新密码!",rangelength:"密码在6到15位之间"},repassword:{required:"请重复新密码!",equalTo:"重复密码不一致",rangelength:"密码在6到15位之间"},code:{required:"请输入验证码"}}})}(),function(e){e("#bind-register-form").validate({errorClass:"error-message",errorPlacement:function(r,a){e("#for_new_"+e(a).attr("name")).append(r)},rules:{username:{required:!0},agree_policy:{required:!0}},messages:{username:{required:"请输入用户名"},agree_policy:{required:"请先同意条款!"}}}),e("#bind-login-form").validate({errorClass:"error-message",errorPlacement:function(r,a){e("#for_"+e(a).attr("name")).append(r)},rules:{username:{required:!0},pwd:{required:!0}},messages:{username:{required:"请输入用户名"},pwd:{required:"请输入密码!"}}})}(e)}).call(r,a(0))}},[41]);