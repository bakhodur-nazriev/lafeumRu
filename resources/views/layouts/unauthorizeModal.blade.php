<!-- Modal -->
<div class="modal fade" id="unauthorizedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Для этого вы должны зарегистрироваться...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Только зарегистрированные пользователи могут воспользоваться этой функцией.</h5>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{route('login')}}">{{ __('Авторизация') }}</a>
                <a class="btn btn-primary" href="{{route('register')}}">{{ __('Регистрация') }}</a>
            </div>
        </div>
    </div>
</div>
