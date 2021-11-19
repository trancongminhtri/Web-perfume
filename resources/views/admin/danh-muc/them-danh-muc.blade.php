<div class="add-form add-form__add-trademark" id="add-form__category">
    <div class="add-form__container">
        <div class="add-form__header add-form__add-account--center">
            <h3 class="add-form__haeding ">Thêm danh mục</h3>
        </div>

        <form action="{{route('quanly.them-danh-muc')}}" id="them-danh-muc" method="POST" data-parsley-validate>
             @csrf
            <div class="add-form__form">
                <div class="add-form__group">
                    <label for="">Tên danh mục:</label>
                    <div class="add-form__item">
                        <input type="text" class="add-form__input input__name-category" name="ten_danh_muc" placeholder="Tên danh mục" required data-parsley-required-message="Vui lòng nhập tên danh mục!">
                    </div>
                </div>

                <div class="add-form__controls">
                    <button type="button" class="btn add-form__controls-back btn--normal" onclick="backAddCategory(), setNullValue()">HỦY</button>
                    <button type="submit" class="btn btn--primary">LƯU</button>
                </div>

            </div>
        </form>

    </div>
</div>