<!-- Add Accont form id="add__account-form"-->
<div class="add-form add-form__add-trademark" id="add-form__trademark">
    <div class="add-form__container">
        <div class="add-form__header add-form__add-account--center">
            <h3 class="add-form__haeding ">Thêm Thương Hiệu</h3>
        </div>

        <form action="{{route('quanly.them-thuong-hieu')}}" id="them-thuong-hieu" method="POST" data-parsley-validate>
            @csrf
            <div class="add-form__form">
                <div class="add-form__group">
                    <label for="">Tên thương hiệu:</label>
                    <div class="add-form__item">
                        <input type="text" class="add-form__input input__name-trademark" name="ten_thuong_hieu" placeholder="Tên thương hiệu" required data-parsley-required-message="Vui lòng nhập tên thương hiệu!">
                    </div>
                </div>

                <div class="add-form__controls">
                    <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddTrademark(), setNullValue()">HỦY</button>
                    <button class="btn btn--primary">LƯU</button>
                </div>

            </div>
        </form>

    </div>
</div>