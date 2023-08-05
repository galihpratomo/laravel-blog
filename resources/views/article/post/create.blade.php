{!! Form::open(array('method'=>'POST',  'id'=>'create')) !!}
<div class="row">
    <div id="status"></div>
    <div class="card-body">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Title</label>
                <div class="col-sm-9">
                    {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control', 'required')) !!}
                    <span id="error_title" class="has-error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Content</label>
                <div class="col-sm-9">
                    {!! Form::textarea('content', null, [ 'rows' => 4, 'cols' => 54, 'class' => 'form-control']) !!}
                    <span id="error_content" class="has-error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Category</label>
                <div class="col-sm-9">
                    {!! Form::text('category', null, array('placeholder' => 'Category','class' => 'form-control', 'required')) !!}
                    <span id="error_category" class="has-error"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    {!! Form::radio('status', 'Publish', null) !!} Publish
                    {!! Form::radio('status', 'Draft', null) !!} Draft
                    <span id="error_status" class="has-error"></span>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>  
</div>
{!! Form::close() !!}
                                        

<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#create').validate({
            rules: {
                title: {
                    required: true,
                    minlength:20
                },
                content: {
                    required: true,
                    minlength:200
                },
                category: {
                    required: true,
                    minlength:3
                },
                status: {
                    required: true,
                }
            },
            
            submitHandler: function (form) {

                    var myData      = new FormData($("#create")[0]);
                    var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
                    myData.append('_token', CSRF_TOKEN);

                    swal({
                        title   : "Post",
                        text    : "Apakah Anda yakin menyimpan data ini ?",
                        type    : "warning",
                        showCancelButton    : true,
                        closeOnConfirm      : false,
                        showLoaderOnConfirm : true,
                        confirmButtonClass  : "btn-danger",
                        confirmButtonText   : "Yes, Assign!"
                    })
                    .then((result) => {

                        $.ajax({
                            url : 'article-post',
                            type: 'POST',
                            data: myData,
                            dataType    : 'json',
                            cache       : false,
                            processData : false,
                            contentType : false,
                            beforeSend  : function () {
                                $('#loader').show();
                                $("#submit").prop('disabled', true); 
                            },
                            success: function (data) {

                                if (data.type === 'success') {
                                    swal("Done!", "It was succesfully done!", "success");
                                    reload_table();
                                    //notify_view(data.type, data.message);
                                    $('#loader').hide();
                                    $("#submit").prop('disabled', false); 
                                    $("html, body").animate({scrollTop: 0}, "slow");
                                    $('#myModal').modal('hide'); 

                                } else if (data.type === 'error') {
                                    if (data.errors) {
                                        $.each(data.errors, function (key, val) {
                                            $('#error_' + key).html(val);
                                        });
                                    }
                                    $("#status").html(data.message);
                                    $('#loader').hide();
                                    $("#submit").prop('disabled', false);
                                    swal("Error sending!", "Please try again", "error");

                                }

                            }
                        });
                    });

            }
            
        });                    

    });
</script>