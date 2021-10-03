<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="card-title">Service Provider Details</h4>
        </div>
        <div class="col-sm-6">
            <h6 class="text-right"><a href="<?php echo base_url('providers') ?>" class="btn btn-info">Back</a></h6>
        </div>
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="availability-tab" data-toggle="tab" href="#availability" role="tab" aria-controls="availability" aria-selected="true">Availability</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profession-tab" data-toggle="tab" href="#profession-1" role="tab" aria-controls="profession-1" aria-selected="false">Profession</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Contact</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="availability" role="tabpanel" aria-labelledby="availability-tab">
                            <div class="table-responsive">
                                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="card-title">You Can Add New Availability
                                            </h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-right"><button data-toggle="modal" class="btn btn-primary" data-target="#AddAvailbility">Add New </button></h6>

                                        </div>

                                        <div class="col-sm-12">

                                            <table class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                                                <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>User Email</th>
                                                        <th>Week Day</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                        <th>Active</th>
                                                        <th>Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php if (isset($availbility) && !empty($availbility)) { ?>
                                                        <?php foreach ($availbility as $key => $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value->service_provider_availability_id ?></td>
                                                                <td><?php echo GetUserEmail($value->user_id) ?></td>
                                                                <td><?php echo $value->week_day ?></td>
                                                                <td><?php echo $value->start_time ?></td>
                                                                <td><?php echo $value->end_time ?></td>
                                                                <td><?php echo $value->is_active ?></td>
                                                                <td class="actions-links_client">
                                                                    <a data-toggle="modal" data-target="#EditAvailbility" data-whatever="<?php echo $value->service_provider_availability_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                                                    <a href="javascript:void(0)" onclick="DeleteRecordAvailbility('<?php echo $value->service_provider_availability_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                                                </td>
                                                            </tr>

                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>

                                            </table>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profession-1" role="tabpanel" aria-labelledby="profession-tab">
                            <div class="table-responsive">
                                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <h4 class="card-title">You Can Add New Professional Name Here
                                            </h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-right"><button data-toggle="modal" class="btn btn-primary" data-target="#AddProfession">Add New </button></h6>

                                        </div>

                                        <div class="col-sm-12">
                                            <style>
                                                .dataTable thead>tr>th {
                                                    font-size: 11px;
                                                    background-color: darkblue;
                                                    color: whitesmoke;
                                                }

                                                .actions-links a>i {
                                                    font-size: 20px !important;
                                                    color: darkblue !important;
                                                    margin-right: 15px;
                                                }
                                            </style>
                                            <table class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                                                <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>User Email</th>
                                                        <th>Professional Name</th>
                                                        <th>Created_at</th>
                                                        <th>Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php if (isset($profession) && !empty($profession)) { ?>
                                                        <?php foreach ($profession as $key => $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value->service_provider_profession_id ?></td>
                                                                <td><?php echo GetUserEmail($value->user_id) ?></td>
                                                                <td><?php echo ProfessionalName($value->profession_id) ?></td>
                                                                <td><?php echo $value->created_date ?></td>
                                                                <td class="actions-links_client">
                                                                    <a data-toggle="modal" data-target="#EditProfession" data-whatever="<?php echo $value->service_provider_profession_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                                                    <a href="javascript:void(0)" onclick="DeleteRecordProfession('<?php echo $value->service_provider_profession_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                                                </td>
                                                            </tr>

                                                        <?php } ?>
                                                    <?php } ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <style>
                                        .actions-links_client a>i {
                                            font-size: 23px !important;
                                            color: darkblue;
                                            margin-right: 15px;
                                            margin: 15px;
                                        }
                                    </style>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="table-responsive">
                                <div id="order-listing_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="card-title">You Can Add New Contact
                                            </h4>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="text-right"><button data-toggle="modal" class="btn btn-primary" data-target="#AddContact">Add New </button></h6>

                                        </div>
                                        <div class="col-sm-12">

                                            <table class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                                                <thead>
                                                    <tr>
                                                        <th>#id</th>
                                                        <th>Contact Name</th>
                                                        <th>Contact Email</th>
                                                        <th>Contact Phone</th>
                                                        <th>Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php if (isset($contact) && !empty($contact)) { ?>
                                                        <?php foreach ($contact as $key => $value) { ?>
                                                            <tr>
                                                                <td><?php echo $value->service_provider_contact_id ?></td>
                                                                <td><?php echo  $value->contact_name ?></td>
                                                                <td><?php echo $value->contact_email ?></td>
                                                                <td><?php echo $value->contact_phone_number ?></td>
                                                                <td class="actions-links_client">
                                                                    <a data-toggle="modal" data-target="#EditContact" data-whatever="<?php echo $value->service_provider_contact_id ?>"><i class="mdi mdi-pencil-box"></i></a>
                                                                    <a href="javascript:void(0)" onclick="DeleteRecordContact('<?php echo $value->service_provider_contact_id ?>')"><i class="mdi mdi-delete" style="color: orangered;"></i></a>
                                                                </td>
                                                            </tr>

                                                        <?php } ?>
                                                    <?php } ?>

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
        </div>

    </div>
</div>

<!-- -Model Edit Availbility--->
<div class="modal fade" id="EditAvailbility" tabindex="-1" role="dialog" aria-labelledby="EditProvider" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/UpdateAvailbility') ?>">

                    <div class="form-group">
                        <input type="hidden" name="service_provider_availability_id" id="service_provider_availability_id" class="form-control">
                        <label>Start Time</label>
                        <input type="time" name="start_time" id="start_time" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" name="end_time" id="end_time" class="form-control">
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Update Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- -Model Edit Profession--->
<div class="modal fade" id="EditProfession" tabindex="-1" role="dialog" aria-labelledby="EditProvider" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/UpdateProfession') ?>">
                    <input type="hidden" name="service_provider_profession_id" id="service_provider_profession_id" class="form-control">
                    <input type="hidden" name="user_id" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id : '' ?>" class="form-control">

                    <div class="form-group">
                        <label>Professional List</label>
                        <select name="professional_field_id" id="professional_field_id" class="form-control" onchange="getprofessionforedit(this.value)">
                            <?php if (isset($professional_list) && !empty($professional_list)) { ?>
                                <?php foreach ($professional_list as $key => $value) { ?>
                                    <option value="<?php echo $value->professional_field_id ?>"><?php echo $value->professional_field_title ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Profession List</label>
                        <select name="profession_id" id="professionedit" class="form-control ">

                        </select>
                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Update Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- -Model Add New Profession--->
<div class="modal fade" id="AddProfession" tabindex="-1" role="dialog" aria-labelledby="EditProvider" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/AddNewProfessionName') ?>">

                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id : '' ?>" class="form-control">
                        <label>Professional List</label>
                        <select name="professional_field_id" id="professional_field_id" class="form-control" onchange="getprofessionforadd(this.value)">
                            <?php if (isset($professional_list) && !empty($professional_list)) { ?>
                                <?php foreach ($professional_list as $key => $value) { ?>
                                    <option value="<?php echo $value->professional_field_id ?>"><?php echo $value->professional_field_title ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Profession List</label>
                        <select name="profession_id" id="professionadd" class="form-control">

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Add Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- -Model Add New Profession--->
<div class="modal fade" id="AddAvailbility" tabindex="-1" role="dialog" aria-labelledby="AddAvailbility" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/AddNewAvailbility') ?>">

                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id : '' ?>" class="form-control">

                    </div>
                    <div class="form-group">
                        <label>Day</label>
                        <select name="week_day" class="form-control">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Start Time</label>
                        <input type="time" name="start_time" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>End Time</label>
                        <input type="time" name="end_time" class="form-control">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Add Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- -Model Add New Contact--->
<div class="modal fade" id="AddContact" tabindex="-1" role="dialog" aria-labelledby="AddContact" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/AddNewContact') ?>">

                    <div class="form-group">
                        <input type="hidden" name="user_id" value="<?php echo (isset($user_id) && !empty($user_id)) ? $user_id : '' ?>" class="form-control">

                    </div>

                    <div class="form-group">
                        <label>Contact Name</label>
                        <input type="text" name="contact_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="text" name="contact_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="contact_phone_number" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Add Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<!-- -Model Edit Contact--->
<div class="modal fade" id="EditContact" tabindex="-1" role="dialog" aria-labelledby="EditContact" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="submit-form" action="<?php echo base_url('Providers/UpdateContact') ?>">

                    <div class="form-group">
                        <input type="hidden" name="service_provider_contact_id" id="service_provider_contact_id" class="form-control">
                        <label>Contact Name</label>
                        <input type="text" name="contact_name" id="contact_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="text" name="contact_email" id="contact_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Phone</label>
                        <input type="text" name="contact_phone_number" id="contact_phone_number" class="form-control" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-sbmit-model">Update Record</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


<script>
    ///load Data Table
    let table = $('.dataTable').DataTable();

    ///Submit Form 
    $('.submit-form').submit(function(e) {
        e.preventDefault();
        e.stopPropagation();
        let form = $(this).serialize();
        let url = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':
                        showSuccessSwal(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);
                        break;
                    case 'success-1':
                        showSuccessSwal(res.message); 
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url('providers') ?>';
                        }, 3500);
                        break;
                    case 'warning':
                        showWarningSwal(res.message);
                        break;

                }
            }

        });
    })



    //Model Availbility
    $('#EditAvailbility').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('whatever');
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Providers/GetAvailbilityTableRecordById') ?>",
            data: {
                service_provider_availability_id: id,
                table: 'service_provider_availability',
            },
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':
                        ///enter values in form  
                        $('#service_provider_availability_id').val(res.data[0]['service_provider_availability_id']);
                        $('#start_time').val(res.data[0]['start_time']);
                        $('#end_time').val(res.data[0]['end_time']);


                        break;
                    case 'warning':
                        showWarningSwal(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);

                        break;

                }
            }
        });

    });


    ///Delete Record 
    function DeleteRecordAvailbility(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('Partial/DeleteByAjax') ?>",
                        data: {
                            value: id,
                            field: 'service_provider_availability_id',
                            table: 'service_provider_availability',

                        },
                        dataType: 'html',
                        success: function(data) {
                            let res = JSON.parse(data);
                            switch (res.code) {
                                case 'success':
                                    swal("Poof! Your Record File has been deleted!", {
                                        icon: "success",
                                        button: false,
                                        timer: 3000,
                                    });
                                    // showSuccessToast(res.message);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2500)
                                    break;
                                case 'warning':
                                    swal("Poof! Your Record File Not Delete", {
                                        icon: "warning",
                                    });

                            }
                        }
                    });
                } else {
                    swal("Your Record File is safe!");
                }
            });
    }



    //Model Profession 
    $('#EditProfession').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('whatever');
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Providers/GetProfessionTableRecordById') ?>",
            data: {
                service_provider_profession_id: id,
                table: 'service_provider_profession',
            },
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':

                        ///enter values in form  
                        $('#service_provider_profession_id').val(res.data[0]['service_provider_profession_id']);
                        // $('#profession').val(res.data[0]['profession_id']);
                        getprofessionforedit($('#professional_field_id').val());


                        break;
                    case 'warning':
                        showWarningSwal(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);

                        break;

                }
            }
        });

    });


    ///Delete Record 
    function DeleteRecordProfession(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('Partial/DeleteByAjax') ?>",
                        data: {
                            value: id,
                            field: 'service_provider_profession_id',
                            table: 'service_provider_profession',

                        },
                        dataType: 'html',
                        success: function(data) {
                            let res = JSON.parse(data);
                            switch (res.code) {
                                case 'success':
                                    swal("Poof! Your Record File has been deleted!", {
                                        icon: "success",
                                        button: false,
                                        timer: 3000,
                                    });
                                    // showSuccessToast(res.message);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2500)
                                    break;
                                case 'warning':
                                    swal("Poof! Your Record File Not Delete", {
                                        icon: "warning",
                                    });

                            }
                        }
                    });
                } else {
                    swal("Your Record File is safe!");
                }
            });
    }


    //Model Profession 
    $('#EditContact').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('whatever');
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Providers/GetContactTableRecordById') ?>",
            data: {
                service_provider_contact_id: id,
                table: 'service_provider_contact',
            },
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':
                        ///enter values in form  
                        $('#service_provider_contact_id').val(res.data[0]['service_provider_contact_id']);
                        $('#contact_email').val(res.data[0]['contact_email']);
                        $('#contact_name').val(res.data[0]['contact_name']);
                        $('#contact_phone_number').val(res.data[0]['contact_phone_number']);


                        break;
                    case 'warning':
                        showWarningSwal(res.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 3500);

                        break;

                }
            }
        });

    });


    ///Delete Record 
    function DeleteRecordContact(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('Partial/DeleteByAjax') ?>",
                        data: {
                            value: id,
                            field: 'service_provider_contact_id',
                            table: 'service_provider_contact',

                        },
                        dataType: 'html',
                        success: function(data) {
                            let res = JSON.parse(data);
                            switch (res.code) {
                                case 'success':
                                    swal("Poof! Your Record File has been deleted!", {
                                        icon: "success",
                                        button: false,
                                        timer: 3000,
                                    });
                                    // showSuccessToast(res.message);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2500)
                                    break;
                                case 'warning':
                                    swal("Poof! Your Record File Not Delete", {
                                        icon: "warning",
                                    });

                            }
                        }
                    });
                } else {
                    swal("Your Record File is safe!");
                }
            });
    }


    ///getprofession
</script>

<script>
    ///first Time Load Function
    $(function() {
        getprofessionforadd($('#professional_field_id').val());
    })

    function getprofessionforadd(id) {
        $('#professionadd').find('option')
            .remove()
            .end();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Providers/GetProfessionByParentProfessional') ?>",
            data: {
                professional_field_id: id,
                table: 'profession',
            },
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':

                        let list = ' ';
                        for (let index = 0; index < res.data.length; index++) {
                            list += '<option value=' + res.data[index]['profession_id'] + ' >' + res.data[index]['profession_field_title'] + '</option>';
                        }
                        $('#professionadd').append(list);
                        break;
                    case 'warning':


                        break;

                }
            }
        });
    }

    function getprofessionforedit(id) {
        $('#professionedit').find('option')
            .remove()
            .end();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('Providers/GetProfessionByParentProfessional') ?>",
            data: {
                professional_field_id: id,
                table: 'profession',
            },
            dataType: 'html',
            success: function(data) {
                let res = JSON.parse(data);
                switch (res.code) {
                    case 'success':

                        let list = ' ';
                        for (let index = 0; index < res.data.length; index++) {
                            list += '<option value=' + res.data[index]['profession_id'] + ' >' + res.data[index]['profession_field_title'] + '</option>';
                        }
                        $('#professionedit').append(list);
                        break;
                    case 'warning':


                        break;

                }
            }
        });
    }
</script>