 <!-- Add Flovor form id="add__account-form"-->
 <div class="add-form add-form__add-flavor" id="add-form__flavor">
     <div class="add-form__container">
         <div class="add-form__header add-form__add-account--center">
             <h3 class="add-form__haeding ">Thêm Hương Thơm</h3>
         </div>

         <form action="{{route('quanly.them-huong-thom')}}" id="them-huong-thom" method="POST" data-parsley-validate>
             @csrf
             <div class="add-form__form">
                 <div class="add-form__group">
                     <label for="">Tên hương thơm:</label>
                     <div class="add-form__item">
                         <input type="text" class="add-form__input input__name-flavor" name="ten_huong_thom" placeholder="Tên hương thơm" required data-parsley-required-message="Vui lòng nhập tên hương thơm!">
                     </div>
                 </div> 

                 <div class="add-form__controls">
                     <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddFlavor(), setNullValue()">HỦY</button>
                     <button type="submit" class="btn btn--primary">LƯU</button>
                 </div>

             </div>
         </form>

     </div>
 </div>