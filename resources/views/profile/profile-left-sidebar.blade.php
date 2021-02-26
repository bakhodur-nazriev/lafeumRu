<div class="col-md-3 mr-5 px-4 bg-default">
    <div class="profile-left-top d-flex align-items-center py-3">
        <img class="rounded-circle" src="{{ Auth::user()->avatar }}" alt="" style="width: 51px">
        <div class="profile-left-user-data">
            <h5 class="my-1">{{ Auth::user()->name }}</h5>
            <h6 class="my-1">{{ Auth::user()->role->name }}</h6>
        </div>
    </div>
    <hr>
    <div class="ml-2" id="myDIV">
        <div class="profile-left-links-block">
            <a class="profile-left-links d-flex align-items-center lol active" href="{{ route('profile') }}">
                <i class="fas fa-user-circle mr-3 profile-left-links-icon"></i>
                {{ __('Редактировать') }}
            </a>
        </div>
        <div class="profile-left-links-block">
            <a class="profile-left-links d-flex align-items-center lol" href="{{ route('favorites') }}">
                <i class="fas fa-briefcase mr-3 profile-left-links-icon"></i>
                {{ __('Избранные') }}
            </a>
        </div>
        <div class="profile-left-links-block">
            <a class="profile-left-links d-flex align-items-center" href="">
                <i class="fas fa-cog mr-3 profile-left-links-icon"></i>
                {{ __('Настройки') }}
            </a>
        </div>
    </div>
    <hr>
    <div class="ml-2 my-4 d-flex align-items-center">
        <i class="fas fa-sign-out-alt mr-3 profile-left-links-icon"></i>
        <a class="profile-left-links" href="">{{ __('Выход') }}</a>
    </div>
</div>


<script>
    console.log();

    // Add active class to the current button
    let header = document.getElementById("myDIV");
    let buttons = header.getElementsByClassName("lol");
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function () {
            let current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
