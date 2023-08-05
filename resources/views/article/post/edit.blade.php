<form id='edit' action=""  method="post" accept-charset="utf-8">
    <div class="row">
        <div class="card-body">
            {{method_field('PATCH')}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        {!! Form::text('title', $data->title, array('placeholder' => 'Title','class' => 'form-control', 'required')) !!}
                        <span id="error_title" class="has-error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Content</label>
                    <div class="col-sm-9">
                        {!! Form::textarea('content', $data->content, [ 'rows' => 4, 'cols' => 54, 'class' => 'form-control']) !!}
                        <span id="error_content" class="has-error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                        {!! Form::text('category', $data->category, array('placeholder' => 'Category','class' => 'form-control', 'required')) !!}
                        <span id="error_category" class="has-error"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        {!! Form::radio('status', 'Publish', $data->status == 'Publish' ? 'true' : null) !!} Publish
                        {!! Form::radio('status', 'Draft', $data->status == 'Draft' ? 'true' : null) !!} Draft
                        <span id="error_status" class="has-error"></span>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {
        $('#loader').hide();
        $('#edit').validate({// <- attach '.validate()' to your form
            // Rules for form validation
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

                var myData      = new FormData($("#edit")[0]);
                var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
                myData.append('_token', CSRF_TOKEN);

                $.ajax({
                    url         : 'article-post/' + '{{ $data->id }}',
                    type        : 'POST',
                    data        : myData,
                    dataType    : 'json',
                    cache       : false,
                    processData : false,
                    contentType: false,
                    beforeSend: function () {
                        $('#loader').show();
                        $("#submit").prop('disabled', true); // disable button
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            swal("Done!", "It was succesfully done!", "success");
                            reload_table();
                            //notify_view(data.type, data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                            $("html, body").animate({scrollTop: 0}, "slow");
                            $('#myModal').modal('hide'); // hide bootstrap modal

                        } else if (data.type === 'error') {
                            if (data.errors) {
                                $.each(data.errors, function (key, val) {
                                    $('#error_' + key).html(val);
                                });
                            }
                            console.log(data.message);
                            $("#status").html(data.message);
                            $('#loader').hide();
                            $("#submit").prop('disabled', false); // disable button
                        }
                    }
                });
            }
            // <- end 'submitHandler' callback
        });                    // <- end '.validate()'

    });
</script>