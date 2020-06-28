<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>₱ <?php echo number_format($total_collection_today)?></h3>

                <p>Collection Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo count($data)?></h3>

                <p>Number of Payments Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo count($total_payers_today)?></h3>

                <p>Number of Payers Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    
</div>
<form action="<?php echo base_url('collection/edit_save/'.$collection['id']); ?>">

    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Payment</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Current Date </label>
                        <input type="date" class="form-control date" readonly="" required="" value="<?php echo date('Y-m-d'); ?>" name="date">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Borrower Loan</label>
                        <select class="form-control select2 required loan_id" name="loan_id" required="required" style="width: 100%;">
                                <option value="">- Please Select -</option>
                            <?php foreach ($loans as $loans_key => $loans_value): ?>
                                <option <?php if($collection['loan_id']==$loans_value['id']){ echo "selected"; } ?> value="<?php echo $loans_value['id'] ?>"><?php echo $loans_value['name'] ?> (₱ <?php echo $loans_value['amount'] ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
               
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control amount" required="" name="amount" value="<?php print_r($collection['amount']) ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">

                        <input type="submit" value="Submit" class="form-control btn btn-success" name="">
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Add a new payment here
        </div>
    </div>
</form>
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Recent Transactions</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php foreach($data as $data_key=>$data_value): ?>
                        <tr>
                            <td><?php echo $data_value['name'] ?></td>
                            <td>₱ <?php echo number_format($data_value['amount']) ?></td>
                            
                            <td>
                                <button onclick="edit_data(<?php echo $data_value['id'] ?>)" class="btn btn-info form-control"><i class="fas fa-pen"></i>Edit</button>
                            </td>
                            <td>
                                <button onclick="delete_data(<?php echo $data_value['id'] ?>)" class="btn btn-danger form-control"><i class="fas fa-trash"></i>Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
           
            </div>
            
            
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Recent Payments are displayed here
    </div>
</div>

<?php
    $json_loan = [];

    foreach ($loans as $loan_key => $loan_value) {
        $json_loan[$loan_value['id']]['gives_payable'] = $loan_value['gives_payable'];
    }

?>
<?php $this->load->view('parts/footer'); ?>
<script type="text/javascript">
    var loans_data = JSON.parse('<?php echo json_encode($json_loan) ?>');

    $(".loan_id").change(function(){
        var current_value = $(this).val();
        $(".amount").attr("placeholder",loans_data[current_value].gives_payable);

    });
    function edit_data(id){
        window.location.href = "<?php echo base_url('collection/edit/') ?>"+id;
    }

    function delete_data(id){
        if(confirm("Are you sure you want to delete this record?")){
            window.location.href = "<?php echo base_url('collection/delete/') ?>"+id;
        }
        
    }
</script>