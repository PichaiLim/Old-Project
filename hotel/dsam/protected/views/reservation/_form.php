<?php
/* @var $this ReservationController */
/* @var $model Reservation */
/* @var $form CActiveForm */
?>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        <span class="text text-danger">*</span> ชื่อลูกค้า
    </label>
    <div class="col-sm-9">
        <div class="row" >
            <div class="col-xs-8" >
                <input list="customersName"
                       name="customersName"
                       class="form-control customersName"
                       required
                       ng-model="r.customer_name"
                       ng-focus="r.customers();"
                       ng-change="r.keyCustomer(r.customer_name);" />
                <datalist id="customersName">
                    <option ng-repeat="c in r.CustomerList"
                            ng-select="r.selCustomer(r.customer_name, c.id);"
                            data-id="{{c.id}}"
                            value="{{c.first_name + ' ' + c.last_name}}">
                    </option >
                </datalist>
            </div >
            <div class="col-xs-4" >
                <a href="#/customer/add" class="btn btn-primary btn-block" data-uri="/global/customer/create"
                   data-toggle="modal"
                   data-target="profile">
                    <i class="fa fa-fw fa-plus"></i>เพิ่มชื่อลูกค้า
                </a>
            </div >
        </div >
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        <span class="text text-danger">*</span> วันที่เริ่มเข้าพัก
    </label>
    <div class="col-sm-9">
        <div class="input-group">
            <input type="text"
                   class="form-control"
                   required
                   placeholder="yyyy/mm/dd"
                   value=""
                   name="start"
                   id="start"
                   ng-model="r.start"
                   aria-describedby="basic-addon2"
                   onchange="changeDate();">
            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        <span class="text text-danger">*</span> จำนวนวันที่เข้าพัก
    </label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="number"
                   class="form-control"
                   name="num_days"
                   id="num_days"
                   placeholder="1"
                   min="1"
                   minlength="2"
                   max="99"
                   required
                   readonly
                   ng-model="r.num_days"
                   ng-blur="r.changeNumDays(this);"
                   value=""
                   aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">วัน</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        <span class="text text-danger">*</span> วันที่สิ้นสุดการเข้าพัก
    </label>
    <div class="col-sm-9">
        <div class="input-group">
            <input type="text"
                   class="form-control"
                   required
                   placeholder="yyyy/mm/dd"
                   name="end"
                   id="end"
                   ng-model="r.end"
                   aria-describedby="basic-addon2"
                   onchange="changeDate();">
            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-fw fa-calendar"></i></span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        ประเภทห้อง
    </label>
    <div class="col-sm-9">
        <p class="form-control-static">
            <strong>{{r.roomTypeName}}</strong>
        </p>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        <span class="text text-danger">*</span> ราคาต่อคืน
    </label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="number"
                   min="1"
                   readonly
                   required class="form-control"
                   placeholder="0.00"
                   name="price"
                   id="price"
                   ng-model="r.price"
                   aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">บาท</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        ค่ามัดจำ
    </label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="number"
                   class="form-control"
                   min="0"
                   readonly
                   placeholder="0.00"
                   name="deposit"
                   id="deposit"
                   ng-model="r.deposit"
                   aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">บาท</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        ค่ามัดจำเดิม
    </label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="number"
                   class="form-control"
                   min="0"
                   placeholder="0.00"
                   ng-model="r.previous_deposit"
                   value="{{r.previous_deposit}}"
                   aria-describedby="basic-addon2">
            <span class="input-group-addon" id="basic-addon2">บาท</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        รวม
    </label>
    <div class="col-sm-5">
        <div class="input-group">
            <input type="number"
                   class="form-control"
                   min="0"
                   readonly
                   placeholder="0.00"
                   ng-model="r.amount"
                   ng-value="r.amount = r.price + r.deposit + r.previous_deposit"
                   aria-describedby="basic-addon2">{{r.num_days |json}}
            <span class="input-group-addon" id="basic-addon2">บาท</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">
        ชำระเงินแล้ว
    </label>
    <div class="col-sm-9">
        <label class="radio-inline">
            <input type="radio"
                   name="paid_status"
                   id="paid_status"
                   ng-model="r.paid_status"
                   value="yes" >
            <strong class="text text-success">Yes</strong>
        </label>
        <label class="radio-inline">
            <input type="radio" name="paid_status" id="paid_status" ng-model="r.paid_status"
                   value="no">
            <strong class="text text-danger">No</strong>
        </label>
    </div>
</div>

<script>
    $( function() {
        var dateFormat = "yy/mm/dd",
            from = $( "#start" )
                .datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    minDate: 0,
                    dateFormat: dateFormat
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#end" ).datepicker({
                defaultDate: "+1W",
                changeMonth: true,
                numberOfMonths: 3,
                minDate: 1,
                dateFormat: dateFormat
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }

    } );

    function changeDate(){
        var d1 = $( "#start" ).datepicker('getDate');
        var d2 = $( "#end" ).datepicker('getDate');
        var diff = 0;

        if(d1 && d2)
        {
            diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
        }
        $('#num_days').val(diff);
    }
</script>