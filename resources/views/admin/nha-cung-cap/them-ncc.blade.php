<!-- Add Accont form id="add__account-form"-->
<div class="add-form add-form__add-ncc" id="add-form__ncc">
    <div class="add-form__container">
        <div class="add-form__header add-form__add-account--center">
            <h3 class="add-form__haeding ">Thêm Nhà Cung Cấp</h3>
        </div>

        <form action="{{route('quanly.them-ncc')}}" id="them-ncc" method="POST" data-parsley-validate>
            @csrf
            <div class="add-form__form">
                <div class="add-form__group">
                    <label for="">Tên nhà cung cấp:</label>
                    <div class="add-form__item">
                        <input type="text" class="add-form__input input__name-supplier" name="ten_ncc" placeholder="Tên nhà cung cấp" required data-parsley-required-message="Vui lòng nhập tên nhà cung cấp!">
                    </div>
                </div>

                <div class="add-form__group">
                    <label for="">Số điện thoại:</label>
                    <div class="add-form__item">
                        <input type="number" class="add-form__input add-form__input-number" name="sdt_ncc" placeholder="Số điện thoại" required data-parsley-required-message="Vui lòng nhập số điện thoại!" data-parsley-length="[10, 10]" data-parsley-length-message="Số điện thoại không đúng!">
                    </div>
                </div>

                <div class="add-form__group">
                    <label for="">Email:</label>
                    <div class="add-form__item"><input type="email" class="add-form__input" name="email_ncc" placeholder="Email" required data-parsley-required-message="Vui lòng nhập email!" data-parsley-type="email" data-parsley-type-message="Email không đúng định dạng!">
                    </div>
                </div>

                <div class="add-form__group">
                    <label for="">Địa chỉ:</label>
                    <div class="add-form__item">
                        <input type="text" class="add-form__input" name="dia_chi_ncc" placeholder="Địa chỉ" required data-parsley-required-message="Vui lòng nhập Địa chỉ!">
                    </div>
                </div>

                <div class="add-form__controls">
                    <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddNcc(), setNullValue()">HỦY</button>
                    <button class="btn btn--primary">LƯU</button>
                </div>

            </div>
        </form>

    </div>
</div>