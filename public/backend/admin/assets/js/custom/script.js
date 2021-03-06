(function($){

    $(document).ready(function(){


        //Logout System
        $(document).on('click', 'a#logout_id', function (event){
            $('form#logout-form').submit();
        });

        //Text Editor
        CKEDITOR.replace('text_editor');
        CKEDITOR.replace('text_editor_edit');


        //Edit Category System
        $(document).on('click', 'a#edit_category', function (event){
            event.preventDefault();
            let id = $(this).attr('edit_id');

            $.ajax({
                url : 'post-category-edit/' + id,
                dataType : 'json',
                success : function (data){
                    $('#category-edit-modal form input[name="name"]').val(data.name);
                    $('#category-edit-modal form input[name="id"]').val(data.id);
                }
            });
        });

        //Edit Post Tag
        $(document).on('click', 'a#edit_tag', function(event){
            event.preventDefault();
            let id = $(this).attr('edit_id');

            $.ajax({
                url : 'post-tag-edit/' + id,
                dataType: 'json',
                success : function(data){
                    $('#tag-edit-modal input[name="name"]').val(data.name);
                    $('#tag-edit-modal input[name="id"]').val(data.id);
                }
            });
        });

        //Photo Upload And Show Form
        $(document).on('change', 'input#f_image', function(event){
            event.preventDefault();
            let post_image_url = URL.createObjectURL(event.target.files[0]);
            $('img#post_featured_image_load').attr('src', post_image_url);
            $('label#label_img').css('display', 'none');
        });

        //Post Edit
        $(document).on('click', '#edit_post', function(event){
            event.preventDefault();
            //Get Edit ID
            let edit_id = $(this).attr('edit_id');

            $.ajax({
                url : 'post-edit/'+edit_id,
                success : function(data){
                    $('#post_modal_edit input[name="title"]').val(data.title);
                    $('#post_modal_edit img#post_featured_image_load').attr('src', 'media/posts/' +data.image)
                    $('#post_modal_edit div.cl').html(data.cat_list);
                }
            });

            $('#post_modal_edit').modal('show');
        });




    });



})(jQuery)
