
@extends('layout')
@section('content')

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

            <form  action="{{route('tariff.store')}}" method="POST">
                @csrf
                <div class="mb-3">

                    <input type="text" class="form-control" name="value" placeholder="введите значение">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
            </form>

        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">

            <form  action="{{route('tariff.store')}}" method="POST">
                @csrf
                <div class="mb-3">

                    <input type="text" class="form-control" name="value" placeholder="введите значение">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Сохранить</button>
            </form>

        </div>


    </div>
<script>
    $(document).ready(function() {
    // При клике на вкладку
    $(".nav-link").click(function() {
    var activeTabId = $(this).attr('data-bs-target'); // Получаем идентификатор новой активной вкладки

    // Сохраняем активную вкладку в localStorage
    localStorage.setItem("activeTab", activeTabId);
    });

    // После перезагрузки страницы
    var activeTabId = localStorage.getItem("activeTab"); // Получаем сохраненную активную вкладку из localStorage

    if (activeTabId) {
    $(activeTabId).tab("show"); // Показываем сохраненную активную вкладку
    }
    });
</script>
@endsection
