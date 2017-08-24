// ------------------------ General Functions ------------------------

// Ajax customized function
function executeAjax(method, url, data) {
    $.ajax({
        method: method,
        url: url,
        data: data,
        dataType: 'json',
        success: function (msg) {
            console.log(msg);
        },
        error: function () {
            console.log('error');
        }
    });
}

// Load an image from input type file temporarily to display in HTML
function loadImage(input, displayElement) {
    var inputFile = document.getElementById(input);
    
    var file = inputFile.files[0];
    
    var imgType = 'image/*';
    var vidType = 'video/*';
    
    if(file.type.match(imgType) || file.type.match(vidType)) {
        var content = '';
        var idDivFile = 0;

        if($('#files-upload-box').is(':empty')){
            idDivFile = 1;
        } else {
            $('#files-upload-box').find("> *").each(function() {
                var id = $(this).attr("post-file-id");

                idDivFile = id;
            });

            idDivFile++;
        }
        
        content += '<div post-file-id="' + idDivFile + '" class="file-to-upload">';
        content += '    <div id="remove' + idDivFile + '" class="file-remove-btn">';
        content += '        <i class="fa fa-trash-o" aria-hidden="true"></i>';
        content += '    </div>';
        content += '</div>';

        $('#'+displayElement).append(content);
        
        var contentDisplay = $("[post-file-id='" + idDivFile + "']");
        
        var oReader = new FileReader();
        
        oReader.onload = function() {
            var img = new Image();

            img.src = oReader.result;
            img.id = 'post-file-' + idDivFile;
            
            contentDisplay.append(img);
        };
        
        oReader.readAsDataURL(file);
        
        // Enable the Create Post Button
        $('#create_post_btn').removeClass('btn-disabled');
        
        // Change the img-vid-upload-field component
        $('.img-vid-upload-field').css('display', 'inline-block');
    }
}

// ------------------------ End General Functions ------------------------

// ------------------------ Files Upload Function ------------------------

$(document).on('click', '.browse', function() {
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
});
$(document).on('change', '.file', function() {
    // Load the image to be upload temporarily and display above the options field
    loadImage('img_upload', 'files-upload-box');
});

// ------------------------ End Files Upload Function ------------------------

// ------------------------ Remove Upload File Function ------------------------

$(document).on('click', '.file-remove-btn', function() {
    var parentDiv = $(this).parent();

    parentDiv.remove();
    
    var textContent = $('#post-text-content').text();
    var fileBox = $('#files-upload-box').html();
    
    // Clean the input files
    if(fileBox === '') {
        var input = $("#img_upload");

        input.replaceWith(input.val('').clone(true));
    }
    
    // Verify and disable the create post button if all fields are empty
    if(fileBox === '') {
        $('.img-vid-upload-field').css('display', 'none');
        
        if(textContent.trim() !== '') {
            $('#create_post_btn').removeClass('btn-disabled');
        } else {
            $('#create_post_btn').addClass('btn-disabled');
        }
    }
});

// ------------------------ End Remove Upload File Function ------------------------

// ------------------------ Create Post/Live Options Function ------------------------

/* 
 * The create post option shall be always set by default when the page is loaded
 */
$(document).ready(function() {
    $('#btn-create-post').css({"background-color":"#1DA1F2"});
});

$(document).ready(function() {
    $("#btn-create-post").on({
        mouseover: function() {
            $(this).css("background-color", "#1DA1F2");
        },
        mouseleave: function() {
            if($('#btn-live-video').attr("data-btn-select") === 'true') {
                $(this).css("background-color", "transparent");
            }
        },
        click: function() {
            if($('.post-create-field').attr('hidden') !== 'undefined') {
                $('.post-create-field').removeClass('hidden');
            }
            if($('.live-option-field').attr('hidden') !== 'undefined') {
                $('.live-option-field').addClass('hidden');
            }
            if($(this).attr('data-btn-select') === 'false') {
                $(this).attr('data-btn-select', 'true');
                $('#btn-live-video').attr('data-btn-select', 'false');
                $(this).css({"background-color":"#1DA1F2"});
            }
            if($('#btn-live-video').attr('data-btn-select') === 'false') {
                $('#btn-live-video').css({"background-color":"transparent"});
            }
        }
    });

    $("#btn-live-video").on({
        mouseover: function() {
            $(this).css("background-color", "#1DA1F2");
        },
        mouseleave: function() {
            if($('#btn-create-post').attr("data-btn-select") === 'true') {
                $(this).css("background-color", "transparent");
            }
        },
        click: function() {
            if($('.live-video-field').attr('hidden') !== 'undefined') {
                $('.live-video-field').removeClass('hidden');
            }
            if($('.post-create-field').attr('hidden') !== 'undefined') {
                $('.post-create-field').addClass('hidden');
            }
            if($(this).attr('data-btn-select') === 'false') {
                $(this).attr('data-btn-select', 'true');
                $('#btn-create-post').attr('data-btn-select', 'false');
                $(this).css({"background-color":"#1DA1F2"});
            }
            if($('#btn-create-post').attr('data-btn-select') === 'false') {
                $('#btn-create-post').css({"background-color":"transparent"});
            }
        }
    });
});

// ------------------------ End Create Post/Live Options Function ------------------------

// ------------------------ Posts Likes Function ------------------------

$(document).ready(function() {
    $('[name=like_button]').click(function() {
        // Get the post id by slicing the tag id attribute
        post = $(this).attr('id');
        post_id = post.slice(7);
        
        executeAjax('POST', 'ajax_store_like', {user_id: us_id, post_id: post_id, _token: token});
    });
});

// ------------------------ End Posts Likes Function ------------------------

// ------------------------ Create Post Function ------------------------

$(document).ready(function() {
    $('#create_post_btn').click(function() {
        if($.trim($('#post-text-content').text()) !== '' || $('#files-upload-box').html() !== '') {
            var content = $('#post-text-content').text();
            var images = new Array();
            var videos = new Array();
            
            /*
             * Go through the files upload area's chidren divs to get the files
             * contents which contains their source 
             */
            $('.file-to-upload > img').each(function () {
                $(this).each(function() {
                    images.push($(this).attr('src'));
                });
            });
            
            images = JSON.stringify(images);
            videos = JSON.stringify(videos);
            
            executeAjax('POST', 'ajax_create_post', {data_text: content, data_img: images, data_vid: videos, _token: token});
            
            // Clean the create post fields
            $('#post-text-content').html('');
            $('#files-upload-box').children().each(function(){
                $(this).remove() ;
            });
            $('#files-upload-box').css('display', 'none');
        }
    });
});

// ------------------------ End Create Post Function ------------------------

// ------------------------ Create Post Button Enable/Disable Function ------------------------

$(document).ready(function() {
    $('#post-text-content').keyup(function() {
        if($.trim($(this).text()) !== '') {
            $('#create_post_btn').removeClass('btn-disabled');
        } else {
            $('#create_post_btn').addClass('btn-disabled');
        }
    });
    
    $('#post-text-content').keydown(function() {
        if($.trim($(this).text()) !== '') {
            $('#create_post_btn').removeClass('btn-disabled');
        } else {
            $('#create_post_btn').addClass('btn-disabled');
        }
    });
    
    $('#post-text-content').blur(function() {
        if($.trim($(this).text()) !== '') {
            $('#create_post_btn').removeClass('btn-disabled');
        } else {
            $('#create_post_btn').addClass('btn-disabled');
        }
    });
});

// ------------------------ End Create Post Button Enable/Disable Function ------------------------

// ------------------------ Open/Close Post File Function ------------------------

$('document').ready(function () {
    $('.post-content-midia').click(function () {
        var src = $(this).attr('data-file-asset');

        $('body').css('overflow', 'hidden');
        $('.post-content-midia-container').css('display', 'flex');
        $('.post-content-midia-img').attr('src', src);
    });
    
    $('.post-content-midia-close-btn').click(function () {
        $("body").css('overflow-y', 'scroll');
        $(".post-content-midia-container").css('display', 'none');
    });

    $('.post-content-midia-close-area').click(function () {
        $("body").css('overflow-y', 'scroll');
        $(".post-content-midia-container").css('display', 'none');
    });
});

// ------------------------ End Open/Close Post File Function ------------------------