$(document).ready(function(){
    $('input[name=radio-sort]').click(function(){
        var li=$(this).data('item');
        $('.filters label').removeClass("btn-inverse");
        $('#'+li).addClass("btn-inverse");
        if(li=='ff-item-type-all'){
            $('.grid li').show(300);
        } else {
            if($(this).is(':checked')){
                $('.grid li').not('.'+li).hide(300);
                $('.grid li.'+li).show(300);
            }
        }
    });
    $('#full-img').click(function(){
        $('#previewLightbox').lightbox('hide');
    });
    $('.upload-btn').click(function(){
        $('.uploader').show(500);
    });
    $('.close-uploader').click(function(){
        $('.uploader').hide(500);
        window.location.href = $('#refresh').attr('href') + '&' + new Date().getTime();
    });
    $('.preview').click(function(){
        $('#full-img').attr('src',$(this).data('url'));
        if(!$(this).hasClass('disabled')) {
            show_animation();
        }
        return true;
    });

    $('.new-folder').click(function(){
        folder_name=window.prompt($('#insert_folder_name').val(),$('#new_folder').val());
        if(folder_name){
            var path = $('#sub_dir').val();
            folder_path=folder_name;
            $.ajax({
                type: "POST",
                url: "create_folder.php",
                data: {path: path+"/"+folder_path},
                dataType: "json",
                success: function(data) {
                    if(data.status == 'success') {
                        //DO NOTHING
                    } else if(data.status == 'failure') {
                        alert("Error: "+data.reason);
                    }
                },
                error: function() {
                    alert("There was an error. Try again please!");
                }
            }).done(function( msg ) {
                window.location.href = $('#refresh').attr('href') + '&' + new Date().getTime();
            });
        }
    });
    if (!Modernizr.touch) {
        $('#help').hide();
    } else {
        //Enable swiping...
        $(".box").swipe( {
            //Generic swipe handler for all directions
            swipe:function(event, direction, distance, duration, fingerCount) {
                //$(this).parent().toggleClass('cs-hover');
                if ($(this).attr('toggle')==1) {
                    $(this).attr('toggle',0);
                    $(this).animate({top: "0px"} ,{queue:false,duration:300});
                } else {
                    $(this).attr('toggle',1);
                    $(this).animate({top: "-30px"} ,{queue:false,duration:300});
                }
            },
            //Default is 75px, set to 0 for demo so any distance triggers swipe
            threshold:30
        });
    }
    if(!Modernizr.csstransitions) { // Test if CSS transitions are supported
        $('figure').bind('mouseover',function(){
            $(this).find('.box').animate({top: "-30px"} ,{queue:false,duration:300});
        });
        $('figure').mouseout(function(){
            $(this).find('.box').animate({top: "0px"} ,{queue:false,duration:300});
        });
    }
    var boxes = $('.d');
    boxes.height('auto');
    var maxHeight = Math.max.apply(
        Math, boxes.map(function() {
            return $(this).height();
        }).get());
    boxes.height(maxHeight);
});

function getWindowParent() {
    if ($('#popup').val()==1) {
        return window.opener;
    } else {
        return window.parent;
    }
}

function apply(file){
    var window_parent=getWindowParent();
    var path = $('#cur_dir').val();
    var track = $('#track').val();
    var target = window_parent.document.getElementById(track+'_ifr');
    var closed = window_parent.document.getElementsByClassName('mce-filemanager');
    var ext=file.split('.').pop();
    var fill='';
    if($.inArray(ext, ext_img) > -1){
        fill=$("<img />",{"src":path+"/"+file});
    } else {
        fill=$("<a />").attr("href", path+"/"+file).text(file.replace(/\..+$/, ''));
    }
    $(target).contents().find('#tinymce').append(fill);
    $(closed).find('.mce-close').trigger('click');
}

function apply_link(file,type_file,external){
    var window_parent=getWindowParent();
    var path = $('#cur_dir').val();
    var track = $('#track').val();
    console.log('apply_link');
    if (external==="") {
        $('.mce-link_'+track, window_parent.document).val(path+file);
        var closed = window_parent.document.getElementsByClassName('mce-filemanager');
        if($('.mce-text_'+track, window_parent.document).val()=='') {
            $('.mce-text_'+track, window_parent.document).val(file.replace(/\..+$/, ''));
        }
        $(closed).find('.mce-close').trigger('click');
    } else {
        var target = window_parent.document.getElementById(external);
        $(target).val(path+'/'+file);
        close_window();
    }
}

function apply_none(file,type_file,external){
    return false;
}

function apply_img(file,type_file,external){
    var window_parent=getWindowParent();
    var path = $('#cur_dir').val();
    var track = $('#track').val();
    console.log('apply_img');
    if (external=="") {
        var target = window_parent.document.getElementsByClassName('mce-img_'+track);
        var closed = window_parent.document.getElementsByClassName('mce-filemanager');
        $(target).val(path+"/"+file);
        $(closed).find('.mce-close').trigger('click');
    } else {
        var target = window_parent.document.getElementById(external);
        $(target).val(path+"/"+file);
        close_window();
    }
}

function apply_video(file,type_file,external){
    var window_parent=getWindowParent();
    var path = $('#cur_dir').val();
    var track = $('#track').val();

    if (external==="") {
        var target = window_parent.document.getElementsByClassName('mce-video'+ type_file +'_'+track);
        var closed = window_parent.document.getElementsByClassName('mce-filemanager');
        $(target).val(path+"/"+file);
        $(closed).find('.mce-close').trigger('click');
    } else {
        var target = window_parent.document.getElementById(external);
        $(target).val(path+"/"+file);
        close_window();
    }
}

function close_window() {
    if ($('#popup').val()==1) {
        window.close();
    } else {
        console.log('close iframe');
        window.parent.closeModal();
    }
}

function delete_file(file1) {
    $.ajax({
        type: "POST",
        url: "delete_file.php",
        data: {path: file1},
        dataType: "json",
        success: function(data) {
            if(data.status === 'success') {
                //DO NOTHING
            } else if(data.status === 'failure') {
                alert("Error: "+data.reason);
                window.location.href = $('#refresh').attr('href') + '&' + new Date().getTime();
            }
        },
        error: function() {
            alert("There was an error. Try again please!");
        }
    }).done(function( msg ) {});
}


function delete_folder(folder1) {
    $.ajax({
        type: "POST",
        url: "delete_folder.php",
        data: {path: folder1},
        dataType: "json",
        success: function(data) {
            if(data.status === 'success') {
                //DO NOTHING
            } else if(data.status === 'failure') {
                alert("Error: "+data.reason);
                window.location.href = $('#refresh').attr('href') + '&' + new Date().getTime();
            }
        },
        error: function() {
            alert("There was an error. Try again please!");
        }
    }).done(function( msg ) {});
}

function show_animation() {
    $('#loading_container').css('display', 'block');
    $('#loading').css('opacity', '.7');
}

function hide_animation()
{
    $('#loading_container').fadeOut();
}
