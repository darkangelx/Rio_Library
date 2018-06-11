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
    
    <!-- PAGE TITLE -->
    <br><div class="page-title">                    
        <h2><span class="fa fa-exchange"></span> Transaction </h2>
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
                        <div class="col-md-12"><p>Name</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_user filters" data-live-search="true" id="u_name" data-size = "5">
                                <option value=""></option>
                                <?php foreach($user as $u):?>
                                <option value="<?php echo $u->login_id; ?>"><?php echo $u->login_firstname. " " . $u->login_lastname; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12"><p>Book name</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_book filters" data-live-search="true" id="b_name" data-size = "5">
                            	<option value=""></option>
                                <?php foreach ($book1 as $b):?>
                                <option value="<?php echo $b->book_id; ?>"><?php echo $b->book_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-md-12"><p>Status</p></div>
                        <div class="col-md-12">
                            <select class="form-control select preferred_status filters" data-live-search="true" id="b_status" data-size = "5">
                                <option value=""></option>
                                <option value="0">Borrowed</option>
                                <option value="1">Return</option>
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
                    <h3 class="panel-title" style="color:#fff;"><a href="#setting_transaction" data-toggle="tooltip" data-placement="right" title="Click to show/hide this panel">Transaction</a></h3>
                    <ul class="panel-controls">
                        <li><a href="javascript:void(0)" onclick="add_transaction()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to add Transaction"><span class="fa fa-plus"></span></a></li>
                        <li><a href="javascript:void(0)" onclick="reload_transaction_table()" class="control-default" data-toggle="tooltip" data-placement="left" title="Click to refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>                                
                </div>
                <div class="panel-body panel-body-open" id="setting_transaction">
                    <div class="table-responsive">
                        <table id="transactiontable" class="table datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First name</th>
                                    <th>Book name</th>
                                    <th>Date Borrowed</th>
                                    <th>Date Return</th>
                                    <th>Date Transaction</th>
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

<!-- TRANSACTION MODAL -->        
<div class="modal fade" id="modal_transaction" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Transaction</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="transactionform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="transaction_id"/>
                    <label class="control-label">Select User</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="user_id" class="form-control" data-size="5" data-live-search="true">
                                <?php foreach ($user as $u): ?>
                                <option value="<?php echo $u->login_id; ?>"><?php echo $u->login_firstname. " " . $u->login_lastname; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Select Book</label>
                   <div class="form-group">
                        <div class="col-md-12">
                            <select name="book_id" class="form-control" data-size="5" data-live-search="true">
                                <?php foreach ($book as $b): ?>
                                <option value="<?php echo $b->book_id; ?>"><?php echo $b->book_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Date Return</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" name="d_return" id="dp-3" class="form-control" value="2018-06-10" data-date="2018-06-10" data-date-format="yyyy-mm-dd" data-date-viewmode="years"/>
                                <span class="input-group-addon" style="background:#29b2e1;"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>  
                    </div>
                    <label class="control-label">Status</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="status" class="form-control" data-size="5">
                                <option value="0">Borrowed</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnTransactionSave" onclick="save_transaction()" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END TRANSACTION MODAL -->

<!-- UPDATE MODAL -->        
<div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background:#29b2e1;">
            <div class="modal-header" style="background:#29b2e1;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color:#fff;">Update Transaction</h4>
            </div>
            <div class="modal-body form" style="background:#fff;">
                <form action="#" id="updateform" class="form-horizontal" role="form">
                    <input type="hidden" value="" name="transaction_id"/>
                    <input type="hidden" value="" name="book_id"/>
                    <label class="control-label">User</label>
                   <div class="form-group">
                        <div class="col-md-12">
                            <input name="user_id" type="text" class="form-control" value="" disabled="disabled"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <label class="control-label">Status</label>
                    <div class="form-group">
                        <div class="col-md-12">
                            <select name="status" class="form-control" data-size="5">
                                <option value="1">Return</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background:#29b2e1;">
                <button type="button" id="btnUpdate" onclick="update_transaction()" class="btn btn-success">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- END UPDATE MODAL -->
    <?php $this->load->view('general/admin_logout'); ?>
    <?php $this->load->view('general/script-includes'); ?>
</body>
</html>

<script type="text/javascript">
    var transactiontable;
    $(document).ready(function(){

        transactiontable = $('#transactiontable').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "lengthMenu": [10, 25, 50],
            "order": [],

            "ajax":{
                "url": "<?php echo site_url('admin_transaction/transaction_list')?>",
                "type": "POST"
            },

                "columnDefs": [{
                "targets": [-1],
                "orderable": false,
            },],
        });

        $('#u_name').on('change', function () {
            transactiontable.columns(1).search(this.value).draw();
        });

        $('#b_name').on('change', function () {
            transactiontable.columns(2).search(this.value).draw();
        });
        $('#b_status').on('change', function () {
            transactiontable.columns(6).search(this.value).draw();
        });

    });

    function reload_transaction_table(){
        transactiontable.ajax.url("<?php echo site_url('admin_transaction/transaction_list')?>").load();
    }

    function add_transaction(){
        save_method = 'add';
        $('#transactionform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal_transaction').modal('show');
        $('.modal-title').text('Add Transaction');
    }

    function save_transaction(){
        $('#btnTransactionSave').text('Saving...');
        $('#btnTransactionSave').attr('disabled', true);
        var url;

        if(save_method == 'add'){
            url = "<?php echo site_url('admin_transaction/add_transaction')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#transactionform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_transaction').modal('hide');
                    reload_transaction_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnTransactionSave').text('Save');
                $('#btnTransactionSave').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error Adding Transaction');
                $('#btnTransactionSave').text('Save');
                $('#btnTransactionSave').attr('disabled', false);
            }
        });
    }

    function update_transaction(){
        $('#btnUpdate').text('Saving...');
        $('#btnUpdate').attr('disabled', true);
        var url;

        if(save_method == 'update'){
            url = "<?php echo site_url('admin_transaction/update_transaction')?>";
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#updateform').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    $('#modal_update').modal('hide');
                    reload_transaction_table();
                } else {
                    for(var i = 0; i < data.inputerror.length; i++){
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
                $('#btnUpdate').text('Save');
                $('#btnUpdate').attr('disabled', false);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error Update Transaction');
                $('#btnUpdate').text('Save');
                $('#btnUpdate').attr('disabled', false);
            }
        });
    }

    function edit_transaction(id){
        save_method = 'update';
        $('#updateform')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('admin_transaction/edit_transaction')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="transaction_id"]').val(data.transaction_id);
                $('[name="book_id"]').val(data.book_id);
                $('[name="user_id"]').val(data.user_id);
                $('[name="status"]').val(1);
                $('#modal_update').modal('show');
                $('.modal-title').text('Edit Transaction');
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error retrieving data from JSON');
            }
        });
    }

  $(function() {
    $( "#dp-3" ).datepicker();
  });

        $('#clear_filters').click(function(){
            $('.filters').each(function(){
                if($(this).attr('id') == 'u_name'){
                    $(this).val('').trigger('change');
                }
                if($(this).attr('id') == 'b_name'){
                    $(this).val('').trigger('change');
                }
                if($(this).attr('id') == 'b_status'){
                    $(this).val('').trigger('change');
                }
            });
        });
</script>
