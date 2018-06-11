<!DOCTYPE html>
<html>
<head>
	<?php include 'general/style-includes.php'; ?>
	<title>Rio's Library</title>
</head>
<body>
<div class="page-container page-navigation-top-fixed">
	<?php $this->load->view('general/sidebar'); ?>
	<?php $this->load->view('general/header'); ?>
	<!-- PAGE TITLE -->
    <br><div class="page-title">                    
        <h2><span class="fa fa-gear"></span> Settings </h2>
    </div>
    <div class="page-content-wrap" style="padding-bottom: 50px;">
    	<div class="row">
	        <div class="col-md-4">
	            <div class="panel-group accordion accordion-dc">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background:#29b2e1;">                                
	                    <h3 class="panel-title" style="color:#fff;"><a href="#setting_genre" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Genre</a></h3>
	                    <ul class="panel-controls">
	                        <li><a href="javascript:void(0)" onclick="add_genre()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Genre"><span class="fa fa-plus"></span></a></li>
	                    </ul>                                
	                </div>
	                <div class="panel-body panel-body-open" id="setting_genre">
	                    <div class="table-responsive">
	                        <table id="genretable" class="table datatable">
	                            <thead>
	                                <tr>
	                                    <th>Genre</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	            </div>
	        </div>
			<div class="col-md-4">
				<div class="panel-group accordion accordion-dc">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background:#29b2e1;">                                
	                    <h3 class="panel-title" style="color:#fff;"><a href="#setting_section" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Section</a></h3>
	                    <ul class="panel-controls">
	                        <li><a href="javascript:void(0)" onclick="add_section()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Library Section"><span class="fa fa-plus"></span></a></li>
	                    </ul>                                
	                </div>
	                <div class="panel-body panel-body-open" id="setting_section">
	                    <div class="table-responsive">
	                        <table id="sectiontable" class="table datatable">
	                            <thead>
	                                <tr>
	                                    <th>Section</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	            </div>
			</div>
			<div class="col-md-4">
				<div class="panel-group accordion accordion-dc">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background:#29b2e1;">                                
	                    <h3 class="panel-title" style="color:#fff;"><a href="#setting_user" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">User</a></h3>
	                    <ul class="panel-controls">
	                        <li><a href="javascript:void(0)" onclick="add_user()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Users"><span class="fa fa-plus"></span></a></li>
	                    </ul>                                
	                </div>
	                <div class="panel-body panel-body-open" id="setting_users">
	                    <div class="table-responsive">
	                        <table id="usertable" class="table datatable">
	                            <thead>
	                                <tr>
	                                    <th>Firstname</th>
	                                    <th>Lastname</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	            </div>
			</div>
		</div>
	</div>
    <!-- END PAGE TITLE --> 
</div>
<!-- Genre MODAL -->        
<div class="modal fade" id="modal_genre" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Genre</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="genreform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="genre_id"/>
                    <label class="control-label">Genre</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="book_genre" type="text" class="form-control" value="" placeholder="Enter Genre"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnGenreSave" onclick="save_genre()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END GENRE MODAL -->

<!-- SECTION MODAL -->        
<div class="modal fade" id="modal_section" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Section</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="sectionform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="sec_id"/>
                    <label class="control-label">Section</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="lib_section" type="text" class="form-control" value="" placeholder="Enter Section"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnSectionSave" onclick="save_section()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION MODAL -->

<!-- USER MODAL -->        
<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">User</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="userform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="login_id"/>
                    <label class="control-label">Firstname</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="firstname" type="text" class="form-control" value="" placeholder="Enter Firstname"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Lastname</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="lastname" type="text" class="form-control" value="" placeholder="Enter lastname"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnUserSave" onclick="save_user()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END USER MODAL -->
<!-- DELETE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this row?</p>                    
                <p>Press Yes if you sure.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END DELETE BOX-->
	<?php $this->load->view('general/admin_logout'); ?>
    <?php $this->load->view('general/script-includes'); ?>
</body>
</html>
<script type="text/javascript">
var	genretable;
var sectiontable;
var usertable;
$(document).ready(function(){

	genretable = $('#genretable').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "lengthMenu": [10, 25, 50],
        "order": [],

        "ajax":{
            "url": "<?php echo site_url('admin_settings/genre_list')?>",
            "type": "POST"
        },

        	"columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
	sectiontable = $('#sectiontable').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "lengthMenu": [10, 25, 50],
        "order": [],

        "ajax":{
            "url": "<?php echo site_url('admin_settings/section_list')?>",
            "type": "POST"
        },

        	"columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
	usertable = $('#usertable').DataTable({
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "lengthMenu": [10, 25, 50],
        "order": [],

        "ajax":{
            "url": "<?php echo site_url('admin_settings/user_list')?>",
            "type": "POST"
        },

        	"columnDefs": [{
            "targets": [-1],
            "orderable": false,
        },],
    });
});

    function add_genre(){
	    save_method = 'add';
	    $('#genreform')[0].reset();
	    $('.form-group').removeClass('has-error');
	    $('.help-block').empty();
	    $('#modal_genre').modal('show');
	    $('.modal-title').text('Add Genre');
    }

    function add_section(){
	    save_method = 'add';
	    $('#sectionform')[0].reset();
	    $('.form-group').removeClass('has-error');
	    $('.help-block').empty();
	    $('#modal_section').modal('show');
	    $('.modal-title').text('Add Section');
    }

    function add_user(){
	    save_method = 'add';
	    $('#userform')[0].reset();
	    $('.form-group').removeClass('has-error');
	    $('.help-block').empty();
	    $('#modal_user').modal('show');
	    $('.modal-title').text('Add Users');
    }


    function edit_book(id){
        save_method = 'update';
        $('#bookform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_dashboard/edit_book')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="book_id"]').val(data.book_id);
                $('[name="book_name"]').val(data.book_name);
                $('[name="author"]').val(data.author);
                $('[name="genre"]').val(data.genre_id);
                $('[name="section"]').val(data.sec_id);
                $('#modal_book').modal('show');
                $('.modal-title').text('Edit Book');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }


    function edit_genre(id){
        save_method = 'update';
        $('#genreform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_settings/edit_genre')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="genre_id"]').val(data.genre_id);
                $('[name="book_genre"]').val(data.book_genre);
                $('#modal_genre').modal('show');
                $('.modal-title').text('Edit Genre');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }


    function edit_section(id){
        save_method = 'update';
        $('#sectionform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_settings/edit_section')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="sec_id"]').val(data.sec_id);
                $('[name="lib_section"]').val(data.lib_section);
                $('#modal_section').modal('show');
                $('.modal-title').text('Edit Section');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }

    function edit_user(id){
        save_method = 'update';
        $('#userform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_settings/edit_user')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="login_id"]').val(data.login_id);
                $('[name="firstname"]').val(data.login_firstname);
                $('[name="lastname"]').val(data.login_lastname);
                $('#modal_user').modal('show');
                $('.modal-title').text('Edit User');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }

    function save_genre(){
        $('#btnGenreSave').text('Saving...');
        $('#btnGenreSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_settings/add_genre')?>";
        } else {
            url = "<?php echo site_url('admin_settings/update_genre')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#genreform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_genre').modal('hide');
                    reload_genre_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnGenreSave').text('Save');
                $('#btnGenreSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update Genre');
                $('#btnGenreSave').text('Save');
                $('#btnGenreSave').attr('disabled', false);
            }
        });
    }

    function save_section(){
        $('#btnSectionSave').text('Saving...');
        $('#btnSectionSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_settings/add_section')?>";
        } else {
            url = "<?php echo site_url('admin_settings/update_section')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#sectionform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_section').modal('hide');
                    reload_section_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnSectionSave').text('Save');
                $('#btnSectionSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update Section');
                $('#btnSectionSave').text('Save');
                $('#btnSectionSave').attr('disabled', false);
            }
        });
    }

    function save_user(){
        $('#btnUserSave').text('Saving...');
        $('#btnUserSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_settings/add_user')?>";
        } else {
            url = "<?php echo site_url('admin_settings/update_user')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#userform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_user').modal('hide');
                    reload_user_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnUserSave').text('Save');
                $('#btnUserSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update User');
                $('#btnUserSave').text('Save');
                $('#btnUserSave').attr('disabled', false);
            }
        });
    }

    function delete_genre(id){
        var box = $("#mb-remove-row");
        box.addClass("open");
    
        box.find(".mb-control-yes").on("click",function(){
            $.ajax({
                url: "<?php echo site_url('admin_settings/delete_genre')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    box.removeClass("open");
                    reload_genre_table();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error deleting Genre');
                }
            });
        });    
    }

    function delete_section(id){
        var box = $("#mb-remove-row");
        box.addClass("open");
    
        box.find(".mb-control-yes").on("click",function(){
            $.ajax({
                url: "<?php echo site_url('admin_settings/delete_section')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    box.removeClass("open");
                    reload_section_table();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error deleting Section');
                }
            });
        });    
    }

    function delete_user(id){
        var box = $("#mb-remove-row");
        box.addClass("open");
    
        box.find(".mb-control-yes").on("click",function(){
            $.ajax({
                url: "<?php echo site_url('admin_settings/delete_user')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    box.removeClass("open");
                    reload_user_table();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error deleting User');
                }
            });
        });    
    }

    function reload_genre_table(){
        genretable.ajax.url("<?php echo site_url('admin_settings/genre_list')?>").load();
    }

    function reload_section_table(){
        sectiontable.ajax.url("<?php echo site_url('admin_settings/section_list')?>").load();
    }

    function reload_user_table(){
        usertable.ajax.url("<?php echo site_url('admin_settings/user_list')?>").load();
    }
</script>