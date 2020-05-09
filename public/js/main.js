
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).addClass('active');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).removeClass('active');
            showPass = 0;
        }
        
    });

    /** Image Preview */
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            $('#blah').attr('style','transform:scale(1); opacity:1;');
          }
          
          reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function() {
        readURL(this);
    });

    /**Dialog Init */
    /**
     *  init close button 
     */
    $(function () {
        $("#btnClosePopup").click(function () {            
            $("#exampleModalCenter").modal("hide");
        });
    });
    
    /**
     * init save button
     */
    $(function () {
        $("#btnSavePopup").click(function () {
            $("#exampleModalCenter").modal("hide");                        
        });
       
    });   
    
  
    
    

})(jQuery);

$(document).ready(function () {
    
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
    
});

function deleteItem(id){    
    $.ajax({
        url: '/api/v1/news/'+id,
        type: 'DELETE',        
        success: function(){
            window.location.reload();
        }
    });
 }   
 

/**
* init add button
*/

 function onAddClick(){
    $('#title-text').val('');
    $('#content-text').val('');
    $('#imgInp').val('');
    $('#blah').attr('src','../images/folderIcon.png');            
    $('#blah').attr('style','transform:scale(0.5); opacity:0.6;');
    
 }

 function editItem(item){
    $('#modalTitle').val('News-'+item.id);
    $('#title-text').val(item.title);
    $('#content-text').val(item.content);
    //$('#imgInp').val('');
    $('#blah').attr('src','/uploads/'+item.poster_url);            
    $('#blah').attr('style','transform:scale(1); opacity:1;');     
    $("#exampleModalCenter").modal("show");                        
 }
 
 