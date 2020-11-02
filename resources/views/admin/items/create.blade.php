@extends('admin/include/master')
@section('title') لوحة التحكم | إضافة منتج جديد @endsection
@section('content')

<section class="content">
        <div class="row">
                <div class="col-xs-12">
                <div class="box box-primary">

              <div class="box-header with-border">
                <h3 class="box-title">إضافة منتج جديد</h3>
              </div>
              
              {!! Form::open(array('method' => 'POST','files' => true,'url' =>'adminpanel/items')) !!}
                <div class="box-body">  
                
                  
                  
                  <div class="form-group col-md-6">
                    <label>اسم المنتج </label>
                    <input type="text" class="form-control" name="artitle" placeholder="ادخل اسم المنتج " value="{{ old('artitle') }}" required>
                    @if ($errors->has('artitle'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('artitle') }}</div>
                    @endif  
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>السعر [ريال]</label>
                    <input type="number" name="price" class="form-control" placeholder = 'ادخل السعر' required>
                    @if ($errors->has('price'))
                        <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('price') }}</div>
                    @endif  
                  </div>
                  
                  

                  <div class="form-group col-md-12">
                      <label>صورة المنتج</label>
                      <input type="file" name="image" >
                      @if ($errors->has('image'))
                          <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('image') }}</div>
                      @endif  
                  </div>

                  <div class="col-md-12">
                      <div class="box box-info">
                          <div class="box-header">
                          <h3 class="box-title" > تفاصيل المنتج </h3>
                          </div>
                          <div class="box-body pad">
                              <textarea id="editor1" name="ardesc" rows="10" cols="167" required>{!! old('ardesc') !!}</textarea>
                              @if ($errors->has('ardesc'))
                                  <div style="color: crimson;font-size: 18px;" class="error">{{ $errors->first('ardesc') }}</div>
                              @endif
                          </div>
                      </div>
                  </div>
  
                </div>
                
                <div class="box-footer">
                  <button style="width: 20%;margin-right: 40%;" type="submit" class="btn btn-primary">إضافة</button>
                </div>
                {!! Form::close() !!}
          </div>
          </div>
          </div>
</section>

<script type="text/javascript">

    $(document).ready(function () {
        $('#itme_offer').change(function() {
         if($(this).val() == 1)  
         {
            $("#discountprice").css('display', 'block');  
         } else {  
            $("#discountprice").css('display', 'none');   
         }  
        });
    });

</script>

@endsection 