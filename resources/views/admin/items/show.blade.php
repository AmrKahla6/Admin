@extends('admin/include/master')
@section('title') لوحة التحكم | مشاهدة تفاصيل المنتج @endsection
@section('content')
<?php use Carbon\Carbon; ?>
        <div class="box-body">
            <div style="margin-top: 7%;" class="col-md-6">
                
                
                
                <div class="form-group col-md-12">
                    <label>اسم المنتج </label>
                    <input type="text" class="form-control" value="{{$showitem->artitle}}" readonly> 
                </div>
                

                <div class="form-group col-md-12">
                    <label>السعر [ريال]</label>
                    <input type="text" class="form-control" value="{{$showitem->price}}" readonly> 
                </div>
                

            </div>

            <div class="col-md-6">
            <h6 class="box-title" style="float:left;"> تاريخ الاعلان : {{ $showitem->created_at }}</h6><br>
              
                <h4 style="float:right;margin-top: 5%;">
                     @if($showitem->suspensed == 0)
                      غير معطل<span> <i class="fa fa-unlock text-success"></i> </span>
                    @else 
                       معطل<span> <i class="fa fa-lock text-danger"></i> </span>
                    @endif 
                </h4>    

                
                <div class="col-md-12">
                      <img class="img-thumbnail" style="width:100%; height:30%;" src="{{asset('users/images/'.$showitem->image)}}" alt="">
                </div>
                
                
                </hr>
                <div class="form-group col-md-12">
                    <label>تفاصيل المنتج</label>                                    
                    <textarea rows='10' type="text" class="form-control" readonly>{!! $showitem->details !!}</textarea>
                </div>
                
            </div>
        </div>    
@endsection