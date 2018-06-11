<!DOCTYPE html>
<html>
<head>
	<title>Rio's Library</title>
	<?php include 'general/style-includes.php'; ?>
</head>
<body>
<div class="page-container page-navigation-top-fixed">
	<?php $this->load->view('general/sidebar'); ?>
	<?php $this->load->view('general/header'); ?>
            <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url().'admin_dashboard';?>">Home</a></li>
        <li class="active">List of Books</li>
    </ul>
    <!-- END BREADCRUMB -->                                                
    
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-book"></span> List of Books </h2>
    </div>
    <!-- END PAGE TITLE --> 
<div class="page-content-wrap" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-3">
            <!-- START SEARCH FILTERS -->
            <div class="panel panel-default" >
                <div class="panel-heading" style="background:#29b2e1;">
                    <h3 class="panel-title" style="color:#fff;">Search Filters</h3>
                    <ul class="panel-controls">
                        <li><a href="javascript:void(0)" id="clear_filters" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to clear filters"><span class="fa fa-eraser"></span></a></li>
                    </ul> 
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-md-12"><p>Book name</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_book filters" data-live-search="true" id="b_name" data-size = "5">
                                <option value=""></option>
                                <?php foreach ($book as $b): ?>
                                <option value="<?php echo $b->book_id; ?>"><?php echo $b->book_name; ?></option>
                            	<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><p>Author</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_author filters" data-live-search="true" id="b_author" data-size = "5">
                            	<option value=""></option>
                            	<?php foreach ($author as $a):?>
                                <option value="<?php echo $a->book_id; ?>"><?php echo $a->author; ?></option>
                            	<?php endforeach; ?>
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-12"><p>Genre</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_genre filters" data-live-search="true" id="b_genre" data-size = "5">
                                <option value=""></option>
                            	<?php foreach ($genre as $g): ?>
                                <option value="<?php echo $g->genre_id; ?>"><?php echo $g->book_genre; ?></option>
                      			<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><p>Section</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_section filters" data-live-search="true" id="b_section" data-size = "5">
                            	<option value=""></option>
                            	<?php foreach ($section as $s): ?>
                                <option value="<?php echo $s->sec_id; ?>"><?php echo $s->lib_section; ?></option>
                      			<?php endforeach; ?>
                            </select>
                        </div>
                    </div>          
                    </form>
                </div>                            
            </div>
            <!-- END SEARCH FILTERS -->
        </div>
        <div class="col-md-9">
            <div class="panel-group accordion accordion-dc">
            <div class="panel panel-default">
                <div class="panel-heading" style="background:#29b2e1;">                                
                    <h3 class="panel-title" style="color:#fff;"><a href="#setting_book" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Books</a></h3>
                    <ul class="panel-controls">
                        <li><a href="javascript:void(0)" onclick="add_book()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Books"><span class="fa fa-plus"></span></a></li>
                        <li><a href="javascript:void(0)" onclick="reload_book_table()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>                                
                </div>
                <div class="panel-body panel-body-open" id="setting_book">
                    <div class="table-responsive">
                        <table id="booktable" class="table datatable">
                            <thead>
                                <tr>
                                    <th>Book name</th>
                                    <th>Author</th>
                                    <th>Genre</th>
                                    <th>Section</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>               
</div>      
<!-- END PAGE CONTENT -->

<!-- BOOK MODAL -->        
<div class="modal fade" id="modal_book" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Book</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="bookform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="book_id"/>
                    <label class="control-label">Book name</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="book_name" type="text" class="form-control" value="" placeholder="Enter Book"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Author</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="author" type="text" class="form-control" value="" placeholder="Author"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Genre</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="genre" class="form-control" data-size="5">
                                <option value="">Choose Genre</option>
                                <?php foreach ($genre as $g): ?>
                                <option value="<?php echo $g->genre_id; ?>"><?php echo $g->book_genre; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
					<label class="control-label">Section</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="section" class="form-control" data-size="5">
                                <option value="">Choose Library Section</option>
                                <?php foreach ($section as $s): ?>
                                <option value="<?php echo $s->sec_id; ?>"><?php echo $s->lib_section; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Status</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="status" class="form-control" data-size="5">
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnBookSave" onclick="save_book()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END BOOK MODAL -->
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
	var booktable;
	$(document).ready(function(){

		booktable = $('#booktable').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [10, 25, 50],
            "order": [],

            "ajax":{
                "url": "<?php echo site_url('admin_dashboard/book_list')?>",
                "type": "POST"
            },

            	"columnDefs": [{
                "targets": [-1],
                "orderable": false,
            },],
        });

	    $('#b_name').on('change', function () {
	        booktable.columns(0).search(this.value).draw();
	    });

	    $('#b_author').on('change', function () {
	        booktable.columns(0).search(this.value).draw();
	    });
	    $('#b_genre').on('change', function () {
	        booktable.columns(2).search(this.value).draw();
	    });
	    $('#b_section').on('change', function () {
	        booktable.columns(3).search(this.value).draw();
	    });
	});

    function add_book(){
	    save_method = 'add';
	    $('#bookform')[0].reset();
	    $('.form-group').removeClass('has-error');
	    $('.help-block').empty();
	    $('#modal_book').modal('show');
	    $('.modal-title').text('Add Book');
    }

    function reload_book_table(){
        booktable.ajax.url("<?php echo site_url('admin_dashboard/book_list')?>").load();
    }

    function save_book(){
        $('#btnBookSave').text('Saving...');
        $('#btnBookSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_dashboard/add_book')?>";
        } else {
            url = "<?php echo site_url('admin_dashboard/update_book')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#bookform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_book').modal('hide');
                    reload_book_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnBookSave').text('Save');
                $('#btnBookSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error adding / update Book');
                $('#btnBookSave').text('Save');
                $('#btnBookSave').attr('disabled', false);
            }
        });
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
                $('[name="status	"]').val(data.status);
                $('#modal_book').modal('show');
                $('.modal-title').text('Edit Book');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }


    function delete_book(id){
        var box = $("#mb-remove-row");
        box.addClass("open");
    
        box.find(".mb-control-yes").on("click",function(){
            $.ajax({
                url: "<?php echo site_url('admin_dashboard/delete_book')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    box.removeClass("open");
                    reload_book_table();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error deleting book');
                }
            });
        });    
    }

        $('#clear_filters').click(function(){
            $('.filters').each(function(){
                if($(this).attr('id') == 'b_name'){
                    $(this).val('').trigger('change');
                }
                if($(this).attr('id') == 'b_author'){
                    $(this).val('').trigger('change');
                }
                if($(this).attr('id') == 'b_genre'){
                    $(this).val('').trigger('change');
                }
                if($(this).attr('id') == 'b_section'){
                    $(this).val('').trigger('change');
                }
            });
        });
</script>