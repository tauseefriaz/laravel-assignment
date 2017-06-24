$(document).ready(function() {
    var cover = $('#cover');
    var comments = {
        /* Displays the comment box and adds the overlay div */
        reply: function(obj) {
            var commentId = $(obj).closest('.comments').attr('comment-id');
            

            var replyMarkup = $('<ul class="comments" id="comment-reply-box"><li class="clearfix"><input type="text" maxlength="29" id="parent_id" class="hide"><div class="form-group"><input type="text" class="form-control" id="user" placeholder="Enter Your Name" required></div><div class="form-group"><textarea type="text" class="form-control" id="comment" placeholder="Enter Your Comment" required></textarea></div><div class="form-group text-right"><span class="warning text-danger"></span><button type="button" class="btn btn-success save">Comment</button> <button type="button" class="btn btn-danger cancel-comment">Close</button></div></li></ul>');
            
            
            if ($.isNumeric(commentId)) {
                $(obj).closest('.comments').append(replyMarkup).slideDown("slow");
                $(replyMarkup).find('#parent_id').val(commentId);
            }else{
                $(obj).closest('.blog-comment').append(replyMarkup).slideDown("slow");
                $(replyMarkup).find('#parent_id').val(0);
            }
            $(cover).css('display', 'block');
            $('html, body').animate({
                scrollTop: $("#comment-reply-box").offset().top - 100
            }, 2000);
        },

        /* Closes the overlay div and comment box */
        close: function(){
            $('#comment-reply-box').remove();
            $(cover).css('display', 'none');
        },

        /* Saves and displays the comment */
        comment: function(obj) {
            $button = obj;

            var inputs = {
                parent_id: $('#comment-reply-box #parent_id').val(),
                name: $('#comment-reply-box #user').val(),
                comment: $('#comment-reply-box #comment').val()
            }

            if (inputs.name.length < 2 || inputs.name.comment < 2) {
                $('.warning').html('Name and Comment field must have at least three characters.').show();
                return false;
            }

            $.ajax({
                url: TMBC.basePath + '/comments/save',
                data: {
                    data: inputs
                },
                method: 'POST',
                type: 'json',
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': TMBC.csrfToken
                },
                success: function(result) {
                    var data = JSON.parse(JSON.stringify(result));
                    var $commentMarkup = $('<ul class="comments"><li class="clearfix"><img src="https://bootdey.com/img/Content/user_3.jpg" class="avatar" alt=""><div class="post-comments"><p class="meta"><span class="comment-date">Dec 20, 2014</span> <b class="comment-name"></b> says <i class="pull-right reply"><a href="# reply"><small>Reply</small></a></i></p><p class="comment-text"></p></div></li></ul>');
                    $($commentMarkup).find('.comment-name').html(data.name);
                    $($commentMarkup).find('.comment-date').html(data.created_at);
                    $($commentMarkup).find('.comment-text').html(data.comment);
                    $($commentMarkup).attr('comment-id', data.id);
                    if (data.count > 2) {
                        $($commentMarkup).find('.reply').remove();
                    }
                    $($button).closest('.comments').replaceWith($commentMarkup);
                    $(cover).css('display', 'none');
                }
            });
        }
    }
    $(document).on("click", ".reply", function() {
        comments.reply(this);
    });

    $(document).on("click", ".save", function() {
        comments.comment(this);
    });

    $(document).on("click", ".cancel-comment", function() {
        comments.close(this);
    });
});